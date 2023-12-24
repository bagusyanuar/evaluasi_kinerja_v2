<?php


namespace App\Http\Controllers\Superadmin;


use App\Helper\CustomController;
use App\Http\Controllers\Controller;
use App\Models\Accessor;
use App\Models\IndicatorRmpkpm;
use App\Models\SubIndicatorRmpkpm;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class IndicatorRmpkpmController extends Controller
{     

    public function index()
    {
			
        if (request()->isMethod('POST')){
            return $this->store();
        }
       return view('superuser.indikator.indikatorRmpkpm');
    }

    public function store()
    {
        $field = [
          'name' => request('name'),
          //'weight' => (double)request('weight')
        ];
        if (request('id')){
            $indikatorRmpkpm = IndicatorRmpkpm::find(request('id'));
            $indikatorRmpkpm->update($field);
        }else{
            IndicatorRmpkpm::create($field);
        }
        return response()->json(['msg' => 'berhasil']);
    }

    public function getIndicatorRmpkpm(){
        $indicatorRmpkpm = IndicatorRmpkpm::with('subIndicator')->filter(request('cari'))->get();
        return $indicatorRmpkpm;
    }
	
    public function storeSubIndikatorRmpkpm($idIndikatorRmpkpm){
        $indikatorRmpkpm = IndicatorRmpkpm::find($idIndikatorRmpkpm);
        if (request('id')){
            $subIndikatorRmpkpm = SubIndicatorRmpkpm::find(request('id'));
            $subIndikatorRmpkpm->update(request()->all());
        }else{
            $indikatorRmpkpm->subIndicatorRmpkpm()->create(request()->all());
        }

        return response()->json(['msg' => 'success', 'data' => $idIndikatorRmpkpm]);
    }

    public function getSubIndicatorRmpkpm($id){
        $indicatorRmpkpm = SubIndicatorRmpkpm::where('indicator_id','=',$id)->get();
        return $indicatorRmpkpm;
    }

    public function deleteSubIndicatorRmpkpm($id, $subid){
        SubIndicatorRmpkpm::destroy($subid);
        return response()->json($id);
    }

    public function deleteIndicatorRmpkpm($id){
        IndicatorRmpkpm::destroy($id);
        return response()->json(['msg' => 'success']);
    }

}
