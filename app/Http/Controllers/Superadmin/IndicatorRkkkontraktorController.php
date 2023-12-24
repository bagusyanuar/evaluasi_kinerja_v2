<?php


namespace App\Http\Controllers\Superadmin;


use App\Helper\CustomController;
use App\Http\Controllers\Controller;
use App\Models\Accessor;
use App\Models\IndicatorRkkkontraktor;
use App\Models\SubIndicatorRkkkontraktor;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class IndicatorRkkkontraktorController extends Controller
{

    public function index()
    {
			
        if (request()->isMethod('POST')){
            return $this->store();
        }
       return view('superuser.indikator.indikatorRkkkontraktor');
    }

    public function store()
    {
        $field = [
          'name' => request('name'),
          //'weight' => (double)request('weight')
        ];
        if (request('id')){
            $indikatorRkkkontraktor = IndicatorRkkkontraktor::find(request('id'));
            $indikatorRkkkontraktor->update($field);
        }else{
            IndicatorRkkkontraktor::create($field);
        }
        return response()->json(['msg' => 'berhasil']);
    }

    public function getIndicatorRkkkontraktor(){
        $indicatorRkkkontraktor = IndicatorRkkkontraktor::with('subIndicator')->filter(request('cari'))->get();
        return $indicatorRkkkontraktor;
    }
	
    public function storeSubIndikatorRkkkontraktor($idIndikatorRkkkontraktor){
        $indikatorRkkkontraktor = IndicatorRkkkontraktor::find($idIndikatorRkkkontraktor);
        if (request('id')){
            $subIndikatorRkkkontraktor = SubIndicatorRkkkontraktor::find(request('id'));
            $subIndikatorRkkkontraktor->update(request()->all());
        }else{
            $indikatorRkkkontraktor->subIndicatorRkkkontraktor()->create(request()->all());
        }

        return response()->json(['msg' => 'success', 'data' => $idIndikatorRkkkontraktor]);
    }

    public function getSubIndicatorRkkkontraktor($id){
        $indicatorRkkkontraktor = SubIndicatorRkkkontraktor::where('indicator_id','=',$id)->get();
        return $indicatorRkkkontraktor;
    }

    public function deleteSubIndicatorRkkkontraktor($id, $subid){
        SubIndicatorRkkkontraktor::destroy($subid);
        return response()->json($id);
    }

    public function deleteIndicatorRkkkontraktor($id){
        IndicatorRkkkontraktor::destroy($id);
        return response()->json(['msg' => 'success']);
    }

}
