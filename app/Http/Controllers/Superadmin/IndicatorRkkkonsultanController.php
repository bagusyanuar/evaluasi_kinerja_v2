<?php


namespace App\Http\Controllers\Superadmin;


use App\Helper\CustomController;
use App\Http\Controllers\Controller;
use App\Models\Accessor;
use App\Models\IndicatorRkkkonsultan;
use App\Models\SubIndicatorRkkkonsultan;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class IndicatorRkkkonsultanController extends Controller
{

    public function index()
    {
			
        if (request()->isMethod('POST')){
            return $this->store();
        }
       return view('superuser.indikator.indikatorRkkkonsultan');
    }

    public function store()
    {
        $field = [
          'name' => request('name'),
          //'weight' => (double)request('weight')
        ];
        if (request('id')){
            $indikatorRkkkonsultan = IndicatorRkkkonsultan::find(request('id'));
            $indikatorRkkkonsultan->update($field);
        }else{
            IndicatorRkkkonsultan::create($field);
        }
        return response()->json(['msg' => 'berhasil']);
    }

    public function getIndicatorRkkkonsultan(){
        $indicatorRkkkonsultan = IndicatorRkkkonsultan::with('subIndicator')->filter(request('cari'))->get();
        return $indicatorRkkkonsultan;
    }
	
    public function storeSubIndikatorRkkkonsultan($idIndikatorRkkkonsultan){
        $indikatorRkkkonsultan = IndicatorRkkkonsultan::find($idIndikatorRkkkonsultan);
        if (request('id')){
            $subIndikatorRkkkonsultan = SubIndicatorRkkkonsultan::find(request('id'));
            $subIndikatorRkkkonsultan->update(request()->all());
        }else{
            $indikatorRkkkonsultan->subIndicatorRkkkonsultan()->create(request()->all());
        }

        return response()->json(['msg' => 'success', 'data' => $idIndikatorRkkkonsultan]);
    }

    public function getSubIndicatorRkkkonsultan($id){
        $indicatorRkkkonsultan = SubIndicatorRkkkonsultan::where('indicator_id','=',$id)->get();
        return $indicatorRkkkonsultan;
    }

    public function deleteSubIndicatorRkkkonsultan($id, $subid){
        SubIndicatorRkkkonsultan::destroy($subid);
        return response()->json($id);
    }

    public function deleteIndicatorRkkkonsultan($id){
        IndicatorRkkkonsultan::destroy($id);
        return response()->json(['msg' => 'success']);
    }

}
