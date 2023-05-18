<?php
namespace App\Http\Controllers\TestOnline;

use App\Filters\TestStepFilters;
use App\Http\Controllers\Controller;
use App\Models\TestQuestion;
use App\Models\TestStep;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class TestStepController extends Controller
{
    public function index()
    {
        return $this->view_page('pages.admin.test.step.index');
    }

    public function datatable(Request $request)
    {
        // $data = TestStep::join('test_modules', 'test_modules.id', 'test_steps.module_id')
        //             ->whereNull('test_modules.deleted_at')
        //             ->whereNull('test_steps.deleted_at')
        //             ->select('test_steps.*', 'test_modules.name as module');

        return DataTables::of(TestStep::with('module'))
                ->addColumn('action', function($item){
                    return
                        '<a style="color: white;margin-left: 4px;" title="Preview" href="'.route('step.preview', Crypt::encrypt($item->id)).'" class="btn btn-sm btn-primary"><span class="fa fa-search"></span></a>' .
                        '<a style="color: white;margin-left: 4px; margin-right: 4px;" title="Ubah Data" href="'.route('step.edit', Crypt::encrypt($item->id)).'" class="btn btn-sm btn-warning"><span class="fa fa-edit"></span></a>' . 
                        "<button title='Hapus Data' class='btn btn-danger btn-sm btn-delete deleteButton' data-toggle='confirmation' data-singleton='true' value='".Crypt::encrypt($item->id)."'><i class='fa fa-trash'></i></button>";
                })
                ->make(true);
    }

    public function data(TestStepFilters $filters)
    {
        return TestStep::with('module')->filter($filters)->get();
    }

    public function add()
    {
        return $this->view_page('pages.admin.test.step.add');
    }

    public function store(Request $request){

        $this->validate($request, [
            'module_id'   => 'required|exists:test_modules,id',
            'name'        => 'required',
            'order'       => 'required|integer',
        ]);

        $user = TestStep::create($request->all());

        Session::flash('success', 'Step Berhasil Ditambahkan.');

        return redirect()->route('step.index');
    }

    public function edit($id){
        
        $decId = $this->decrypt($id, 'step.index');

        $data = TestStep::with('module')->whereId($decId)->first();

        if(!$data) return redirect(route('step.index'));

        return $this->view_page('pages.admin.test.step.edit', ['data' => $data]);

    }

    public function update(Request $request, $id){

        $decId = $this->decrypt($id, 'step.index');
        
        $this->validate($request, [
            'module_id'   => 'required|integer|exists:test_modules,id',
            'name'        => 'required',
            'order'       => 'required|integer',
        ]);

        $data = TestStep::whereId($decId)->first();

        if(!$data) return redirect(route('step.index'));

        $data->update($request->all());

        Session::flash('success', 'Step Berhasil Diupdate.');

        return redirect()->route('step.index');

    }

    public function delete($id)
    {
        $decId = $this->decrypt($id, 'step.index');

        $data = TestStep::whereId($decId)->first();

        if(!$data) return redirect(route('step.index'));

        $data_id = $data->id;

        // DELETE RELATED DATA
        TestQuestion::whereStepId($data_id)->delete();

        $data->delete();

        return response()->json([
            'success' => true,
            'data' => ['id' => $data_id],
            'status' => 200
        ]);
    }

    public function preview($id)
    {
        $decId = $this->decrypt($id, 'step.index');

        $step = TestStep::whereId($decId)->first();

        if(!$step) return redirect(route('step.index'));

        $questions = TestQuestion::with('step.module', 'choices', 'multiple_inputs', 'group_answer_rows.group_answer_columns')->whereStepId($decId)->orderBy('order')->get();

        // if($questions->count() <= 0) return redirect(route('step.index'));

        return $this->view_page('pages.admin.test.step.preview', ['step' => $step, 'questions' => $questions, 'title' => ['title_en' => 'Preview', 'title_in' => 'Preview']]);
    }

    public function previewPost(Request $request)
    {
        return $request->all();
    }
}
