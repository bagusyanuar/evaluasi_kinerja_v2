<?php


namespace App\Http\Controllers\Superadmin;


use App\Http\Controllers\Controller;
use App\Models\Stage;
use App\Models\StageIndicator;
use App\Models\StageSubIndicator;
use App\Models\SubStage;
use Yajra\DataTables\DataTables;

class IndicatorSMKKV2Controller extends Controller
{

    private function generateDataStage()
    {
        return Stage::with([])->get();
    }

    public function index()
    {
        if (request()->ajax()) {
            $data = $this->generateDataStage();
            return DataTables::of($data)->addIndexColumn()->make(true);
        }

        if (request()->method() === 'POST') {
            try {
                $data_request = [
                    'name' => request()->request->get('name'),
                    'index' => 1
                ];
                Stage::create($data_request);
                return redirect()->back()->with('success', 'success');
            } catch (\Exception $e) {
                return redirect()->back()->with('failed', 'internal server error');
            }
        }
        return view('superuser.indicator-v2.index');
    }

    public function detail($id)
    {
        $stage = Stage::with(['sub_stages.indicators.sub_indicators'])->findOrFail($id);
        if (request()->method() === 'POST') {
            try {
                $data_request = [
                    'stage_id' => $stage->id,
                    'name' => request()->request->get('name'),
                    'index' => 1
                ];
                SubStage::create($data_request);
                return redirect()->back()->with('success', 'Berhasil Menambahkan Data Sub Tahapan....');
            } catch (\Exception $e) {
                return redirect()->back()->with('failed', 'internal server error');
            }
        }
        return view('superuser.indicator-v2.detail')->with(['stage' => $stage]);
    }

    public function add_indicator()
    {
        try {
            $data_request = [
                'sub_stage_id' => request()->request->get('sub-stage'),
                'name' => request()->request->get('name'),
                'index' => 1
            ];
            StageIndicator::create($data_request);
            return redirect()->back()->with('success', 'Berhasil Menambahkan Data Indikator....');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'internal server error');
        }
    }

    public function sub_indicator()
    {
        try {
            $data_request = [
                'stage_indicator_id' => request()->request->get('indicator'),
                'name' => request()->request->get('name'),
                'index' => 1
            ];
            StageSubIndicator::create($data_request);
            return redirect()->back()->with('success', 'Berhasil Menambahkan Data Indikator....');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'internal server error');
        }
    }
}
