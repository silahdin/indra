<?php
namespace App\Http\Controllers\TestOnline;

use App\CmsCareer;
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

class TestModuleAssignmentController extends Controller
{
    public function index()
    {
        return $this->view_page('pages.admin.test.module_assignment.index');
    }

    public function datatable(Request $request)
    {
        $data = TestCareerModule::with('module', 'career');

        return DataTables::of($data)
                ->addColumn('action', function($item){
                    return 
                        "<button title='Hapus Data' class='btn btn-danger btn-sm btn-delete deleteButton' data-toggle='confirmation' data-singleton='true' value='".Crypt::encrypt($item->id)."'><i class='fa fa-trash'></i></button>";
                })
                ->make(true);
    }

    public function add()
    {
        return $this->view_page('pages.admin.test.module_assignment.add');
    }

    public function store(Request $request){

        $this->validate($request, [
            'career_id'        => 'required',
            'module_id'      => 'required',
        ]);

        $user = TestCareerModule::create($request->all());

        Session::flash('success', 'Penambahan Module di Career Berhasil.');

        return redirect()->route('module.assignment.index');
    }

    public function delete($id)
    {
        $decId = $this->decrypt($id, 'module.assignment.index');

        $data = TestCareerModule::whereId($decId)->first();

        if(!$data) return redirect(route('module.assignment.index'));

        $data_id = $data->id;
        $data->delete();

        return response()->json([
            'success' => true,
            'data' => ['id' => $data_id],
            'status' => 200
        ]);
    }

    /* PREVIEW ADMIN */

    public function career_list()
    {
        $career = CmsCareer::get();

        // return $career;

        return $this->view_page('pages.admin.test.career', ['listjobs' => $career]);
    }

    public function module_list($id)
    {
        $decId = $this->decrypt($id, 'admin.career.list');

        $modules = TestModule::join('test_career_modules', 'test_career_modules.module_id', 'test_modules.id')
                    ->where('test_career_modules.career_id', $decId)
                    ->whereNull('test_modules.deleted_at')
                    ->whereNull('test_career_modules.deleted_at')
                    ->select('test_modules.*')
                    ->get();

        $career = CmsCareer::whereId($decId)->first();

        return $this->view_page('pages.admin.test.module', ['modules' => $modules, 'career' => $career]);
    }
}
