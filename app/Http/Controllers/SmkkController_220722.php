<?php


namespace App\Http\Controllers;


use App\Helper\CustomController;
use App\Models\IndicatorRksmkk;
use App\Models\IndicatorRkkkonsultan;
use App\Models\IndicatorRkkkontraktor;
use App\Models\IndicatorRmpkpm;
use App\Models\IndicatorRmllp;
use App\Models\IndicatorRkpplkontraktor;
use App\Models\IndicatorRkpplperencanaan;
use App\Models\IndicatorRkpplpengawasan;
use App\Models\IndicatorAtj;
use App\Models\Notification;
use App\Models\Package;
use App\Models\ScoreRksmkk;
use App\Models\ScoreRkkkonsultan;
use App\Models\ScoreRkkkontraktor;
use App\Models\ScoreRmpkpm;
use App\Models\ScoreRmllp;
use App\Models\ScoreRkpplkontraktor;
use App\Models\ScoreRkpplperencanaan;
use App\Models\ScoreRkpplpengawasan;
use App\Models\ScoreAtj;
use App\Models\ScoreHistory;
use App\Models\SubIndicatorRksmkk;
use App\Models\SubIndicatorRkkkonsultan;
use App\Models\SubIndicatorRkkkontraktor;
use App\Models\SubIndicatorRmpkpm;
use App\Models\SubIndicatorRmllp;
use App\Models\SubIndicatorAtj;
use App\Models\SubIndicatorRkpplkontraktor;
use App\Models\SubIndicatorRkpplperencanaan;
use App\Models\SubIndicatorRkpplpengawasan;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class SmkkController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getDatatable()
    {
        $query = Package::with(['vendor.vendor', 'ppk']);
        return $query;
    }

    public function datatable()
    {
        $tahun = \request()->query->get('tahun');
        $data = Package::with(['vendor.vendor', 'ppk']);
        if (Auth::user()->roles[0] == 'vendor') {
            $data = $data->where('vendor_id', '=', Auth::id());
        } elseif (Auth::user()->roles[0] == 'accessorppk') {
            $data = $data->whereHas('ppk.accessorppk', function ($query) {
                $query->where('user_id', '=', Auth::id());
            });
        }
        if ($tahun !== '') {
            $data->where(DB::raw('YEAR(start_at)'), '<=', $tahun)
               ->where(DB::raw('YEAR(finish_at)'), '>=', $tahun);
        }
        $data = $data->get();
        return DataTables::of($data)->make(true);

    }

    public function datatableByVendorId($id)
    {
        $roles = auth()->user()->roles[0];
        $query = $this->getDatatable();
        if ($roles === 'accessor') {
            $query->where('vendor_id', '=', $id);
        }
        if ($roles === 'accessorppk') {
            $query->whereHas('ppk.accessorppk.user', function ($query) {
                $query->where('id', Auth::id());
            });
        }
//        $data = $this->getDatatable();
        return DataTables::of($query)->make(true);
    }

    public function index()
    {
//        return view('superuser.penilaian.penilaian');
        return view('superuser.penilaian.smkk');
    }

   public function detail($id)
    {
        $data = Package::with(['vendor.vendor', 'ppk'])->where('id', $id)->firstOrFail();
        return view('superuser/penilaian/detail-smkk')->with(['data' => $data]);
    }
	
	
    public function lastUpdate()
    {
        try {
            $packageId = request()->query->get('package');
            $type = request()->query->get('type');
            $score = ScoreRksmkk::with('subIndicator')->where('package_id', $packageId)->where('type', $type)->orderBy('updated_at', 'DESC')->first();
            return response()->json([
                'msg' => 'success',
                'data' => $score
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['msg' => 'Terjadi Kesalahan Server..'], 500);
        }
    }

   public function getScore()
    {
        try {
            $packageId = request()->query->get('package');
           // $type = request()->query->get('type');
//            dd($packageId);
            $data = IndicatorRksmkk::with(['subIndicator.singleScore' => function ($query) use ($packageId) {
                $query->where('package_id', $packageId);
            }])->get();
            return response()->json([
                'msg' => 'success',
                'data' => [
                    'indicator' => $data->toArray()
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['msg' => 'Terjadi Kesalahan Server..'], 500);
        }
    }
	
	public function getScoreKonsultan()
    {
        try {
            $packageId = request()->query->get('package');
           // $type = request()->query->get('type');
//            dd($packageId);
            $data = IndicatorRkkkonsultan::with(['subIndicator.singleScore' => function ($query) use ($packageId) {
                $query->where('package_id', $packageId);
            }])->get();
            return response()->json([
                'msg' => 'success',
                'data' => [
                    'indicator' => $data->toArray()
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['msg' => 'Terjadi Kesalahan Server..'], 500);
        }
    }
	
	public function getScoreKontraktor()
    {
        try {
            $packageId = request()->query->get('package');
           // $type = request()->query->get('type');
//            dd($packageId);
            $data = IndicatorRkkkontraktor::with(['subIndicator.singleScore' => function ($query) use ($packageId) {
                $query->where('package_id', $packageId);
            }])->get();
            return response()->json([
                'msg' => 'success',
                'data' => [
                    'indicator' => $data->toArray()
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['msg' => 'Terjadi Kesalahan Server..'], 500);
        }
    }
	
	public function getScoreRmpkpm()
    {
        try {
            $packageId = request()->query->get('package');
           // $type = request()->query->get('type');
//            dd($packageId);
            $data = IndicatorRmpkpm::with(['subIndicator.singleScore' => function ($query) use ($packageId) {
                $query->where('package_id', $packageId);
            }])->get();
            return response()->json([
                'msg' => 'success',
                'data' => [
                    'indicator' => $data->toArray()
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['msg' => 'Terjadi Kesalahan Server..'], 500);
        }
    }
	
	public function getScoreRmllp()
    {
        try {
            $packageId = request()->query->get('package');
           // $type = request()->query->get('type');
//            dd($packageId);
            $data = IndicatorRmllp::with(['subIndicator.singleScore' => function ($query) use ($packageId) {
                $query->where('package_id', $packageId);
            }])->get();
            return response()->json([
                'msg' => 'success',
                'data' => [
                    'indicator' => $data->toArray()
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['msg' => 'Terjadi Kesalahan Server..'], 500);
        }
    }
	
	public function getScoreRkpplkontraktor()
    {
        try {
            $packageId = request()->query->get('package');
           // $type = request()->query->get('type');
//            dd($packageId);
            $data = IndicatorRkpplkontraktor::with(['subIndicator.singleScore' => function ($query) use ($packageId) {
                $query->where('package_id', $packageId);
            }])->get();
            return response()->json([
                'msg' => 'success',
                'data' => [
                    'indicator' => $data->toArray()
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['msg' => 'Terjadi Kesalahan Server..'], 500);
        }
    }
	
	public function getScoreRkpplperencanaan()
    {
        try {
            $packageId = request()->query->get('package');
           // $type = request()->query->get('type');
//            dd($packageId);
            $data = IndicatorRkpplperencanaan::with(['subIndicator.singleScore' => function ($query) use ($packageId) {
                $query->where('package_id', $packageId);
            }])->get();
            return response()->json([
                'msg' => 'success',
                'data' => [
                    'indicator' => $data->toArray()
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['msg' => 'Terjadi Kesalahan Server..'], 500);
        }
    }
	
	public function getScoreRkpplpengawasan()
    {
        try {
            $packageId = request()->query->get('package');
           // $type = request()->query->get('type');
//            dd($packageId);
            $data = IndicatorRkpplpengawasan::with(['subIndicator.singleScore' => function ($query) use ($packageId) {
                $query->where('package_id', $packageId);
            }])->get();
            return response()->json([
                'msg' => 'success',
                'data' => [
                    'indicator' => $data->toArray()
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['msg' => 'Terjadi Kesalahan Server..'], 500);
        }
    }
	
	public function getScoreAtj()
    {
        try {
            $packageId = request()->query->get('package');
           // $type = request()->query->get('type');
//            dd($packageId);
            $data = IndicatorAtj::with(['subIndicator.singleScore' => function ($query) use ($packageId) {
                $query->where('package_id', $packageId);
            }])->get();
            return response()->json([
                'msg' => 'success',
                'data' => [
                    'indicator' => $data->toArray()
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['msg' => 'Terjadi Kesalahan Server..'], 500);
        }
    }

    public function setScore()
    {
        try {
            $subIndicatorId = $this->postField('sub_indicator');
            $packageId = $this->postField('package');
            $value = (int)$this->postField('value');
            $type = $this->postField('index');
            $roles = $this->postField('roles');
            $authorId = Auth::id();
			$score = ScoreRksmkk::where('package_id', $packageId)->where('sub_indicator_id', $subIndicatorId)->first();
            $scoreText = 'tidak-ada';
            switch ($value) {
                case 1:
                    $scoreText = 'tidak_sempurna';
                    break;
                case 2:
                    $scoreText = 'ada';
                    break;
                default:
                    break;
            }
          if ($score !== null) {

                $score->score = $value;
                $score->text = $scoreText;
                $score->save();
            } else {
                $newScore = new ScoreRksmkk();
                $newScore->package_id = $packageId;
                $newScore->evaluator_id = $authorId;
                $newScore->sub_indicator_id = $subIndicatorId;
                $newScore->score = $value;
                $newScore->text = $scoreText;
            
                $newScore->save();
            }
            return response()->json(['msg' => 'success', 'code' => 200], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['msg' => 'Terjadi Kesalahan Server..' . $e], 500);
        }
    }
	public function setScoreRkkkonsultan()
    {
        try {
            $subIndicatorId = $this->postField('sub_indicator');
            $packageId = $this->postField('package');
            $value = (int)$this->postField('value');
            $type = $this->postField('index');
            $roles = $this->postField('roles');
            $authorId = Auth::id();
			$score = ScoreRkkkonsultan::where('package_id', $packageId)->where('sub_indicator_id', $subIndicatorId)->first();
            $scoreText = 'tidak-ada';
            switch ($value) {
                case 1:
                    $scoreText = 'tidak_sempurna';
                    break;
                case 2:
                    $scoreText = 'ada';
                    break;
                default:
                    break;
            }
          if ($score !== null) {

                $score->score = $value;
                $score->text = $scoreText;
                $score->save();
            } else {
                $newScore = new ScoreRkkkonsultan();
                $newScore->package_id = $packageId;
                $newScore->evaluator_id = $authorId;
                $newScore->sub_indicator_id = $subIndicatorId;
                $newScore->score = $value;
                $newScore->text = $scoreText;
            
                $newScore->save();
            }
            return response()->json(['msg' => 'success', 'code' => 200], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['msg' => 'Terjadi Kesalahan Server..' . $e], 500);
        }
    }
	
	public function setScoreRkkkontraktor()
    {
        try {
            $subIndicatorId = $this->postField('sub_indicator');
            $packageId = $this->postField('package');
            $value = (int)$this->postField('value');
            $type = $this->postField('index');
            $roles = $this->postField('roles');
            $authorId = Auth::id();
			$score = ScoreRkkkontraktor::where('package_id', $packageId)->where('sub_indicator_id', $subIndicatorId)->first();
            $scoreText = 'tidak-ada';
            switch ($value) {
                case 1:
                    $scoreText = 'tidak_sempurna';
                    break;
                case 2:
                    $scoreText = 'ada';
                    break;
                default:
                    break;
            }
          if ($score !== null) {

                $score->score = $value;
                $score->text = $scoreText;
                $score->save();
            } else {
                $newScore = new ScoreRkkkontraktor();
                $newScore->package_id = $packageId;
                $newScore->evaluator_id = $authorId;
                $newScore->sub_indicator_id = $subIndicatorId;
                $newScore->score = $value;
                $newScore->text = $scoreText;
            
                $newScore->save();
            }
            return response()->json(['msg' => 'success', 'code' => 200], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['msg' => 'Terjadi Kesalahan Server..' . $e], 500);
        }
    }

	public function setScoreRmpkpm()
    {
        try {
            $subIndicatorId = $this->postField('sub_indicator');
            $packageId = $this->postField('package');
            $value = (int)$this->postField('value');
            $type = $this->postField('index');
            $roles = $this->postField('roles');
            $authorId = Auth::id();
			$score = ScoreRmpkpm::where('package_id', $packageId)->where('sub_indicator_id', $subIndicatorId)->first();
            $scoreText = 'tidak-ada';
            switch ($value) {
                case 1:
                    $scoreText = 'tidak_sempurna';
                    break;
                case 2:
                    $scoreText = 'ada';
                    break;
                default:
                    break;
            }
          if ($score !== null) {

                $score->score = $value;
                $score->text = $scoreText;
                $score->save();
            } else {
                $newScore = new ScoreRmpkpm();
                $newScore->package_id = $packageId;
                $newScore->evaluator_id = $authorId;
                $newScore->sub_indicator_id = $subIndicatorId;
                $newScore->score = $value;
                $newScore->text = $scoreText;
            
                $newScore->save();
            }
            return response()->json(['msg' => 'success', 'code' => 200], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['msg' => 'Terjadi Kesalahan Server..' . $e], 500);
        }
    }

	public function setScoreRmllp()
    {
        try {
            $subIndicatorId = $this->postField('sub_indicator');
            $packageId = $this->postField('package');
            $value = (int)$this->postField('value');
            $type = $this->postField('index');
            $roles = $this->postField('roles');
            $authorId = Auth::id();
			$score = ScoreRmllp::where('package_id', $packageId)->where('sub_indicator_id', $subIndicatorId)->first();
            $scoreText = 'tidak-ada';
            switch ($value) {
                case 1:
                    $scoreText = 'tidak_sempurna';
                    break;
                case 2:
                    $scoreText = 'ada';
                    break;
                default:
                    break;
            }
          if ($score !== null) {

                $score->score = $value;
                $score->text = $scoreText;
                $score->save();
            } else {
                $newScore = new ScoreRmllp();
                $newScore->package_id = $packageId;
                $newScore->evaluator_id = $authorId;
                $newScore->sub_indicator_id = $subIndicatorId;
                $newScore->score = $value;
                $newScore->text = $scoreText;
            
                $newScore->save();
            }
            return response()->json(['msg' => 'success', 'code' => 200], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['msg' => 'Terjadi Kesalahan Server..' . $e], 500);
        }
    }
	
	public function setScoreRkpplkontraktor()
    {
        try {
            $subIndicatorId = $this->postField('sub_indicator');
            $packageId = $this->postField('package');
            $value = (int)$this->postField('value');
            $type = $this->postField('index');
            $roles = $this->postField('roles');
            $authorId = Auth::id();
			$score = ScoreRkpplkontraktor::where('package_id', $packageId)->where('sub_indicator_id', $subIndicatorId)->first();
            $scoreText = 'tidak-ada';
            switch ($value) {
                case 1:
                    $scoreText = 'tidak_sempurna';
                    break;
                case 2:
                    $scoreText = 'ada';
                    break;
                default:
                    break;
            }
          if ($score !== null) {

                $score->score = $value;
                $score->text = $scoreText;
                $score->save();
            } else {
                $newScore = new ScoreRkpplkontraktor();
                $newScore->package_id = $packageId;
                $newScore->evaluator_id = $authorId;
                $newScore->sub_indicator_id = $subIndicatorId;
                $newScore->score = $value;
                $newScore->text = $scoreText;
            
                $newScore->save();
            }
            return response()->json(['msg' => 'success', 'code' => 200], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['msg' => 'Terjadi Kesalahan Server..' . $e], 500);
        }
    }

	public function setScoreRkpplpengawasan()
    {
        try {
            $subIndicatorId = $this->postField('sub_indicator');
            $packageId = $this->postField('package');
            $value = (int)$this->postField('value');
            $type = $this->postField('index');
            $roles = $this->postField('roles');
            $authorId = Auth::id();
			$score = ScoreRkpplpengawasan::where('package_id', $packageId)->where('sub_indicator_id', $subIndicatorId)->first();
            $scoreText = 'tidak-ada';
            switch ($value) {
                case 1:
                    $scoreText = 'tidak_sempurna';
                    break;
                case 2:
                    $scoreText = 'ada';
                    break;
                default:
                    break;
            }
          if ($score !== null) {

                $score->score = $value;
                $score->text = $scoreText;
                $score->save();
            } else {
                $newScore = new ScoreRkpplpengawasan();
                $newScore->package_id = $packageId;
                $newScore->evaluator_id = $authorId;
                $newScore->sub_indicator_id = $subIndicatorId;
                $newScore->score = $value;
                $newScore->text = $scoreText;
            
                $newScore->save();
            }
            return response()->json(['msg' => 'success', 'code' => 200], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['msg' => 'Terjadi Kesalahan Server..' . $e], 500);
        }
    }

	public function setScoreRkpplperencanaan()
    {
        try {
            $subIndicatorId = $this->postField('sub_indicator');
            $packageId = $this->postField('package');
            $value = (int)$this->postField('value');
            $type = $this->postField('index');
            $roles = $this->postField('roles');
            $authorId = Auth::id();
			$score = ScoreRkpplperencanaan::where('package_id', $packageId)->where('sub_indicator_id', $subIndicatorId)->first();
            $scoreText = 'tidak-ada';
            switch ($value) {
                case 1:
                    $scoreText = 'tidak_sempurna';
                    break;
                case 2:
                    $scoreText = 'ada';
                    break;
                default:
                    break;
            }
          if ($score !== null) {

                $score->score = $value;
                $score->text = $scoreText;
                $score->save();
            } else {
                $newScore = new ScoreRkpplperencanaan();
                $newScore->package_id = $packageId;
                $newScore->evaluator_id = $authorId;
                $newScore->sub_indicator_id = $subIndicatorId;
                $newScore->score = $value;
                $newScore->text = $scoreText;
            
                $newScore->save();
            }
            return response()->json(['msg' => 'success', 'code' => 200], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['msg' => 'Terjadi Kesalahan Server..' . $e], 500);
        }
    }

	public function setScoreAtj()
    {
        try {
            $subIndicatorId = $this->postField('sub_indicator');
            $packageId = $this->postField('package');
            $value = (int)$this->postField('value');
            $type = $this->postField('index');
            $roles = $this->postField('roles');
            $authorId = Auth::id();
			$score = ScoreAtj::where('package_id', $packageId)->where('sub_indicator_id', $subIndicatorId)->first();
            $scoreText = 'tidak-ada';
            switch ($value) {
                case 1:
                    $scoreText = 'tidak_sempurna';
                    break;
                case 2:
                    $scoreText = 'ada';
                    break;
                default:
                    break;
            }
          if ($score !== null) {

                $score->score = $value;
                $score->text = $scoreText;
                $score->save();
            } else {
                $newScore = new ScoreAtj();
                $newScore->package_id = $packageId;
                $newScore->evaluator_id = $authorId;
                $newScore->sub_indicator_id = $subIndicatorId;
                $newScore->score = $value;
                $newScore->text = $scoreText;
            
                $newScore->save();
            }
            return response()->json(['msg' => 'success', 'code' => 200], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['msg' => 'Terjadi Kesalahan Server..' . $e], 500);
        }
    }

    private function saveHistory($data)
    {
        $packageId = $data['package_id'];
        $authorId = $data['author_id'];
        $subIndicatorId = $data['sub_indicator_id'];
        $type = $data['type'];
        $scoreBefore = $data['score_before'];
        $scoreTextBefore = $data['score_text_before'];
        $scoreNoteBefore = $data['note_before'];
        $fileBefore = $data['file_before'];
        $scoreAfter = $data['score_after'];
        $scoreTextAfter = $data['score_text_after'];
        $scoreNoteAfter = $data['note_after'];
        $fileAfter = $data['file_after'];
        $cumulativeBefore = $data['cumulative_before'];
        $cumulativeAfter = $data['cumulative_after'];

        $history = new ScoreHistory();
        $history->package_id = $packageId;
        $history->author_id = $authorId;
        $history->sub_indicator_id = $subIndicatorId;
        $history->type = $type;
        $history->score_before = $scoreBefore;
        $history->text_before = $scoreTextBefore;
        $history->file_before = $fileBefore;
        $history->note_before = $scoreNoteBefore;
        $history->score_after = $scoreAfter;
        $history->text_after = $scoreTextAfter;
        $history->file_after = $fileAfter;
        $history->note_after = $scoreNoteAfter;
        $history->score_total_before = $cumulativeBefore;
        $history->score_total_after = $cumulativeAfter;
        $history->save();
    }

    private function getCumulative($packageId, $type)
    {
        $data = IndicatorPerlem::with(['subIndicator.singleScore' => function ($query) use ($packageId, $type) {
            $query->where('package_id', $packageId)->where('type', $type);
        }])->get();
        $arrData = $data->toArray();
        $result = [];
        $chkSum = 0;
        $scoreMin = 1;
        $scoreMax = 4;
        $comulativeTotal = 0;
        $goodScore = 0;
        $mediumScore = 0;
        $badScore = 0;
        $veryBadScore = 0;
        $emptyScore = 0;
        foreach ($arrData as $v) {
            $index = $v['name'];
            $weight = $v['weight'];
            $value = 0;
            $subLength = count($v['sub_indicator']);
            $chkSum += $v['weight'];
            $min = ($scoreMin * $subLength);
            $max = ($scoreMax * $subLength);
            $maxFactor = round((100 * $weight), 2, PHP_ROUND_HALF_UP);
            $radarMin = 0;
            $radarMax = 10;
            $a = round(($radarMax - $radarMin) / ($max - $min), 3, PHP_ROUND_HALF_UP);
            $b = round($radarMax - ($max * $a), 0, PHP_ROUND_HALF_UP);
            foreach ($v['sub_indicator'] as $sub) {
                $tmpScore = $sub['single_score'] !== null ? $sub['single_score']['score'] : 0;
                $value += $tmpScore;
                if ($sub['single_score'] !== null) {
                    switch ($sub['single_score']['score']) {
                        case 1:
                            $veryBadScore += 1;
                            break;
                        case 2:
                            $badScore += 1;
                            break;
                        case 3:
                            $mediumScore += 1;
                            break;
                        case 4:
                            $goodScore += 1;
                            break;
                        default:
                            break;
                    }
                } else {
                    $emptyScore += 1;
                }
            }
            $checkConversion = ($a * $max) + $b;
            $a_cumulative = round(($maxFactor / ($max - $min)), 3, PHP_ROUND_HALF_UP);
            $b_cumulative = round(($maxFactor - ($max * $a_cumulative)), 3, PHP_ROUND_HALF_UP);
            $radar = 0;
            $cumulative = 0;
            if ($value > 0) {
                $radar = ($a * $value) + $b;
                $cumulative = ($a_cumulative * $value) + $b_cumulative;
                $comulativeTotal += round($cumulative, 2, PHP_ROUND_HALF_UP);
            }
            $transform = [
                'index' => $index,
                'weight' => $weight,
                'sub_length' => $subLength,
                'min' => $min,
                'max' => $max,
                'max_factor' => $maxFactor,
                'check_conversion' => round($checkConversion, 0, PHP_ROUND_HALF_UP),
                'a' => $a,
                'b' => $b,
                'a_cumulative' => $a_cumulative,
                'b_cumulative' => $b_cumulative,
                'value' => $value,
                'radar' => round($radar, 2, PHP_ROUND_HALF_UP),
                'cumulative' => round($cumulative, 2, PHP_ROUND_HALF_UP),
            ];
            array_push($result, $transform);
        }

        return round($comulativeTotal, 2, PHP_ROUND_HALF_UP);
    }

    public function getRadarChart()
    {
        try {
            $packageId = request()->query->get('package');
            $type = request()->query->get('type');
            $data = IndicatorPerlem::with(['subIndicator.singleScore' => function ($query) use ($packageId, $type) {
                $query->where('package_id', $packageId)->where('type', $type);
            }])->get();
            $arrData = $data->toArray();
            $result = [];
            $chkSum = 0;
            $scoreMin = 1;
            $scoreMax = 4;
            $comulativeTotal = 0;
            $goodScore = 0;
            $mediumScore = 0;
            $badScore = 0;
            $veryBadScore = 0;
            $emptyScore = 0;
            foreach ($arrData as $v) {
                $index = $v['name'];
                $weight = $v['weight'];
                $value = 0;
                $subLength = count($v['sub_indicator']);
                $chkSum += $v['weight'];
                $min = ($scoreMin * $subLength);
                $max = ($scoreMax * $subLength);
                $maxFactor = round((100 * $weight), 2, PHP_ROUND_HALF_UP);
                $radarMin = 0;
                $radarMax = 10;
                $a = round(($radarMax - $radarMin) / ($max - $min), 3, PHP_ROUND_HALF_UP);
                $b = round($radarMax - ($max * $a), 0, PHP_ROUND_HALF_UP);
                foreach ($v['sub_indicator'] as $sub) {
                    $tmpScore = $sub['single_score'] !== null ? $sub['single_score']['score'] : 0;
                    $value += $tmpScore;
                    if ($sub['single_score'] !== null) {
                        switch ($sub['single_score']['score']) {
                            case 1:
                                $veryBadScore += 1;
                                break;
                            case 2:
                                $badScore += 1;
                                break;
                            case 3:
                                $mediumScore += 1;
                                break;
                            case 4:
                                $goodScore += 1;
                                break;
                            default:
                                break;
                        }
                    } else {
                        $emptyScore += 1;
                    }
                }
                $checkConversion = ($a * $max) + $b;
                $a_cumulative = round(($maxFactor / ($max - $min)), 3, PHP_ROUND_HALF_UP);
                $b_cumulative = round(($maxFactor - ($max * $a_cumulative)), 3, PHP_ROUND_HALF_UP);
                $radar = 0;
                $cumulative = 0;
                if ($value > 0) {
                    $radar = ($a * $value) + $b;
                    $cumulative = ($a_cumulative * $value) + $b_cumulative;
                    $comulativeTotal += round($cumulative, 2, PHP_ROUND_HALF_UP);
                }
                $transform = [
                    'index' => $index,
                    'weight' => $weight,
                    'sub_length' => $subLength,
                    'min' => $min,
                    'max' => $max,
                    'max_factor' => $maxFactor,
                    'check_conversion' => round($checkConversion, 0, PHP_ROUND_HALF_UP),
                    'a' => $a,
                    'b' => $b,
                    'a_cumulative' => $a_cumulative,
                    'b_cumulative' => $b_cumulative,
                    'value' => $value,
                    'radar' => round($radar, 2, PHP_ROUND_HALF_UP),
                    'cumulative' => round($cumulative, 2, PHP_ROUND_HALF_UP),
                ];
                array_push($result, $transform);
            }
            return response()->json([
                'msg' => 'success',
                'data' => [
                    'indicator' => $result,
                    'chk_summary' => round($chkSum, 0, PHP_ROUND_HALF_UP),
                    'score_count' => [$emptyScore, $veryBadScore, $badScore, $mediumScore, $goodScore]
                ],
                'comulative' => round($comulativeTotal, 2, PHP_ROUND_HALF_UP)
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['msg' => 'Terjadi Kesalahan Server..' . $e], 500);
        }
    }

    public function getComutative($id)
    {
        $score = Score::where([['package_id', '=', $id], ['evaluator_id', '=', Auth::id()]])->groupBy(['score', 'text'])->selectRaw('sum(score) as score, text')->get();
        $total = 0;
        foreach ($score as $sc) {
            $total = $total + (int)$sc['score'];
        }
        Arr::set($score, 'total', $total);
        return $score;
    }

    public function uploadFile()
    {
        try {
            $authorId = Auth::id();
			$subIndicator = SubIndicatorRksmkk::find(request('id'));
			//$package = Package::find(request('packageId'));
			$package = Package::where('id', request('packageid'))->first();
            //$packageId = request('packageid');
			$tbl= request('tbl');
           
			if ($tbl === 'rksmkk'){
			$score = ScoreRksmkk::with(['package', 'subIndicator'])->where('package_id', request('packageid'))->where('sub_indicator_id', request('id'))->first();
				//$score = ScoreRksmkk::with(['package', 'subIndicator'])->find(request('id'));
				$newScore = new ScoreRksmkk();
			}
			if ($tbl === 'rkkkonsultan'){
				$score = ScoreRkkkonsultan::with(['package', 'subIndicator'])->where('package_id', request('packageid'))->where('sub_indicator_id', request('id'))->first();
				$newScore = new ScoreRkkkonsultan();
			}
			if ($tbl === 'rkkkontraktor'){
				$score = ScoreRkkkontraktor::with(['package', 'subIndicator'])->where('package_id', request('packageid'))->where('sub_indicator_id', request('id'))->first();
				$newScore = new ScoreRkkkontraktor();
			}
			if ($tbl === 'rmpkpm'){
				$score = ScoreRmpkpm::with(['package', 'subIndicator'])->where('package_id', request('packageid'))->where('sub_indicator_id', request('id'))->first();
				$newScore = new ScoreRmpkpm();
			}
			if ($tbl === 'rmllp'){
				$score = ScoreRmllp::with(['package', 'subIndicator'])->where('package_id', request('packageid'))->where('sub_indicator_id', request('id'))->first();
				$newScore = new ScoreRmllp();
			}
			if ($tbl === 'rkpplkontraktor'){
				$score = ScoreRkpplkontraktor::with(['package', 'subIndicator'])->where('package_id', request('packageid'))->where('sub_indicator_id', request('id'))->first();
				$newScore = new ScoreRkpplkontraktor();
			}
			if ($tbl === 'rkpplperencanaan'){
				$score = ScoreRkpplperencanaan::with(['package', 'subIndicator'])->where('package_id', request('packageid'))->where('sub_indicator_id', request('id'))->first();
				$newScore = new ScoreRkpplperencanaan();
			}
			if ($tbl === 'rkpplpengawasan'){
				$score = ScoreRkpplpengawasan::with(['package', 'subIndicator'])->where('package_id', request('packageid'))->where('sub_indicator_id', request('id'))->first();
				$newScore = new ScoreRkpplpengawasan();
			}
			if ($tbl === 'atj'){
				$score = ScoreAtj::with(['package', 'subIndicator'])->where('package_id', request('packageid'))->where('sub_indicator_id', request('id'))->first();
				$newScore = new ScoreAtj();
			}
			
				if ($score === null) { 
					
					$newScore->package_id = request('packageid');
					$newScore->evaluator_id = $authorId;
					$newScore->sub_indicator_id = $subIndicator->id;
					$files = $this->request->file('file');
					$extension = $files->getClientOriginalExtension();
					$name = str_replace(' ', '-', $package->name). '-' . $tbl . '-' . $subIndicator->id . '-' . strtotime("now");
					$value = $name . '.' . $extension;
					$stringImg = '/files_smkk/' . $value;
					$this->uploadImage('file', $value, 'filesUpload2');
					$newScore->file = $stringImg;
					$newScore->save();
				} else{
				DB::beginTransaction();
				$files = $this->request->file('file');
				$extension = $files->getClientOriginalExtension();
				$name = str_replace(' ', '-', $score->package->name). '-' . $tbl  . '-' . $score->subIndicator->id . '-' . strtotime("now");
				$value = $name . '.' . $extension;
				$stringImg = '/files_smkk/' . $value;
				$this->uploadImage('file', $value, 'filesUpload2');
				$scoreBefore = $score->score;
				$scoreTextBefore = $score->text;
				$scoreFileBefore = $score->file;
				$scoreNoteBefore = $score->note;
				$packageId = $score->package_id;
				$subIndicatorId = $score->sub_indicator_id;
				$score->update(['file' => $stringImg]);
			   
				DB::commit();
				return response()->json(['msg' => 'success'], 200);
				} 
		   
            
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['msg' => 'Terjadi Kesalahan Server..' . $e], 500);
        }
    }

    public function addNote()
    {
        try {
            $authorId = Auth::id();
            $score = Score::with(['package', 'subIndicator'])->find(request('id-note'));
            if ($score === null) {
                return response()->json(['msg' => 'Penilaian Sub Indicator Tidak Ditemukan...'], 202);
            }
            DB::beginTransaction();
            $scoreBefore = $score->score;
            $scoreTextBefore = $score->text;
            $scoreFileBefore = $score->file;
            $scoreNoteBefore = $score->note;
            $packageId = $score->package_id;
            $vType = $score->type;
            $subIndicatorId = $score->sub_indicator_id;

            $cumulativeBefore = $this->getCumulative($packageId, $vType);
            $score->update(['note' => request('note')]);
            $cumulativeAfter = $this->getCumulative($packageId, $vType);

            $data = [
                'package_id' => $packageId,
                'author_id' => $authorId,
                'sub_indicator_id' => $subIndicatorId,
                'type' => $vType,
                'score_before' => $scoreBefore,
                'score_text_before' => $scoreTextBefore,
                'file_before' => $scoreFileBefore,
                'note_before' => $scoreNoteBefore,
                'score_after' => $scoreBefore,
                'score_text_after' => $scoreTextBefore,
                'file_after' => $scoreFileBefore,
                'note_after' => request('note'),
                'cumulative_before' => $cumulativeBefore,
                'cumulative_after' => $cumulativeAfter,
            ];
            $this->saveHistory($data);
            DB::commit();
            return response()->json(['msg' => 'success'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['msg' => 'Terjadi Kesalahan Server..' . $e], 500);
        }
    }

    public function getScoreHistory()
    {
        try {
            $packageId = request()->query->get('package');
            $type = request()->query->get('type');
            $subIndicatorId = request()->query->get('sub');
            $history = ScoreHistory::with(['package', 'subIndicator'])
                ->where('package_id', $packageId)
                ->where('type', $type)
                ->where('sub_indicator_id', $subIndicatorId)
                ->orderBy('id', 'DESC')
                ->get();
            return response()->json(['msg' => 'success', 'data' => $history], 200);
        } catch (\Exception $e) {
            return response()->json(['msg' => 'Terjadi Kesalahan Server..' . $e], 500);
        }
    }

    public function getLastScoreHistory()
    {

        try {
            $packageId = request()->query->get('package');
            $type = request()->query->get('type');
            $subIndicatorId = request()->query->get('sub');
            $history = ScoreHistory::with(['package', 'subIndicator'])
                ->where('package_id', $packageId)
                ->where('type', $type)
                ->where('sub_indicator_id', $subIndicatorId)
                ->first();
            if ($history === null) {
                return response()->json(['msg' => 'Tidak Ada Riwayat...', 'code' => 202], 202);
            }
            return response()->json(['msg' => 'success', 'data' => $history, 'code' => 200], 200);
        } catch (\Exception $e) {
            return response()->json(['msg' => 'Terjadi Kesalahan Server..' . $e], 500);
        }
    }

    public function getAllCumulative()
    {
        try {
            $packageId = request()->query->get('package');
            $availableType = ['office', 'ppk', 'vendor'];
            $data = IndicatorPerlem::with(['subIndicator.cumulativeScore' => function ($query) use ($packageId) {
                $query->where('package_id', $packageId);
            }])->get();
            $tmp = [];
            $scoreMin = 1;
            $scoreMax = 4;
            $cumulative_total = 0;
            foreach ($data as $key => $indicator) {
                $subLength = count($indicator->subIndicator);
                $weight = $indicator->weight;
                $min = ($scoreMin * $subLength);
                $max = ($scoreMax * $subLength);
                $maxFactor = round((100 * $weight), 2, PHP_ROUND_HALF_UP);
                $radarMin = 0;
                $radarMax = 10;
                $value = 0;
                $a = round(($radarMax - $radarMin) / ($max - $min), 3, PHP_ROUND_HALF_UP);
                $b = round($radarMax - ($max * $a), 0, PHP_ROUND_HALF_UP);
                $tmpIndicator = [];
                $tmpIndicator['id'] = $indicator->id;
                $tmpIndicator['name'] = $indicator->name;
                $tmpIndicator['weight'] = $indicator->weight;
                $tmpIndicator['sub_indicator'] = [];
                foreach ($indicator->subIndicator as $key_sub => $sub_indicator) {
                    $tmp_cumulative = 0;
                    $arr_cumulative = $sub_indicator->cumulativeScore->toArray();
                    foreach ($availableType as $type) {
                        $key = array_search($type, array_column($arr_cumulative, 'type'));
                        $tmp_c['type'] = $type;
                        if ($key !== false) {
                            switch ($type) {
                                case 'office':
                                    $tmp_cumulative += round($arr_cumulative[$key]['score'] * 40 / 100, 2, PHP_ROUND_HALF_UP);
                                    break;
                                case 'ppk':
                                    $tmp_cumulative += round($arr_cumulative[$key]['score'] * 55 / 100, 2, PHP_ROUND_HALF_UP);
                                    break;
                                case 'vendor':
                                    $tmp_cumulative += round($arr_cumulative[$key]['score'] * 5 / 100, 2, PHP_ROUND_HALF_UP);
                                    break;
                                default:
                                    $tmp_cumulative += 0;
                                    break;
                            }
                        } else {
                            $tmp_cumulative += 0;
                        }
                    }
                    $value += $tmp_cumulative;
                    $tmpIndicator['sub_indicator'][$key_sub]['id'] = $sub_indicator->id;
                    $tmpIndicator['sub_indicator'][$key_sub]['name'] = $sub_indicator->name;
                    $tmpIndicator['sub_indicator'][$key_sub]['score'] = round($tmp_cumulative, 2, PHP_ROUND_HALF_UP);
                }
                $a_cumulative = round(($maxFactor / ($max - $min)), 3, PHP_ROUND_HALF_UP);
                $b_cumulative = round(($maxFactor - ($max * $a_cumulative)), 3, PHP_ROUND_HALF_UP);
                $radar = 0;
                $cumulative = 0;
                if ($value > 0) {
                    $radar = ($a * $value) + $b;
                    $cumulative = ($a_cumulative * $value) + $b_cumulative;
                    $cumulative_total += round($cumulative, 2, PHP_ROUND_HALF_UP);
                }
                $tmpIndicator['radar'] = $radar;
                array_push($tmp, $tmpIndicator);
            }


            return response()->json([
                'msg' => 'success',
                'data' => $tmp,
                'cumulative' => round($cumulative_total, 2, PHP_ROUND_HALF_UP),
                'code' => 200], 200);
        } catch (\Exception $e) {
            return response()->json(['msg' => 'Terjadi Kesalahan Server..' . $e], 500);
        }
    }
}
