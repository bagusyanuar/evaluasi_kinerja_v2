<?php


namespace App\Http\Controllers;


use App\Helper\CustomController;
use App\Models\AccessorPPK;
use App\Models\Indicator;
use App\Models\Package;
use App\Models\Score;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class VendorController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $vendors = Vendor::with('user')->get();
        return $vendors->toArray();
    }

    public function getVendorPackage()
    {
        $roles = auth()->user()->roles[0];
        $tahun = \request()->query->get('tahun');
        $package = User::with(['vendor', 'packageVendorGoing' => function ($q) use ($tahun) {
            $q->where(DB::raw('YEAR(package.start_at)'), '<=', $tahun)
                ->where(DB::raw('YEAR(finish_at)'), '>=', $tahun);
        }])->vendor(request('name'))->whereJsonContains('roles', 'vendor');
//        if ($roles == 'accessor'){
////            $package = $package->has('package');
//        }else if ($roles == 'admin' ||$roles == 'superadmin'){
//            $package = $package->has('package');
//        }else{
//            $package = $package->whereHas('package.ppk.accessorppk.user', function ($query){
//               $query->where('id',Auth::id());
//            });
//        }

        if ($roles == 'accessorppk') {
            $package = $package->whereHas('package.ppk.accessorppk.user', function ($query) {
                $query->where('id', Auth::id());
            });
        }

        return $package->get();
    }

    public function store()
    {
        try {
            DB::transaction(function () {
                $user = new User();
                $user->email = $this->postField('email');
                $user->username = $this->postField('username');
                $user->password = Hash::make($this->postField('password'));
                $user->roles = ["ROLE_VENDOR"];
                $user->save();

                $vendor = new Vendor();
                $vendor->name = $this->postField('name');
                $vendor->user_id = $user->id;
                $vendor->save();
            });
            return response()->json('success', 200);
        } catch (\Exception $e) {
            return response()->json($e, 500);
        }
    }

    public function detailVendor($id)
    {
        $vendor = User::with('vendor')->where('id', $id)->firstOrFail();
        $data = Package::with(['vendor'])
            ->where('vendor_id', $id)
            ->get();
        if (request('st') == 'past') {
            $data = Package::with(['vendor'])
                ->where('finish_at', '<', date('Y-m-d', strtotime(now('Asia/Jakarta'))))->where('vendor_id', $id)
                ->get();
        }
        return view('superuser/penilaian/index')->with(['data' => $data, 'vendor' => $vendor]);
    }

    public function detailPerlemVendor($id)
    {
        $vendor = User::with('vendor')->where('id', $id)->firstOrFail();
        $data = Package::with(['vendor'])
            ->where('vendor_id', $id)
            ->get();
        if (request('st') == 'past') {
            $data = Package::with(['vendor'])
                ->where('finish_at', '<', date('Y-m-d', strtotime(now('Asia/Jakarta'))))->where('vendor_id', $id)
                ->get();
        }
        return view('superuser/penilaian/perlem')->with(['data' => $data, 'vendor' => $vendor]);
    }

    public function detailThisVendor()
    {
        $id = Auth::id();
        $vendor = User::with('vendor')->where('id', $id)->firstOrFail();
        $data = Package::with(['vendor'])
            ->where('vendor_id', $id)
            ->get();
        if (request('st') == 'past') {
            $data = Package::with(['vendor'])
                ->where('finish_at', '<', date('Y-m-d', strtotime(now('Asia/Jakarta'))))->where('vendor_id', $id)
                ->get();
        }
        return view('superuser/penilaian/index')->with(['data' => $data, 'vendor' => $vendor]);
    }

    public function cetakPenilaian($id)
    {
        $html = $this->postField('hidden_html');
        $packageId = $this->postField('hidden_package');
        $package = Package::with(['ppk'])->where('id', $packageId)->first();
        $vendor = User::with('vendor')->where('id', $id)->firstOrFail();
        $cumulative = $this->getAllCumulative($packageId);
        $cumulative['text'] = $this->getCumulativeText($cumulative);
        $ppkCumulative = $this->getEachCumulative($packageId, 'ppk');
        $ppkCumulative['text'] = $this->getCumulativeText($ppkCumulative);
        $officeCumulative = $this->getEachCumulative($packageId, 'office');
        $officeCumulative['text'] = $this->getCumulativeText($officeCumulative);
        $vendorCumulative = $this->getEachCumulative($packageId, 'vendor');
        $vendorCumulative['text'] = $this->getCumulativeText($vendorCumulative);
        $tmpArr = [$vendorCumulative['last']->updated_at, $officeCumulative['last']->updated_at, $ppkCumulative['last']->updated_at];

        uasort($tmpArr, function ($a, $b) {
            return strtotime($b) - strtotime($a);
        });
        $arrLastUpdate = [];
        foreach ($tmpArr as $v) {
            array_push($arrLastUpdate, $v);
        }
        return $this->convertToPdf('superuser.penilaian.cetak', [
            'html' => $html,
            'vendor' => $vendor,
            'package' => $package,
            'cumulative' => $cumulative,
            'cumulativeLast' => count($arrLastUpdate) > 0 ? $arrLastUpdate[0] : '-',
            'ppkCumulative' => $ppkCumulative,
            'officeCumulative' => $officeCumulative,
            'vendorCumulative' => $vendorCumulative
        ]);
    }

    public function cetakPenilaianPerlem($id)
    {
        $html = $this->postField('hidden_html');
        $packageId = $this->postField('hidden_package');
        $package = Package::with(['ppk'])->where('id', $packageId)->first();
        $vendor = User::with('vendor')->where('id', $id)->firstOrFail();
        $cumulative = $this->getAllCumulative($packageId);
        $cumulative['text'] = $this->getCumulativeText($cumulative);
        $ppkCumulative = $this->getEachCumulative($packageId, 'ppk');
        $ppkCumulative['text'] = $this->getCumulativeText($ppkCumulative);
        $officeCumulative = $this->getEachCumulative($packageId, 'office');
        $officeCumulative['text'] = $this->getCumulativeText($officeCumulative);
        $vendorCumulative = $this->getEachCumulative($packageId, 'vendor');
        $vendorCumulative['text'] = $this->getCumulativeText($vendorCumulative);
        $tmpArr = [$vendorCumulative['last']->updated_at, $officeCumulative['last']->updated_at, $ppkCumulative['last']->updated_at];

        uasort($tmpArr, function ($a, $b) {
            return strtotime($b) - strtotime($a);
        });
        $arrLastUpdate = [];
        foreach ($tmpArr as $v) {
            array_push($arrLastUpdate, $v);
        }
        return $this->convertToPdf('superuser.penilaian.cetak', [
            'html' => $html,
            'vendor' => $vendor,
            'package' => $package,
            'cumulative' => $cumulative,
            'cumulativeLast' => count($arrLastUpdate) > 0 ? $arrLastUpdate[0] : '-',
            'ppkCumulative' => $ppkCumulative,
            'officeCumulative' => $officeCumulative,
            'vendorCumulative' => $vendorCumulative
        ]);
    }

    private function getCumulativeText($cumulative)
    {
        if ($cumulative['cumulative'] < 50) {
            return 'Sangat Kurang';
        } else if ($cumulative['cumulative'] < 64) {
            return 'Kurang';
        } else if ($cumulative['cumulative'] < 79) {
            return 'Cukup';
        } else if ($cumulative['cumulative'] < 90) {
            return 'Baik';
        } else if ($cumulative['cumulative'] < 100) {
            return 'Sangat Baik';
        } else {
            return '-';
        }
    }

    private function getAllCumulative($packageId)
    {
        $availableType = ['office', 'ppk', 'vendor'];
        $data = Indicator::with(['subIndicator.cumulativeScore' => function ($query) use ($packageId) {
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
                                $tmp_cumulative += round($arr_cumulative[$key]['score'] * 35 / 100, 2, PHP_ROUND_HALF_UP);
                                break;
                            case 'ppk':
                                $tmp_cumulative += round($arr_cumulative[$key]['score'] * 50 / 100, 2, PHP_ROUND_HALF_UP);
                                break;
                            case 'vendor':
                                $tmp_cumulative += round($arr_cumulative[$key]['score'] * 15 / 100, 2, PHP_ROUND_HALF_UP);
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
        return [
            'data' => $tmp,
            'cumulative' => round($cumulative_total, 2, PHP_ROUND_HALF_UP)
        ];
    }

    private function getEachCumulative($packageId, $type)
    {

        $data = Indicator::with(['subIndicator.singleScore' => function ($query) use ($packageId, $type) {
            $query->where('package_id', $packageId)->where('type', $type);
        }])->get();
        $score = Score::with('subIndicator')->where('package_id', $packageId)->where('type', $type)->orderBy('updated_at', 'DESC')->first();
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

        $scoreAll = Score::with('subIndicator')->where('package_id', $packageId)->where('type', $type)->get();
        $very_bad = $scoreAll->filter(function ($item) {
            return $item->score === 1;
        })->values();
        $bad = $scoreAll->filter(function ($item) {
            return $item->score === 2;
        })->values();
        $medium = $scoreAll->filter(function ($item) {
            return $item->score === 3;
        })->values();
        $good = $scoreAll->filter(function ($item) {
            return $item->score === 4;
        })->values();
        return [
            'cumulative' => round($comulativeTotal, 2, PHP_ROUND_HALF_UP),
            'last' => $score,
            'very_bad' => $very_bad,
            'bad' => $bad,
            'medium' => $medium,
            'good' => $good,
        ];
    }

    public function get_vendor_package_by_year($id)
    {
        $tahun = \request()->query->get('tahun');
        return Package::with(['vendor'])
            ->where('vendor_id', '=', $id)
            ->where(DB::raw('YEAR(start_at)'), '<=', $tahun)
            ->where(DB::raw('YEAR(finish_at)'), '>=', $tahun)
            ->get();
    }

}