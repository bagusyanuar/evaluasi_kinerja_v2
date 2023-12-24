<?php


namespace App\Http\Controllers\Superadmin;


use App\Helper\CustomController;
use App\Http\Controllers\Controller;
use App\Models\Accessor;
use App\Models\IndicatorAtj;
use App\Models\SubIndicatorAtj;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class IndicatorAtjController extends Controller
{     

    public function index()
    {
			
        if (request()->isMethod('POST')){
            return $this->store();
        }
       return view('superuser.indikator.indikatorAtj');
    }

    public function store()
    {
        $field = [
          'name' => request('name'),
          //'weight' => (double)request('weight')
        ];
        if (request('id')){
            $indikatorAtj = IndicatorAtj::find(request('id'));
            $indikatorAtj->update($field);
        }else{
            IndicatorAtj::create($field);
        }
        return response()->json(['msg' => 'berhasil']);
    }

    public function getIndicatorAtj(){
        $indicatorAtj = IndicatorAtj::with('subIndicator')->filter(request('cari'))->get();
        return $indicatorAtj;
    }
	
    public function storeSubIndikatorAtj($idIndikatorAtj){
        $indikatorAtj = IndicatorAtj::find($idIndikatorAtj);
        if (request('id')){
            $subIndikatorAtj = SubIndicatorAtj::find(request('id'));
            $subIndikatorAtj->update(request()->all());
        }else{
            $indikatorAtj->subIndicatorAtj()->create(request()->all());
        }

        return response()->json(['msg' => 'success', 'data' => $idIndikatorAtj]);
    }

    public function getSubIndicatorAtj($id){
        $indicatorAtj = SubIndicatorAtj::where('indicator_id','=',$id)->get();
        return $indicatorAtj;
    }

    public function deleteSubIndicatorAtj($id, $subid){
        SubIndicatorAtj::destroy($subid);
        return response()->json($id);
    }

    public function deleteIndicatorAtj($id){
        IndicatorAtj::destroy($id);
        return response()->json(['msg' => 'success']);
    }

}
