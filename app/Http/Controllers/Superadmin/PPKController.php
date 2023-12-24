<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\PPK;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PPKController extends Controller
{
    //
    public function datatable(){
        return DataTables::of(PPK::all())->make(true);
    }

    public function index(){
        if (\request()->isMethod('POST')){
            return $this->store();
        }
        return view('superuser.ppk.ppk');
    }

    public function store(){
        if (\request('id')){
            $ppk = PPK::find(\request('id'));
            $ppk->update(\request()->all());
        }else{
            PPK::create(\request()->all());
        }

        return response()->json(['msg' => 'success']);
    }

    public function getPPK(){
        $ppk = PPK::all();
        return $ppk;
    }

    public function delete($id){
        PPK::destroy($id);
        return response()->json(['msg' => 'success']);
    }

}
