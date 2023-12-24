<?php


namespace App\Http\Controllers\Superadmin;


use App\Helper\CustomController;
use App\Http\Controllers\Controller;
use App\Models\Accessor;
use App\Models\IndicatorRmllp;
use App\Models\SubIndicatorRmllp;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class IndicatorRmllpController extends Controller
{     

    public function index()
    {
			
        if (request()->isMethod('POST')){
            return $this->store();
        }
       return view('superuser.indikator.indikatorRmllp');
    }

    public function store()
    {
        $field = [
          'name' => request('name'),
          //'weight' => (double)request('weight')
        ];
        if (request('id')){
            $indikatorRmllp = IndicatorRmllp::find(request('id'));
            $indikatorRmllp->update($field);
        }else{
            IndicatorRmllp::create($field);
        }
        return response()->json(['msg' => 'berhasil']);
    }

    public function getIndicatorRmllp(){
        $indicatorRmllp = IndicatorRmllp::with('subIndicator')->filter(request('cari'))->get();
        return $indicatorRmllp;
    }
	
    public function storeSubIndikatorRmllp($idIndikatorRmllp){
        $indikatorRmllp = IndicatorRmllp::find($idIndikatorRmllp);
        if (request('id')){
            $subIndikatorRmllp = SubIndicatorRmllp::find(request('id'));
            $subIndikatorRmllp->update(request()->all());
        }else{
            $indikatorRmllp->subIndicatorRmllp()->create(request()->all());
        }

        return response()->json(['msg' => 'success', 'data' => $idIndikatorRmllp]);
    }

    public function getSubIndicatorRmllp($id){
        $indicatorRmllp = SubIndicatorRmllp::where('indicator_id','=',$id)->get();
        return $indicatorRmllp;
    }

    public function deleteSubIndicatorRmllp($id, $subid){
        SubIndicatorRmllp::destroy($subid);
        return response()->json($id);
    }

    public function deleteIndicatorRmllp($id){
        IndicatorRmllp::destroy($id);
        return response()->json(['msg' => 'success']);
    }

}
