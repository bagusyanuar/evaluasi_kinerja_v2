<?php


namespace App\Http\Controllers;


use App\Helper\CustomController;
use App\Models\Package;
use App\Models\ScoreSMKKV2;
use App\Models\ScoreSmkkv2Revision;
use App\Models\Stage;
use App\Models\StorehouseImage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use Yajra\DataTables\DataTables;

class SmkkV2Controller extends CustomController
{

    public function __construct()
    {
        parent::__construct();
    }

    private function generateDataPackageOngoing()
    {
        $year = $this->request->query->get('year');
        $query = Package::with(['vendor.vendor', 'ppk']);
        if (Auth::user()->roles[0] == 'vendor') {
            $data = $query->where('vendor_id', '=', Auth::id());
        } elseif (Auth::user()->roles[0] == 'accessorppk') {
            $data = $query->whereHas('ppk.accessorppk', function ($q) {
                /** @var Builder $q */
                $q->where('user_id', '=', Auth::id());
            });
        }
        if ($year !== '') {
            $query->where(DB::raw('YEAR(start_at)'), '<=', $year)
                ->where(DB::raw('YEAR(finish_at)'), '>=', $year);
        }
        $data = $query->get();
        return DataTables::of($data)->make(true);
    }

    public function index()
    {
        if ($this->request->ajax()) {
            return $this->generateDataPackageOngoing();
        }
        return view('superuser.penilaian.smkk-v2.index');
    }

    public function package_page($id)
    {
        if ($this->request->method() === 'POST' && $this->request->ajax()) {
            return $this->setScore($id);
        }
        $data = Package::with(['vendor.vendor', 'ppk'])->where('id', $id)->firstOrFail();
        $stages = Stage::with([])->get();
        return view('superuser.penilaian.smkk-v2.package')->with([
            'data' => $data,
            'stages' => $stages
        ]);
    }

    public function score_page($id, $stage_id)
    {
        $package = Package::with(['vendor.vendor', 'ppk'])->where('id', $id)->firstOrFail();
        $stage = Stage::with(['sub_stages.indicators.sub_indicators'])->where('id', '=', $stage_id)->firstOrFail();
        if ($this->request->ajax()) {
            if ($this->request->method() === 'POST') {

                return $this->setScore($id);
            }
            try {
                $sub_stages = $stage->sub_stages;
                $scores = ScoreSMKKV2::with(['revisions'])
                    ->where('package_id', '=', $id)
                    ->get();
                return response()->json([
                    'sub_stages' => $sub_stages,
                    'scores' => $scores
                ], 200);
            } catch (\Exception $e) {
                return response()->json('internal server error', 500);
            }
        }
        return view('superuser.penilaian.smkk-v2.score')->with([
            'package' => $package,
            'stage' => $stage,
        ]);
    }

    private function setScore($package_id)
    {
        try {
            $scoreValue = (int)$this->request->request->get('value');
            $sub_indicator_id = (int)$this->request->request->get('sub_indicator');
            $scoreText = '';
            switch ($scoreValue) {
                case 0:
                    $scoreText = 'Tidak Ada';
                    break;
                case 1:
                    $scoreText = 'Ada';
                    break;
                default:
                    break;
            }
            $score = ScoreSMKKV2::with([])
                ->where('package_id', '=', $package_id)
                ->where('stage_sub_indicator_id', '=', $sub_indicator_id)
                ->first();
            if (!$score) {
                $data_score = [
                    'package_id' => $package_id,
                    'evaluator_id' => \auth()->id(),
                    'stage_sub_indicator_id' => $sub_indicator_id,
                    'score' => $scoreValue,
                    'score_text' => $scoreText,
                    'note_ppk' => '',
                    'note_balai' => '',
                ];
                ScoreSMKKV2::create($data_score);
            } else {
                $data_score = [
                    'evaluator_id' => \auth()->id(),
                    'score' => $scoreValue,
                    'score_text' => $scoreText,
                ];
                $score->update($data_score);
            }
            return response()->json('success', 200);
        } catch (\Exception $e) {
            return response()->json('internal server error', 500);
        }
    }

    public function uploadScoreFile($id)
    {
        $sub_indicator_id = $this->request->request->get('sub-indicator-id-file');
        try {
            DB::beginTransaction();
            $currentScore = ScoreSMKKV2::with([])->where('package_id', '=', $id)
                ->where('stage_sub_indicator_id', '=', $sub_indicator_id)
                ->first();
            if ($this->request->hasFile('file')) {
                $file = $this->request->file('file');
                $extension = $file->getClientOriginalExtension();
                $document = Uuid::uuid4()->toString() . '.' . $extension;
                $storage_path = public_path('files_smkk');
                $documentName = $storage_path . '/' . $document;
                if (!$currentScore) {
                    $data_score = [
                        'package_id' => $id,
                        'evaluator_id' => null,
                        'stage_sub_indicator_id' => $sub_indicator_id,
                        'score' => null,
                        'score_text' => '',
                        'note_ppk' => '',
                        'note_balai' => '',
                        'file' => '/files_smkk/' . $document
                    ];
                    ScoreSMKKV2::create($data_score);
                } else {
                    $dataDocument = [
                        'file' => '/files_smkk/' . $document
                    ];
                    $currentScore->update($dataDocument);
                }

                $file->move($storage_path, $documentName);
                DB::commit();
                return response()->json('success', 200);
            } else {
                DB::rollBack();
                return response()->json('no file attached', 403);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json('internal server error', 500);
        }
    }

    public function uploadRevision($id)
    {
        $score_id = $this->request->request->get('id-score');
        try {
            DB::beginTransaction();
            $currentScore = ScoreSMKKV2::with([])->where('id', '=', $score_id)
                ->first();
            if ($this->request->hasFile('file')) {
                $file = $this->request->file('file');
                $extension = $file->getClientOriginalExtension();
                $document = Uuid::uuid4()->toString() . '.' . $extension;
                $storage_path = public_path('files_smkk_revision');
                $documentName = $storage_path . '/' . $document;
                $packageID = $currentScore->package_id;
                $subStageIndicatorID = $currentScore->stage_sub_indicator_id;
                $fileName = 'Revisi_1';
                $lastRevision = ScoreSmkkv2Revision::with([])
                    ->where('score_smkkv2_id', '=', $currentScore->id)
                    ->orderBy('created_at', 'DESC')
                    ->first();
                if ($lastRevision) {
                    $tmpFileName = explode('_', $lastRevision->name);
                    $tmpIdx = (int)$tmpFileName[1];
                    $fileName = 'Revision_' . ($tmpIdx + 1);
                }
                $dataRevision = [
                    'score_smkkv2_id' => $currentScore->id,
                    'package_id' => $packageID,
                    'stage_sub_indicator_id' => $subStageIndicatorID,
                    'name' => $fileName,
                    'file' => '/files_smkk_revision/' . $document
                ];
                $currentScore->update([
                    'score' => null,
                    'score_text' => ''
                ]);
                ScoreSmkkv2Revision::create($dataRevision);
                $file->move($storage_path, $documentName);
                DB::commit();
                return response()->json('success', 200);
            } else {
                DB::rollBack();
                return response()->json('no file attached', 403);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json('internal server error ' . $e->getMessage(), 500);
        }
    }

    public function setDescription($id, $stage_id)
    {
        if ($this->request->ajax() && $this->request->method() === 'POST') {
            try {
                $sub_indicator_id = $this->request->request->get('sub_indicator_id_description');
                $currentScore = ScoreSMKKV2::with([])->where('package_id', '=', $id)
                    ->where('stage_sub_indicator_id', '=', $sub_indicator_id)
                    ->first();

                if (!$currentScore) {
                    return response()->json('Data Nilai Tidak Di Temukan...', 404);
                }
                $notePPK = $this->request->request->get('ppk_description');
                $noteBalai = $this->request->request->get('balai_description');
                $data_score = [
                    'note_ppk' => $notePPK,
                    'note_balai' => $noteBalai,
                ];
                $currentScore->update($data_score);
                return response()->json('success', 200);
            } catch (\Exception $e) {
                return response()->json('internal server error', 500);
            }
        }
        return $this->getDescription($id, $stage_id);
    }

    private function getDescription($id, $stage_id)
    {
        try {
            $sub_indicator_id = $this->request->query->get('sub-indicator-id-description');
            $currentScore = ScoreSMKKV2::with([])->where('package_id', '=', $id)
                ->where('stage_sub_indicator_id', '=', $sub_indicator_id)
                ->first();
            return response()->json([
                'message' => 'success',
                'data' => $currentScore
            ], 200);
        } catch (\Exception $e) {
            return response()->json('internal server error', 500);
        }
    }
}
