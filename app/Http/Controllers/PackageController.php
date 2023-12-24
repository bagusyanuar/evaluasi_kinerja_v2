<?php


namespace App\Http\Controllers;


use App\Helper\CustomController;
use App\Models\Package;
use App\Models\PackageDetail;
use App\Models\PPK;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class PackageController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function datatable()
    {
        /* $now = Carbon::now()->isoFormat('YYYY-MM-DD');
        $tahun = \request()->query->get('tahun');
        $data = Package::with(['vendor.vendor', 'ppk'])
            ->where(DB::raw('YEAR(start_at)'), '<=', $tahun)
            ->where(DB::raw('YEAR(finish_at)'), '>=', $tahun)
            ->get();
        return DataTables::of($data)->make(true); */
		$data = Package::with(['vendor.vendor', 'ppk'])->get();
        return DataTables::of($data)->make(true);
    }

    public function index()
    {
        if (\request()->isMethod('POST')) {
            return $this->store();
        }
        $ppk = PPK::all();
        $vendor = Vendor::with('user')->get();
        return view('superuser/paket-konstruksi/paketKonstruksi')->with(['ppk' => $ppk, 'vendor' => $vendor]);
    }

    public function store()
    {
        try {
            $start = strtotime($this->postField('start'));
            $finish = strtotime($this->postField('finish'));
            $date_contract = strtotime($this->postField('date_contract'));

            if (request('id')) {
                $package = Package::find(request('id'));
                $package->name = $this->postField('name');
                $package->vendor_id = $this->postField('vendor');
                $package->ppk_id = $this->postField('ppk');
                $package->no_reference = $this->postField('reference');
                $package->start_at = date('Y-m-d', $start);
                $package->finish_at = date('Y-m-d', $finish);
                $package->date = date('Y-m-d', $date_contract);
                $package->update();
            } else {
                $package = new Package();
                $package->name = $this->postField('name');
                $package->vendor_id = $this->postField('vendor');
                $package->ppk_id = $this->postField('ppk');
                $package->no_reference = $this->postField('reference');
                $package->start_at = date('Y-m-d', $start);
                $package->finish_at = date('Y-m-d', $finish);
                $package->date = date('Y-m-d', $date_contract);
                $package->save();
            }
            return response()->json(['msg' => 'success']);
        } catch (\Exception $e) {
            return response()->json(['msg' => 'Terjadi Kesalahan Pada Server'], 500);
        }
    }

    public function datatableAddendum($id)
    {
        $data = PackageDetail::with(['package'])->where('package_id', $id)->get();
        return DataTables::of($data)->make(true);
    }

    public function detail($id)
    {
        if (request()->isMethod('POST')) {
            return $this->store();
        }
        $data = Package::with(['vendor.vendor', 'ppk'])->where('id', $id)->firstOrFail();
        $ppk = PPK::all();
        $vendor = Vendor::with('user')->get();
        return view('superuser.paket-konstruksi.detail')->with(['data' => $data, 'ppk' => $ppk, 'vendor' => $vendor]);
    }


    public function addDetail()
    {
        try {
            $date = strtotime($this->postField('date_addendum'));
            $packageId = $this->postField('package_id');
            $package = Package::where('id', $packageId)->first();
            if (!$package) {
                return response()->json(['msg' => 'Paket Tidak Di Temukan'], 500);
            }
            if (request('id')) {
                $packageDetail = PackageDetail::find(request('id'));
                $packageDetail->package_id = $package->id;
                $packageDetail->no_reference = $this->postField('addendum_reference');
                $packageDetail->date_addendum = date('Y-m-d', $date);
                $packageDetail->update();
            } else {
                $packageDetail = new PackageDetail();
                $packageDetail->package_id = $package->id;
                $packageDetail->no_reference = $this->postField('addendum_reference');
                $packageDetail->date_addendum = date('Y-m-d', $date);
                $packageDetail->save();
            }

            return response()->json(['msg' => 'success', 'data' => $package]);
        } catch (\Exception $e) {
            return response()->json(['msg' => 'Terjadi Kesalahan Pada Server' . $e], 500);
        }
    }

    public function getDetailPackage()
    {
        try {
            $id = request()->query->get('package');
            $package = Package::with(['vendor', 'ppk'])->find($id);
            if (!$package) {
                return response()->json(['msg' => 'success', 'code' => 202]);
            }
            return response()->json(['msg' => 'success', 'code' => 200, 'data' => $package]);
        } catch (\Exception $e) {
            return response()->json(['msg' => 'Terjadi Kesalahan Pada Server' . $e], 500);
        }
    }
}