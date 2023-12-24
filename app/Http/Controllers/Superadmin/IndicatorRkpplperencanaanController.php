<?php


namespace App\Http\Controllers\Superadmin;


use App\Helper\CustomController;
use App\Http\Controllers\Controller;
use App\Models\Accessor;
use App\Models\IndicatorRkpplperencanaan;
use App\Models\SubIndicatorRkpplperencanaan;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class IndicatorRkpplperencanaanController extends Controller
{     

    public function index()
    {
			
        if (request()->isMethod('POST')){
            return $this->store();
        }
       return view('superuser.indikator.indikatorRkpplperencanaan');
    }

    public function store()
    {
        $field = [
          'name' => request('name'),
          //'weight' => (double)request('weight')
        ];
        if (request('id')){
            $indikatorRkpplperencanaan = IndicatorRkpplperencanaan::find(request('id'));
            $indikatorRkpplperencanaan->update($field);
        }else{
            IndicatorRkpplperencanaan::create($field);
        }
        return response()->json(['msg' => 'berhasil']);
    }

    public function getIndicatorRkpplperencanaan(){
        $indicatorRkpplperencanaan = IndicatorRkpplperencanaan::with('subIndicator')->filter(request('cari'))->get();
        return $indicatorRkpplperencanaan;
    }
	
    public function storeSubIndikatorRkpplperencanaan($idIndikatorRkpplperencanaan){
        $indikatorRkpplperencanaan = IndicatorRkpplperencanaan::find($idIndikatorRkpplperencanaan);
        if (request('id')){
            $subIndikatorRkpplperencanaan = SubIndicatorRkpplperencanaan::find(request('id'));
            $subIndikatorRkpplperencanaan->update(request()->all());
        }else{
            $indikatorRkpplperencanaan->subIndicatorRkpplperencanaan()->create(request()->all());
        }

        return response()->json(['msg' => 'success', 'data' => $idIndikatorRkpplperencanaan]);
    }

    public function getSubIndicatorRkpplperencanaan($id){
        $indicatorRkpplperencanaan = SubIndicatorRkpplperencanaan::where('indicator_id','=',$id)->get();
        return $indicatorRkpplperencanaan;
    }

    public function deleteSubIndicatorRkpplperencanaan($id, $subid){
        SubIndicatorRkpplperencanaan::destroy($subid);
        return response()->json($id);
    }

    public function deleteIndicatorRkpplperencanaan($id){
        IndicatorRkpplperencanaan::destroy($id);
        return response()->json(['msg' => 'success']);
    }

}
