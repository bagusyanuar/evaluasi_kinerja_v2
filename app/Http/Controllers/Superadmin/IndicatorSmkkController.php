<?php


namespace App\Http\Controllers\Superadmin;


use App\Helper\CustomController;
use App\Http\Controllers\Controller;
use App\Models\Accessor;
use App\Models\IndicatorRksmkk;;
use App\Models\IndicatorRkkkonsultan;
use App\Models\IndicatorRkkkontraktor;
use App\Models\IndicatorRmpkpm;
use App\Models\IndicatorRmllp;
use App\Models\SubIndicatorRksmkk;;
use App\Models\SubIndicatorRkkkonsultan;
use App\Models\SubIndicatorRkkkontraktor;
use App\Models\SubIndicatorRmpkpm;
use App\Models\SubIndicatorRmllp;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class IndicatorSmkkController extends Controller
{

    public function index()
    {
			
        if (request()->isMethod('POST')){
            return $this->store();
        }
       return view('superuser.indikator.indikatorsmkk');
    }

    public function store()
    {
        $field = [
          'name' => request('name'),
          //'weight' => (double)request('weight')
        ];
        if (request('id')){
            $indikatorRksmkk = IndicatorRksmkk::find(request('id'));
            $indikatorRksmkk->update($field);
        }else{
            IndicatorRksmkk::create($field);
        }
        return response()->json(['msg' => 'berhasil']);
    }

    public function getIndicatorRksmkk(){
        $indicatorRksmkk = IndicatorRksmkk::with('subIndicator')->filter(request('cari'))->get();
        return $indicatorRksmkk;
    }
	
    public function storeSubIndikatorRksmkk($idIndikatorRksmkk){
        $indikatorRksmkk = IndicatorRksmkk::find($idIndikatorRksmkk);
        if (request('id')){
            $subIndikatorRksmkk = SubIndicatorRksmkk::find(request('id'));
            $subIndikatorRksmkk->update(request()->all());
        }else{
            $indikatorRksmkk->subIndicatorRksmkk()->create(request()->all());
        }

        return response()->json(['msg' => 'success', 'data' => $idIndikatorRksmkk]);
    }

    public function getSubIndicatorRksmkk($id){
        $indicatorRksmkk = SubIndicatorRksmkk::where('indicator_id','=',$id)->get();
        return $indicatorRksmkk;
    }

    public function deleteSubIndicatorRksmkk($id, $subid){
        SubIndicator::destroy($subid);
        return response()->json($id);
    }

    public function deleteIndicatorRksmkk($id){
        IndicatorRksmkk::destroy($id);
        return response()->json(['msg' => 'success']);
    }

}
