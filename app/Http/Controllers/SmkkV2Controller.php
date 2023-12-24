<?php


namespace App\Http\Controllers;


use App\Helper\CustomController;
use App\Models\Package;
use App\Models\ScoreSMKKV2;
use App\Models\Stage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
                $scores = ScoreSMKKV2::with([])
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
            $scoreText = '-';
            switch ($scoreValue) {
                case 0:
                    $scoreText = 'Ada';
                    break;
                case 1:
                    $scoreText = 'Tidak Ada';
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
}
