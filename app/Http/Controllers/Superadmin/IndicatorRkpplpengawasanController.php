<?php


namespace App\Http\Controllers\Superadmin;


use App\Helper\CustomController;
use App\Http\Controllers\Controller;
use App\Models\Accessor;
use App\Models\IndicatorRkpplpengawasan;
use App\Models\SubIndicatorRkpplpengawasan;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class IndicatorRkpplpengawasanController extends Controller
{     

    public function index()
    {
			
        if (request()->isMethod('POST')){
            return $this->store();
        }
       return view('superuser.indikator.indikatorRkpplpengawasan');
    }

    public function store()
    {
        $field = [
          'name' => request('name'),
          //'weight' => (double)request('weight')
        ];
        if (request('id')){
            $indikatorRkpplpengawasan = IndicatorRkpplpengawasan::find(request('id'));
            $indikatorRkpplpengawasan->update($field);
        }else{
            IndicatorRkpplpengawasan::create($field);
        }
        return response()->json(['msg' => 'berhasil']);
    }

    public function getIndicatorRkpplpengawasan(){
        $indicatorRkpplpengawasan = IndicatorRkpplpengawasan::with('subIndicator')->filter(request('cari'))->get();
        return $indicatorRkpplpengawasan;
    }
	
    public function storeSubIndikatorRkpplpengawasan($idIndikatorRkpplpengawasan){
        $indikatorRkpplpengawasan = IndicatorRkpplpengawasan::find($idIndikatorRkpplpengawasan);
        if (request('id')){
            $subIndikatorRkpplpengawasan = SubIndicatorRkpplpengawasan::find(request('id'));
            $subIndikatorRkpplpengawasan->update(request()->all());
        }else{
            $indikatorRkpplpengawasan->subIndicatorRkpplpengawasan()->create(request()->all());
        }

        return response()->json(['msg' => 'success', 'data' => $idIndikatorRkpplpengawasan]);
    }

    public function getSubIndicatorRkpplpengawasan($id){
        $indicatorRkpplpengawasan = SubIndicatorRkpplpengawasan::where('indicator_id','=',$id)->get();
        return $indicatorRkpplpengawasan;
    }

    public function deleteSubIndicatorRkpplpengawasan($id, $subid){
        SubIndicatorRkpplpengawasan::destroy($subid);
        return response()->json($id);
    }

    public function deleteIndicatorRkpplpengawasan($id){
        IndicatorRkpplpengawasan::destroy($id);
        return response()->json(['msg' => 'success']);
    }

}
