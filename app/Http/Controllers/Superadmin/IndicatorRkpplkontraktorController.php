<?php


namespace App\Http\Controllers\Superadmin;


use App\Helper\CustomController;
use App\Http\Controllers\Controller;
use App\Models\Accessor;
use App\Models\IndicatorRkpplkontraktor;
use App\Models\SubIndicatorRkpplkontraktor;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class IndicatorRkpplkontraktorController extends Controller
{     

    public function index()
    {
			
        if (request()->isMethod('POST')){
            return $this->store();
        }
       return view('superuser.indikator.indikatorRkpplkontraktor');
    }

    public function store()
    {
        $field = [
          'name' => request('name'),
          //'weight' => (double)request('weight')
        ];
        if (request('id')){
            $indikatorRkpplkontraktor = IndicatorRkpplkontraktor::find(request('id'));
            $indikatorRkpplkontraktor->update($field);
        }else{
            IndicatorRkpplkontraktor::create($field);
        }
        return response()->json(['msg' => 'berhasil']);
    }

    public function getIndicatorRkpplkontraktor(){
        $indicatorRkpplkontraktor = IndicatorRkpplkontraktor::with('subIndicator')->filter(request('cari'))->get();
        return $indicatorRkpplkontraktor;
    }
	
    public function storeSubIndikatorRkpplkontraktor($idIndikatorRkpplkontraktor){
        $indikatorRkpplkontraktor = IndicatorRkpplkontraktor::find($idIndikatorRkpplkontraktor);
        if (request('id')){
            $subIndikatorRkpplkontraktor = SubIndicatorRkpplkontraktor::find(request('id'));
            $subIndikatorRkpplkontraktor->update(request()->all());
        }else{
            $indikatorRkpplkontraktor->subIndicatorRkpplkontraktor()->create(request()->all());
        }

        return response()->json(['msg' => 'success', 'data' => $idIndikatorRkpplkontraktor]);
    }

    public function getSubIndicatorRkpplkontraktor($id){
        $indicatorRkpplkontraktor = SubIndicatorRkpplkontraktor::where('indicator_id','=',$id)->get();
        return $indicatorRkpplkontraktor;
    }

    public function deleteSubIndicatorRkpplkontraktor($id, $subid){
        SubIndicatorRkpplkontraktor::destroy($subid);
        return response()->json($id);
    }

    public function deleteIndicatorRkpplkontraktor($id){
        IndicatorRkpplkontraktor::destroy($id);
        return response()->json(['msg' => 'success']);
    }

}
