<?php


namespace App\Http\Controllers;


use App\Helper\CustomController;
use App\Models\Indicator;
use App\Models\IndicatorPerlem;
use App\Models\Notification;
use App\Models\Package;
use App\Models\Score;
use App\Models\ScoreHistory;
use App\Models\SubIndicator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class PerlemController extends CustomController
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
        $roles = auth()->user()->roles[0];
        $userId = Auth::id();
        $query = $this->getDatatable();
        if ($roles === 'vendor') {
            $query->where('vendor_id', $userId);
        }

        if ($roles === 'accessorppk') {
            $query->whereHas('ppk.accessorppk.user', function ($query) use ($userId) {
                $query->where('id', $userId);
            });
        }
        return DataTables::of($query)->make(true);
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
        return view('superuser.penilaian.vendorperlem');
    }

    public function detail($id)
    {
        $roles = auth()->user()->roles[0];
        $userId = Auth::id();
        $query = Package::with(['vendor.vendor', 'ppk'])
            ->where('id', $id);
        if ($roles === 'vendor') {
            $query->where('vendor_id', $userId);
        }

        if ($roles === 'accessorppk') {
            $query->whereHas('ppk.accessorppk.user', function ($query) use ($userId) {
                $query->where('id', $userId);
            });
        }
//        $data = Package::with(['vendor.vendor', 'ppk'])->where('id', $id)->firstOrFail();
        $data = $query->firstOrFail();
        return view('superuser/penilaian/detail-penilaian')->with(['data' => $data]);
    }

    public function lastUpdate()
    {
        try {
            $packageId = request()->query->get('package');
            $type = request()->query->get('type');
            $score = Score::with('subIndicator')->where('package_id', $packageId)->where('type', $type)->orderBy('updated_at', 'DESC')->first();
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
            $type = request()->query->get('type');
            if (!$packageId) {
                return response()->json([
                    'code' => 202,
                    'msg' => 'Paket Tidak Di Temukan'
                ]);
            }
            $data = IndicatorPerlem::with(['subIndicator.singleScore' => function ($query) use ($packageId, $type) {
                $query->where('package_id', $packageId)->where('type', $type);
            }, 'subIndicator.scoreHistory' => function ($query) use ($packageId, $type) {
                $query->where('package_id', $packageId)->where('type', $type);
            }])->get();
            return response()->json([
                'msg' => 'success',
                'code' => 200,
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
            $authorId = Auth::id();
            $scoreText = 'very-bad';
            switch ($value) {
                case 1:
                    $scoreText = 'very-bad';
                    break;
                case 2:
                    $scoreText = 'bad';
                    break;
                case 3:
                    $scoreText = 'medium';
                    break;
                case 4:
                    $scoreText = 'good';
                    break;
                default:
                    break;
            }

            $vType = 'default';
            switch ($type) {
                case 'vendor':
                    $vType = 'vendor';
                    break;
                case 'accessor':
                    $vType = 'office';
                    break;
                case 'accessorppk':
                    $vType = 'ppk';
                    break;
                default:
                    break;
            }
            $score = Score::where('package_id', $packageId)->where('type', $vType)->where('sub_indicator_id', $subIndicatorId)->first();
            DB::beginTransaction();
            if ($score !== null) {
                $cumulativeBefore = $this->getCumulative($packageId, $vType);
                $scoreBefore = $score->score;
                $scoreTextBefore = $score->text;
                $scoreFileBefore = $score->file;
                $scoreNoteBefore = $score->note;
                $score->score = $value;
                $score->text = $scoreText;
                if ($value < 3) {
                    $files = $this->request->file('file');
                    $note = $this->postField('note');
                    if (!$files && $note === "") {
                        return response()->json(['msg' => 'Wajib Mengisi Salah Satu Lampiran', 'code' => 202], 202);
                    }

                    if ($files) {
                        $extension = $files->getClientOriginalExtension();
                        $name = str_replace(' ', '-', $score->package->name) . '-' . str_replace(' ', '-', $score->subIndicator->name) . strtotime("now");
                        $valueImage = $name . '.' . $extension;

                        $stringImg = '/files/' . $valueImage;
                        $this->uploadImage('file', $valueImage, 'filesUpload');
                        $score->file = $stringImg;
                    }

                    if ($note !== "") {
                        $score->note = $note;
                    }
                }

                $score->save();
                $cumulativeAfter = $this->getCumulative($packageId, $vType);

                if ($value >= 3 && $vType !== 'vendor') {
                    $notification = Notification::where('score_id', $score->id)->first();
                    if ($notification) {
                        $notification->is_active = false;
                        $notification->save();
                    }
                } else {
                    if ($vType !== 'vendor') {
                        $notification = Notification::where('score_id', $score->id)->first();
                        if ($notification) {
                            $notification->is_active = true;
                            $notification->save();
                        } else {
                            $newNotification = new Notification();
                            $package = Package::with('vendor')->find($packageId);
                            $subIndicator = SubIndicator::find($subIndicatorId);
                            $newNotification->title = 'Peringatan Nilai';
                            $newNotification->description = 'Hasil Penilaian dari Indikator ' . $subIndicator->name . ' Masih Belum Memenuhi Standar Baik. Silahkan Melakukan Perbaikan.';
                            $newNotification->vendor_id = $package->vendor->id;
                            $newNotification->sender_id = $authorId;
                            $newNotification->score_id = $score->id;
                            $newNotification->is_active = true;
                            $newNotification->type = $type;
                            $newNotification->save();
                        }
                    }
                }
                $data = [
                    'package_id' => $packageId,
                    'author_id' => $authorId,
                    'sub_indicator_id' => $subIndicatorId,
                    'type' => $vType,
                    'score_before' => $scoreBefore,
                    'score_text_before' => $scoreTextBefore,
                    'file_before' => $scoreFileBefore,
                    'note_before' => $scoreNoteBefore,
                    'score_after' => $value,
                    'score_text_after' => $scoreText,
                    'file_after' => $scoreFileBefore,
                    'note_after' => $scoreNoteBefore,
                    'cumulative_before' => $cumulativeBefore,
                    'cumulative_after' => $cumulativeAfter,
                ];

                $this->saveHistory($data);
            } else {
                $package = Package::find($packageId);
                $sub_indicator = SubIndicator::find($subIndicatorId);
                $newScore = new Score();
                $newScore->package_id = $packageId;
                $newScore->evaluator_id = $authorId;
                $newScore->author_id = $authorId;
                $newScore->sub_indicator_id = $subIndicatorId;
                $newScore->score = $value;
                $newScore->text = $scoreText;
                $newScore->type = $vType;
                if ($value < 3) {
                    $files = $this->request->file('file');
                    $note = $this->postField('note');
                    if (!$files && $note === "") {
                        return response()->json(['msg' => 'Wajib Mengisi Salah Satu Lampiran', 'code' => 202], 202);
                    }
                    if ($files) {
                        $extension = $files->getClientOriginalExtension();
                        $name = str_replace(' ', '-', $package->name) . '-' . str_replace(' ', '-', $sub_indicator->name) . strtotime("now");
                        $value = $name . '.' . $extension;

                        $stringImg = '/files/' . $value;
                        $this->uploadImage('file', $value, 'filesUpload');
                        $newScore->file = $stringImg;
                    }

                    if ($note !== "") {
                        $newScore->note = $note;
                    }
                }
                $newScore->save();

                if ($value < 3 && $vType !== 'vendor') {
                    $package = Package::with('vendor')->find($packageId);
                    $subIndicator = SubIndicator::find($subIndicatorId);
                    $notification = new Notification();
                    $notification->title = 'Peringatan Nilai';

                    $notification->description = 'Hasil Penilaian dari Indikator ' . $subIndicator->name . ' Masih Belum Memenuhi Standar Baik. Silahkan Melakukan Perbaikan.';
                    $notification->vendor_id = $package->vendor->id;
                    $notification->sender_id = $authorId;
                    $notification->score_id = $newScore->id;
                    $notification->is_active = true;
                    $notification->type = $type;
                    $notification->save();
                }
            }
            DB::commit();
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
            $score = Score::with(['package', 'subIndicator'])->find(request('id'));
            if ($score === null) {
                return response()->json(['msg' => 'Penilaian Sub Indicator Tidak Ditemukan...'], 202);
            }
            DB::beginTransaction();
//            if ($score->file) {
//                if (file_exists('../public' . $score->file)) {
//                    unlink('../public' . $score->file);
//                }
//            }
            $files = $this->request->file('file');
            $extension = $files->getClientOriginalExtension();
            $name = str_replace(' ', '-', $score->package->name) . '-' . str_replace(' ', '-', $score->subIndicator->name) . strtotime("now");
            $value = $name . '.' . $extension;

            $stringImg = '/files/' . $value;
            $this->uploadImage('file', $value, 'filesUpload');

            $scoreBefore = $score->score;
            $scoreTextBefore = $score->text;
            $scoreFileBefore = $score->file;
            $scoreNoteBefore = $score->note;
            $packageId = $score->package_id;
            $vType = $score->type;
            $subIndicatorId = $score->sub_indicator_id;

            $cumulativeBefore = $this->getCumulative($packageId, $vType);
            $score->update(['file' => $stringImg]);
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
                'file_after' => $stringImg,
                'note_after' => $scoreNoteBefore,
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
