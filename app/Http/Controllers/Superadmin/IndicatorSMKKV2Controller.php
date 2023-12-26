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

    public function edit($id)
    {
        if (request()->method() === 'POST') {
            return $this->patchAction();
        }
        try {
            $stage = Stage::with([])
                ->where('id', '=', $id)
                ->first();
            if (!$stage) {
                return response()->json('data not found', 404);
            }
            return response()->json([
                'data' => $stage,
                'message' => 'success'
            ], 200);
        }catch (\Exception $e) {
            return response()->json('internal server error', 500);
        }
    }

    public function patch()
    {
        try {
            $id = request()->request->get('id-edit');
            $name = request()->request->get('name-edit');
            $stage = Stage::with([])
                ->where('id', '=', $id)
                ->first();
            if (!$stage) {
                return redirect()->back()->with('failed', 'data not found');
            }
            $data_request = [
                'name' => $name,
                'index' => 1
            ];
            $stage->update($data_request);
            return redirect()->back()->with('success', 'Berhasil Merubah Data Indikator....');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'internal server error');
        }
    }

    public function destroy($id)
    {
        try {
            $stage = Stage::with([])
                ->where('id', '=', $id)
                ->first();
            if (!$stage) {
                return response()->json('data not found', 404);
            }
            $stage->delete();
            return response()->json([
                'message' => 'success'
            ], 200);
        }catch (\Exception $e) {
            return response()->json('internal server error', 500);
        }
    }

    public function get_sub_stage($id)
    {
        if (request()->method() === 'POST' && request()->ajax()) {
            return $this->patch_sub_stage($id);
        }
        try {
            $sub_stage = SubStage::with([])
                ->where('id', '=', $id)
                ->first();
            if (!$sub_stage) {
                return response()->json('data not found', 404);
            }
            return response()->json([
                'data' => $sub_stage,
                'message' => 'success'
            ], 200);
        }catch (\Exception $e) {
            return response()->json('internal server error', 500);
        }
    }

    private function patch_sub_stage($id)
    {
        try {
            $sub_stage = SubStage::with([])
                ->where('id', '=', $id)
                ->first();
            if (!$sub_stage) {
                return response()->json('data not found', 404);
            }
            $name = request()->request->get('name');
            $sub_stage->update([
                'name' => $name
            ]);
            return response()->json([
                'message' => 'success'
            ], 200);
        }catch (\Exception $e) {
            return response()->json('internal server error', 500);
        }
    }

    public function destroy_sub_stage($id)
    {
        try {
            $sub_stage = SubStage::with([])
                ->where('id', '=', $id)
                ->first();
            if (!$sub_stage) {
                return response()->json('data not found', 404);
            }
            $sub_stage->delete();
            return response()->json([
                'message' => 'success'
            ], 200);
        }catch (\Exception $e) {
            return response()->json('internal server error', 500);
        }
    }

    public function get_indicator($id)
    {
        if (request()->method() === 'POST' && request()->ajax()) {
            return $this->patch_indicator($id);
        }
        try {
            $indicator = StageIndicator::with([])
                ->where('id', '=', $id)
                ->first();
            if (!$indicator) {
                return response()->json('data not found', 404);
            }
            return response()->json([
                'data' => $indicator,
                'message' => 'success'
            ], 200);
        }catch (\Exception $e) {
            return response()->json('internal server error', 500);
        }
    }

    private function patch_indicator($id)
    {
        try {
            $indicator = StageIndicator::with([])
                ->where('id', '=', $id)
                ->first();
            if (!$indicator) {
                return response()->json('data not found', 404);
            }
            $name = request()->request->get('name');
            $indicator->update([
                'name' => $name
            ]);
            return response()->json([
                'message' => 'success'
            ], 200);
        }catch (\Exception $e) {
            return response()->json('internal server error', 500);
        }
    }

    public function destroy_indicator($id)
    {
        try {
            $indicator = StageIndicator::with([])
                ->where('id', '=', $id)
                ->first();
            if (!$indicator) {
                return response()->json('data not found', 404);
            }
            $indicator->delete();
            return response()->json([
                'message' => 'success'
            ], 200);
        }catch (\Exception $e) {
            return response()->json('internal server error', 500);
        }
    }

    public function get_sub_indicator($id)
    {
        if (request()->method() === 'POST' && request()->ajax()) {
            return $this->patch_sub_indicator($id);
        }
        try {
            $sub_indicator = StageSubIndicator::with([])
                ->where('id', '=', $id)
                ->first();
            if (!$sub_indicator) {
                return response()->json('data not found', 404);
            }
            return response()->json([
                'data' => $sub_indicator,
                'message' => 'success'
            ], 200);
        }catch (\Exception $e) {
            return response()->json('internal server error', 500);
        }
    }

    private function patch_sub_indicator($id)
    {
        try {
            $sub_indicator = StageSubIndicator::with([])
                ->where('id', '=', $id)
                ->first();
            if (!$sub_indicator) {
                return response()->json('data not found', 404);
            }
            $name = request()->request->get('name');
            $sub_indicator->update([
               'name' => $name
            ]);
            return response()->json([
                'message' => 'success'
            ], 200);
        }catch (\Exception $e) {
            return response()->json('internal server error', 500);
        }
    }

    public function destroy_sub_indicator($id)
    {
        try {
            $sub_indicator = StageSubIndicator::with([])
                ->where('id', '=', $id)
                ->first();
            if (!$sub_indicator) {
                return response()->json('data not found', 404);
            }
            $sub_indicator->delete();
            return response()->json([
                'message' => 'success'
            ], 200);
        }catch (\Exception $e) {
            return response()->json('internal server error', 500);
        }
    }


}
