<?php
namespace App\Http\Controllers\TestOnline;

use App\Filters\TestModuleFilters;
use App\Http\Controllers\Controller;
use App\Models\TestCareerModule;
use App\Models\TestModule;
use App\Models\TestQuestion;
use App\Models\TestStep;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class TestModuleController extends Controller
{
    public function index()
    {
        return $this->view_page('pages.admin.test.module.index');
    }

    public function datatable(Request $request)
    {
        $data = TestModule::select('*');

        return DataTables::of($data)
                ->addColumn('action', function($item){
                    return
                        '<form id="preview_form" action="'.route('module.preview.post').'" method="post" enctype="multipart/form-data" style="float: left;">
                                <input type="hidden" name="_token" value="'.csrf_token().'">
                                <input type="hidden" name="module_id" value="'.Crypt::encrypt($item->id).'">
                            <button type="submit" class="btn btn-sm btn-primary"><span class="fa fa-search"></span></button>
                        </form>'.

                        // '<a target="_blank" style="color: white;margin-left: 4px;" title="Preview" href="'.route('module.preview', Crypt::encrypt($item->id)).'" class="btn btn-sm btn-primary"><span class="fa fa-search"></span></a>' .

                        '<a style="color: white;margin-left: 4px; margin-right: 4px;" title="Ubah Data" href="'.route('module.edit', Crypt::encrypt($item->id)).'" class="btn btn-sm btn-warning"><span class="fa fa-edit"></span></a>' . 
                        "<button title='Hapus Data' class='btn btn-danger btn-sm btn-delete deleteButton' data-toggle='confirmation' data-singleton='true' value='".Crypt::encrypt($item->id)."'><i class='fa fa-trash'></i></button>";
                })
                ->editColumn('scored', function($item){
                    if($item->scored == 1){
                        return 'Automated';
                    }else if($item->scored == 2){
                        return 'Automated with Marking';
                    }else{
                        return 'Not Scored';
                    }
                })
                ->make(true);
    }

    public function data(TestModuleFilters $filters)
    {
        return TestModule::filter($filters)->get();
    }

    public function add()
    {
        return $this->view_page('pages.admin.test.module.add');
    }

    public function store(Request $request){

        $this->validate($request, [
            'name'        => 'required',
            'scored'      => 'required',
        ]);

        $user = TestModule::create($request->all());

        Session::flash('success', 'Module Berhasil Ditambahkan.');

        return redirect()->route('module.index');
    }

    public function edit($id){
        
        $decId = $this->decrypt($id, 'module.index');

        $data = TestModule::whereId($decId)->first();

        if(!$data) return redirect(route('module.index'));

        return $this->view_page('pages.admin.test.module.edit', ['data' => $data]);

    }

    public function update(Request $request, $id){

        $decId = $this->decrypt($id, 'module.index');
        
        $this->validate($request, [
            'name'        => 'required',
            'scored'      => 'required',
        ]);

        $data = TestModule::whereId($decId)->first();

        if(!$data) return redirect(route('module.index'));

        $data->update($request->all());

        Session::flash('success', 'Module Berhasil Diupdate.');

        return redirect()->route('module.index');

    }

    public function delete($id)
    {
        $decId = $this->decrypt($id, 'module.index');

        $data = TestModule::whereId($decId)->first();

        if(!$data) return redirect(route('module.index'));

        $data_id = $data->id;

        // DELETE RELATED DATA
        TestCareerModule::whereModuleId($data_id)->delete();
        $stepIds = TestStep::whereModuleId($data_id)->pluck('id')->toArray();
        TestQuestion::whereIn('step_id', $stepIds)->delete();
        TestStep::whereModuleId($data_id)->delete();

        $data->delete();

        return response()->json([
            'success' => true,
            'data' => ['id' => $data_id],
            'status' => 200
        ]);
    }

    public function preview($id)
    {
        $decId = $this->decrypt($id, 'module.index');

        $step = TestStep::whereModuleId($decId)->orderBy('order')->first();

        if(!$step) return redirect(route('module.index'));

        $questions = TestQuestion::with('step.module', 'choices', 'multiple_inputs', 'group_answer_rows.group_answer_columns')->whereStepId($step->id)->orderBy('order')->get();

        return $this->view_page('pages.admin.test.module.preview', ['step' => $step, 'questions' => $questions, 'title' => ['title_en' => 'Preview', 'title_in' => 'Preview']]);
    }

    public function previewPost(Request $request)
    {
        // return $request->all();

        $decModuleId = $this->decrypt($request->module_id, 'module.index');

        if(!isset($request->step_id)){
            $step = TestStep::whereModuleId($decModuleId)->orderBy('order')->first();

            if(!$step) return redirect()->route('module.index');

            $questions = TestQuestion::with('step.module', 'choices', 'multiple_inputs', 'group_answer_rows.group_answer_columns')->whereStepId($step->id)->orderBy('order')->get();

            return $this->view_page('pages.admin.test.module.preview', ['step' => $step, 'questions' => $questions, 'title' => ['title_en' => 'Preview', 'title_in' => 'Preview']]);
        }else{

            if($request->navigation == 'last') return 'ALL FORM SUBMITED. THANK YOU :)';

            $decStepId = $this->decrypt($request->step_id, 'module.index');

            $stepPrev = TestStep::whereId($decStepId)->first();

            if(!$stepPrev) return redirect(route('module.index'));

            // NAVIGATION
            if($request->navigation == 'next'){
                $step = TestStep::whereModuleId($decModuleId)->where('order', '>', $stepPrev->order)->orderBy('order')->first();
            }else if($request->navigation == 'prev'){
                $step = TestStep::whereModuleId($decModuleId)->where('order', '<', $stepPrev->order)->orderBy('order', 'DESC')->first();
            }

            if(!$step) return redirect(route('module.index'));

            $questions = TestQuestion::with('step.module', 'choices', 'multiple_inputs', 'group_answer_rows.group_answer_columns')->whereStepId($step->id)->orderBy('order')->get();

            return $this->view_page('pages.admin.test.module.preview', ['step' => $step, 'questions' => $questions, 'title' => ['title_en' => 'Preview', 'title_in' => 'Preview']]);
            
        }
        
        

        // return $request->all();
    }
}
