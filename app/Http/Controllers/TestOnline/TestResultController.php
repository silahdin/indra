<?php
namespace App\Http\Controllers\TestOnline;

use App\CmsCareer;
use App\Filters\TestStepFilters;
use App\Http\Controllers\Controller;
use App\Models\TestMarking;
use App\Models\TestModule;
use App\Models\TestNewUserAnswer;
use App\Models\TestQuestion;
use App\Models\TestResult;
use App\Models\TestStep;
use App\User;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;
use PDF;

class TestResultController extends Controller
{
    public function index()
    {
        return $this->view_page('pages.admin.test.result.index');
    }

    public function datatable(Request $request)
    {
        $data = TestResult::with('user', 'career')->groupBy('user_id', 'career_id')->orderBy('updated_at', 'DESC')->select('test_results.*');

        return DataTables::of($data)
                ->editColumn('updated_at', function($item){
                    if($item->updated_at != null && $item->updated_at != '0000-00-00 00:00:00'){
                        return Carbon::parse($item->updated_at)->format('Y-m-d h:i:s');
                    }

                    return '-';
                })
                ->addColumn('action', function($item){
                    return '<a style="color: white;margin-left: 4px; margin-right: 4px;" title="Download Excel" href="javascript:void(0)" class="btn btn-sm btn-success btn-result-export" onclick="exportingCareer(\''.Crypt::encrypt($item->career_id).'\', \''.Crypt::encrypt($item->user_id).'\')"><span class="fa fa-file-excel-o"></span></a>';
                })
                ->make(true);
    }

    public function moduleDatatable(Request $request)
    {
        $data = TestResult::with('module')->whereCareerId($request->career_id)->whereUserId($request->user_id)->orderBy('module_id');

        // $modules = TestModule::join('test_career_modules', 'test_career_modules.module_id', 'test_modules.id')
        //             ->where('test_career_modules.career_id', $req)
        //             ->whereNull('test_modules.deleted_at')
        //             ->whereNull('test_career_modules.deleted_at')

        return DataTables::of($data)
                ->addColumn('action', function($item){

                    $marking = '';

                    if($item->module->scored == 1){
                        $marking = '<a style="color: white;margin-left: 4px; margin-right: 4px;" title="Download Excel" href="javascript:void(0)" class="btn btn-sm btn-success btn-result-export" onclick="exporting(\''.Crypt::encrypt($item->career_id).'\', \''.Crypt::encrypt($item->module_id).'\', \''.Crypt::encrypt($item->user_id).'\')"><span class="fa fa-file-excel-o"></span></a>' . 
                        '<a style="color: white; margin-right: 4px;" title="Download PDF" href="'.route('result.export.pdf').'/'.$item->career_id.'/'.$item->module_id.'/'.$item->user_id.'" class="btn btn-sm btn-danger" target="_blank"><span class="fa fa-file-pdf-o"></span></a>';
                    }

                    if($item->module->scored == 2){
                        $marking = '<a target="_blank" style="color: white;margin-left: 4px; margin-right: 4px;" title="Marking" href="'.route('result.marking', Crypt::encrypt($item->id)).'" class="btn btn-sm btn-warning"><span class="fa fa-edit"></span></a>';
                    }

                    return
                        '<form style="float: " id="preview_form" action="'. route('online.test.finished.result') .'" method="post" enctype="multipart/form-data">'.

                            csrf_field() .

                            '<input type="hidden" name="user_id" value="'. Crypt::encrypt($item->user_id) .'">'.
                            '<input type="hidden" name="module_id" value="'. Crypt::encrypt($item->module_id) .'">'.
                            '<input type="hidden" name="career_id" value="'. Crypt::encrypt($item->career_id) .'">'.

                            '<button type="submit" class="btn btn-primary" title="See Answers"><span class="fa fa-search"></span></button>'.
                    
                            $marking .

                        '</form>';
                })
                // ->editColumn('score', function($item){
                //     return ($item->score == null || $item->score == '') ? '-' : $item->score;
                // })
                ->editColumn('status', function($item){
                    if($item->module->scored == 1){
                        return '<button type="button" class="btn btn-sm btn-success">Completed</button>';
                    }else if($item->module->scored == 2){
                        if($item->status == 0){
                            return '<button type="button" class="btn btn btn-sm btn-warning">Need Marking</button>';
                        }else{
                            return '<button type="button" class="btn btn btn-sm btn-success">Completed</button>';
                        }
                    }else{
                        return '<button type="button" class="btn btn btn-sm btn-primary">Not For Scored</button>';
                    }
                })
                ->addColumn('score', function($item){
                    if($item->module->scored == 1) return $item->score_automated . '/' . $item->total_score;
                    return ($item->module->scored == 3) ? '-' : ($item->score_automated + $item->score_marking);
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
    }

    public function marking($id = '')
    {
        $decResultId = '';

        try{
            $decResultId = Crypt::decrypt($id);
        }catch(\Exception $e){
            return redirect(route('result.index'));
        }

        $result = TestResult::with('user', 'module', 'career')->whereId($decResultId)->first();

        $questions = TestQuestion::join('test_steps', 'test_steps.id', 'test_questions.step_id')
                        ->join('test_career_modules', 'test_career_modules.module_id', 'test_steps.module_id')
                        ->whereNull('test_career_modules.deleted_at')
                        ->whereNull('test_steps.deleted_at')
                        ->whereNull('test_questions.deleted_at')
                        ->where('test_career_modules.module_id', $result->module_id)
                        ->where('test_career_modules.career_id', $result->career_id)
                        ->where('test_questions.type', 'Question')
                        ->where('test_questions.right_answer', null)
                        ->whereIn('test_questions.answer_type', ['Plain', 'Choices'])
                        ->select('test_questions.*')
                        ->get();

        $data = [];

        foreach ($questions as $question) {
            $answer = TestNewUserAnswer::whereCode($question->code)->first();

            // GET SCORE IF HAS BEEN SCORED
            $scored = TestMarking::whereUserId($result->user_id)->whereCode($question->code)->first();

            $detail['code'] = $question->code;
            $detail['question'] = $question->text;
            $detail['answer'] = @$answer->answer;
            $detail['explanation'] = @$answer->explanation;
            $detail['score'] = @$scored->score;

            array_push($data, $detail);
        }

        return $this->view_page('pages.admin.test.result.marking', ['data' => $data, 'result' => $result]);
    }

    public function markingPost(Request $request)
    {
        $decResultId = '';

        try{
            $decResultId = Crypt::decrypt(@$request->result_id);
        }catch(\Exception $e){
            return redirect(route('result.index'));
        }

        // GET RESULTS
        $result = TestResult::whereId($decResultId)->first();

        if(!$result) return redirect(route('result.index'));

        $score = 0;

        foreach ($request->all() as $key => $value) {
            
            if($key == '_token' || $key == 'result_id') continue;

            // CREATE OR UPDATE MARKINGS
            $marking = TestMarking::updateOrCreate([
                'user_id' => $result->user_id,
                'code' => $key
            ],[
                'score' => $value
            ]);

            $score += $value;

        }

        // UPDATE RESULTS
        $result->update([
            'score_marking' => $score,
            'status' => 1,
        ]);

        Session::flash('status', 'Marking was submitted, result will change depends on scores updated.');

        return redirect()->route('result.marking', Crypt::encrypt($decResultId));
    }

    public function export(Request $request)
    {

        $career_id = Crypt::decrypt(@$request->career_id);
        $module_id = Crypt::decrypt(@$request->module_id);
        $user_id = Crypt::decrypt(@$request->user_id);

        $career = CmsCareer::whereId($career_id)->first();
        $module = TestModule::whereId($module_id)->first();
        $user = User::whereId($user_id)->first();

        $filename = 'Result Test - ' . $user->name . ' - ' . $module->name . ' - ' . $career->position_en . ' (' . $career->jobdesk_en . ')';

        $data = TestQuestion::whereHas('step.module', function($q) use ($module_id) {
                            return $q->where('id', $module_id);
                        })
                        ->leftJoin('test_new_user_answers', function($join) use ($career_id, $user_id){
                            $join->on('test_new_user_answers.code', 'test_questions.code');
                            $join->where('test_new_user_answers.career_id', $career_id);
                            $join->where('test_new_user_answers.user_id', $user_id);
                        })
                        ->whereNotNull('test_questions.score')
                        ->whereNull('test_new_user_answers.deleted_at')
                        ->select('test_questions.*', 'test_new_user_answers.career_id', 'test_new_user_answers.answer as user_answer', DB::raw('IF(test_questions.right_answer = test_new_user_answers.answer, 1, 0) as correct_answer'), DB::raw('IF(test_questions.right_answer = test_new_user_answers.answer, test_questions.score, 0) as correct_score'))
                        ->groupBy('test_questions.code', 'test_new_user_answers.career_id')
                        ->orderBy('test_questions.step_id')
                        ->get();

        $result = [];

        $testResult = TestResult::whereUserId($user_id)->whereCareerId($career_id)->whereModuleId($module_id)->first();

        $result['total_score'] = @$testResult->total_score ?? 0;
        $result['total_question'] = @$testResult->total_question ?? 0;
        $result['correct_score'] = collect($data)->sum('correct_score');
        $result['correct_answer'] = collect($data)->sum('correct_answer');

        $excel = Excel::create($filename, function($excel) use ($data, $result, $module, $user, $career) {

            // Set the title
            $excel->setTitle('Result');

            // Chain the setters
            $excel->setCreator('Reanda Bernardi')
                  ->setCompany('Reanda Bernardi');

            // Call them separately
            $excel->setDescription('Result For Testing');

            $excel->getDefaultStyle()
                ->getAlignment()
                ->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
                ->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);

            $excel->sheet('RESULT', function ($sheet) use ($data, $result, $module, $user, $career) {
                // $sheet->setAutoFilter('A1:B1');

                $sheet->setWidth('A', 30);
                $sheet->setWidth('B', 50);

                $sheet->cells('A:A', function ($cells) {
                    $cells->setAlignment('left');
                });

                $sheet->setHeight(7, 25);
                $sheet->setHeight(1, 25);
                $sheet->setHeight(2, 25);
                $sheet->setHeight(3, 25);
                $sheet->setHeight(4, 25);
                $sheet->setHeight(5, 25);

                $sheet->fromModel($this->mapping($data), null, 'A7', true, true);
                $sheet->row(7, function ($row) {
                    $row->setBackground('#e8effb');
                });
                $sheet->cells('A7:B7', function ($cells) {
                    $cells->setFontWeight('bold');
                });
                $sheet->setBorder('A7:B7', 'thin');

                $sheet->setCellValue('A1','NAME ');
                $sheet->setCellValue('A2','CAREER ');
                $sheet->setCellValue('A3','MODULE ');
                $sheet->setCellValue('A4','QUESTION ANSWERED ');
                $sheet->setCellValue('A5','FINAL SCORE ');

                $sheet->cells('A1:A5', function ($cells) {
                    $cells->setFontWeight('bold');
                    $cells->setBackground('#e8effb');
                    $cells->setAlignment('left');
                });

                // $sheet->mergeCells('B1:G1');
                // $sheet->mergeCells('B2:G2');
                // $sheet->mergeCells('B3:G3');
                // $sheet->mergeCells('B4:G4');
                // $sheet->mergeCells('B5:G5');

                $sheet->setCellValue('B1', $user->name);
                $sheet->setCellValue('B2', $career->position_en . ' (' . $career->jobdesk_en . ')');
                $sheet->setCellValue('B3', $module->name);
                $sheet->setCellValue('B4', ($result['correct_answer']) . '/' . ($result['total_question']));
                $sheet->setCellValue('B5', ($result['correct_score']) . '/' . ($result['total_score']));

                $sheet->cells('B1:B5', function ($cells) {
                    $cells->setFontWeight('bold');
                    $cells->setBackground('#4f81bd');
                    $cells->setAlignment('left');
                    $cells->setFontColor('#ffffff');
                });

            });

        })->string('xlsx');

        return response()->json(['name' => $filename.'.xlsx', 'file' => 'data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,'.base64_encode($excel)]);
    }

    public function mapping($data)
    {
        $collection = collect($data);

        return $collection->map(function ($item) {
            return [
                'CATEGORY- TYPE'  => @$item['step']['name'],
                // 'QUESTION CODE'  => @$item['code'],
                // 'QUESTION TEXT'  => @$item['text'],
                // 'ANSWER'  => @$item['user_answer'],
                // 'RIGHT ANSWER'  => @$item['right_answer'],
                // 'SCORE'  => @$item['score'],
                // 'RESULT'  => @$item['user_answer'] == @$item['right_answer'] ? @$item['score'] : 0,
                'RESULT' => @$item['user_answer'] == @$item['right_answer'] ? 'CORRECT' : 'INCORRECT'
            ];
        });
    }


    public function exportCareer(Request $request)
    {

        $career_id = Crypt::decrypt(@$request->career_id);
        $user_id = Crypt::decrypt(@$request->user_id);

        $career = CmsCareer::whereId($career_id)->first();
        $user = User::whereId($user_id)->first();

        $filename = 'Result Career - ' . $user->name . ' - ' . $career->position_en . ' (' . $career->jobdesk_en . ')';

        $data = TestQuestion::join('test_steps', 'test_questions.step_id', 'test_steps.id')
                        ->join('test_modules', 'test_steps.module_id', 'test_modules.id')
                        ->join('test_career_modules', 'test_career_modules.module_id', 'test_modules.id')
                        ->where('test_career_modules.career_id', $career_id)
                        ->leftJoin('test_new_user_answers', function($join) use ($career_id, $user_id){
                            $join->on('test_new_user_answers.code', 'test_questions.code');
                            $join->where('test_new_user_answers.career_id', $career_id);
                            $join->where('test_new_user_answers.user_id', $user_id);
                        })
                        ->leftJoin('test_results', function($join) use ($career_id, $user_id){
                            $join->on('test_results.module_id', 'test_modules.id');
                            $join->where('test_results.career_id', $career_id);
                            $join->where('test_results.user_id', $user_id);
                        })
                        ->whereIn('test_modules.scored', [1, 2])
                        ->select('test_modules.*', 'test_results.score_automated', 'test_results.score_marking', DB::raw('COUNT(IF(test_questions.score >= 1, 1, NULL)) as total_question'), DB::raw('COUNT(IF(test_questions.right_answer = test_new_user_answers.answer AND test_questions.score >= 1, 1, NULL)) as correct_answer'), DB::raw('SUM(IF(test_questions.score >= 1, test_questions.score, 0)) as question_total_score') )
                        ->groupBy('test_modules.id')
                        // ->groupBy('test_new_user_answers.career_id')
                        // ->where('test_modules.id', 4)
                        // ->whereNotNull('test_questions.score')
                        // ->select('test_questions.*', 'test_new_user_answers.career_id')
                        ->whereNull('test_career_modules.deleted_at')
                        ->whereNull('test_modules.deleted_at')
                        ->whereNull('test_steps.deleted_at')
                        ->whereNull('test_questions.deleted_at')
                        ->whereNull('test_new_user_answers.deleted_at')
                        ->whereNull('test_results.deleted_at')
                        ->get();

                        // return $data;

        $excel = Excel::create($filename, function($excel) use ($data, $user, $career) {

            // Set the title
            $excel->setTitle('Result');

            // Chain the setters
            $excel->setCreator('Reanda Bernardi')
                  ->setCompany('Reanda Bernardi');

            // Call them separately
            $excel->setDescription('Result For Testing');

            $excel->getDefaultStyle()
                ->getAlignment()
                ->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
                ->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);

            $excel->sheet('RESULT', function ($sheet) use ($data, $user, $career) {
                // $sheet->setAutoFilter('A1:B1');
                $sheet->setHeight(4, 25);
                $sheet->setHeight(1, 25);
                $sheet->setHeight(2, 25);

                $sheet->fromModel($this->mappingCareer($data), null, 'A4', true, true);
                $sheet->row(4, function ($row) {
                    $row->setBackground('#e8effb');
                });
                $sheet->cells('A4:G4', function ($cells) {
                    $cells->setFontWeight('bold');
                });
                $sheet->setBorder('A4:G4', 'thin');

                $sheet->setCellValue('A1','NAME ');
                $sheet->setCellValue('A2','CAREER ');

                $sheet->cells('A1:A2', function ($cells) {
                    $cells->setFontWeight('bold');
                    $cells->setBackground('#e8effb');
                    $cells->setAlignment('left');
                });

                $sheet->mergeCells('B1:G1');
                $sheet->mergeCells('B2:G2');

                $sheet->setCellValue('B1', $user->name);
                $sheet->setCellValue('B2', $career->position_en . ' (' . $career->jobdesk_en . ')');

                $sheet->cells('B1:B2', function ($cells) {
                    $cells->setFontWeight('bold');
                    $cells->setBackground('#4f81bd');
                    $cells->setAlignment('left');
                    $cells->setFontColor('#ffffff');
                });

                $sheet->cells('A:A', function ($cells) {
                    $cells->setAlignment('left');
                });

            });

        })->string('xlsx');

        return response()->json(['name' => $filename.'.xlsx', 'file' => 'data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,'.base64_encode($excel)]);
    }

    public function mappingCareer($data)
    {
        $collection = collect($data);

        return $collection->map(function ($item) {
            return [
                'MODULE'  => @$item['name'],
                'TOTAL QUESTION'  => @$item['total_question'] ?? 0,
                'TOTAL SCORE'  => @$item['question_total_score'] ?? 0,
                'CORRECT ANSWER'  => @$item['correct_answer'] ?? 0,
                'RESULT SCORE'  => @$item['score_automated'] ?? 0,
                'ADDITIONAL SCORE (MARKING)'  => @$item['score_marking'] ?? 0,
                'FINAL SCORE'  => @$item['score_automated'] ?? 0 + @$item['score_marking'] ?? 0,
            ];
        });
    }

    public function exportPdf($career_id, $module_id, $user_id)
    {
        $career = CmsCareer::whereId($career_id)->first();
        $module = TestModule::whereId($module_id)->first();
        $user = User::whereId($user_id)->first();

        $filename = 'Result Test - ' . $user->name . ' - ' . $module->name . ' - ' . $career->position_en . ' (' . $career->jobdesk_en . ')';

        $data = TestQuestion::whereHas('step.module', function($q) use ($module_id) {
                            return $q->where('id', $module_id);
                        })
                        ->leftJoin('test_new_user_answers', function($join) use ($career_id, $user_id){
                            $join->on('test_new_user_answers.code', 'test_questions.code');
                            $join->where('test_new_user_answers.career_id', $career_id);
                            $join->where('test_new_user_answers.user_id', $user_id);
                        })
                        ->whereNotNull('test_questions.score')
                        ->whereNull('test_new_user_answers.deleted_at')
                        ->select('test_questions.*', 'test_new_user_answers.career_id', 'test_new_user_answers.answer as user_answer', DB::raw('IF(test_questions.right_answer = test_new_user_answers.answer, 1, 0) as correct_answer'), DB::raw('IF(test_questions.right_answer = test_new_user_answers.answer, test_questions.score, 0) as correct_score'))
                        ->groupBy('test_questions.code', 'test_new_user_answers.career_id')
                        ->orderBy('test_questions.step_id')
                        ->get();

        $result = [];

        $testResult = TestResult::whereUserId($user_id)->whereCareerId($career_id)->whereModuleId($module_id)->first();

        $result['name'] = $user->name;
        $result['career'] = $career->position_en . ' (' . $career->jobdesk_en . ')';
        $result['module'] = $module->name;
        $result['question_answered'] = collect($data)->sum('correct_answer');
        $result['final_score'] = collect($data)->sum('correct_score');
        $result['total_score'] = @$testResult->total_score ?? 0;
        $result['total_question'] = @$testResult->total_question ?? 0;

        $pdf = PDF::loadView('pdf.test-result', ['data' => $data, 'result' => $result]);
        // return $pdf->stream($filename.'.pdf');
        return $pdf->download($filename.'.pdf');
    }
   
}
