<?php

namespace App\Http\Controllers;

use App\Models\Indicator;
use App\Models\Package;
use App\Models\PPK;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class DashboardController extends Controller
{
    //

    public function index()
    {
        if ((\auth()->user()->roles[0] == 'superuser') || (\auth()->user()->roles[0] == 'admin')){
			return view('superuser/dashboard');
		}
        if ((\auth()->user()->roles[0] == 'vendor') || (\auth()->user()->roles[0] == 'accessor')) {
          //  $vendor = new VendorController();
           // return $vendor->detailVendor(Auth::id());
		    return view('superuser/menu');
    
        }
        //return view('superuser/dashboard');
        return view('superuser/menu');
    }
	public function sekejap()
    {
        if (\auth()->user()->roles[0] == 'vendor') {
            $vendor = new VendorController();
            return $vendor->detailVendor(Auth::id());
        }
        return view('superuser/dashboard');
        
    }


    public function getAllCountUser()
    {
        $user = User::count('*');

        return $user;
    }

    public function getAllCountPackage($tahun)
    {
        $package = Package::where(DB::raw('YEAR(start_at)'), '<=', $tahun)
            ->where(DB::raw('YEAR(finish_at)'), '>=', $tahun)->get();
        return count($package);
    }

    public function getAllCountPPK()
    {
        $ppk = PPK::count('*');

        return $ppk;
    }

    public function getAllCountIndikator()
    {
        $indikator = Indicator::count('*');

        return $indikator;
    }

    public function getAllCountData()
    {
        $tahun = \request()->query->get('tahun');
        $data = [
            'user' => $this->getAllCountUser(),
            'package' => $this->getAllCountPackage($tahun),
            'ppk' => $this->getAllCountPPK(),
            'indicator' => $this->getAllCountIndikator(),
        ];

        return $data;
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
}