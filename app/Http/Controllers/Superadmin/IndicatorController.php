<?php


namespace App\Http\Controllers\Superadmin;


use App\Helper\CustomController;
use App\Http\Controllers\Controller;
use App\Models\Accessor;
use App\Models\Indicator;
use App\Models\IndicatorPerlem;
use App\Models\SubIndicator;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class IndicatorController extends Controller
{

    public function index()
    {
		$perlem = IndicatorPerlem::all();
			
        if (request()->isMethod('POST')){
            return $this->store();
        }
       return view('superuser.indikator.indikator')->with(['perlem'=>$perlem]);
    }

    public function store()
    {
        $field = [
          'name' => request('name'),
          'weight' => (double)request('weight')
        ];
        if (request('id')){
            $indikator = Indicator::find(request('id'));
            $indikator->update($field);
        }else{
            Indicator::create($field);
        }
        return response()->json(['msg' => 'berhasil']);
    }

    public function getIndicator(){
		//$first = SubIndicator::join('IndicatorPerlem','SubIndicator.indicator_perlem_id','=','IndicatorPerlem.id','left outer')
        $indicator = Indicator::with('subIndicator','subIndicator.indicatorPerlem')->filter(request('cari'))->get();
        return $indicator;
    }
	
	public function getIndicatorperlem(){
        $indicator = IndicatorPerlem::all();
        return $indicator;
    }
	
    public function storeSubIndikator($idIndikator){
        $indikator = Indicator::find($idIndikator);
        if (request('id')){
            $subIndikator = SubIndicator::find(request('id'));
            $subIndikator->update(request()->all());
        }else{
            $indikator->subIndicator()->create(request()->all());
        }

        return response()->json(['msg' => 'success', 'data' => $idIndikator]);
    }

    public function getSubIndicator($id){
        $indicator = SubIndicator::where('indicator_id','=',$id)->get();
        return $indicator;
    }

    public function deleteSubIndicator($id, $subid){
        SubIndicator::destroy($subid);
        return response()->json($id);
    }

    public function deleteIndicator($id){
        Indicator::destroy($id);
        return response()->json(['msg' => 'success']);
    }

    public function getTotalBobot(){
        $indicator = Indicator::sum('weight');
        return $indicator;
    }
}
