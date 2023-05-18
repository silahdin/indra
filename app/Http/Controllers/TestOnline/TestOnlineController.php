<?php
namespace App\Http\Controllers\TestOnline;

use App\CmsCareer;
use App\Filters\TestStepFilters;
use App\Http\Controllers\Controller;
use App\Models\TestCareerModule;
use App\Models\TestGroupAnswerColumn;
use App\Models\TestGroupAnswerRow;
use App\Models\TestModule;
use App\Models\TestMultipleInput;
use App\Models\TestNewUserAnswer;
use App\Models\TestQuestion;
use App\Models\TestResult;
use App\Models\TestStep;
use App\Models\TestUserAnswer;
use App\Models\TestUserOngoing;
use App\Models\TestUserUpload;
use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class TestOnlineController extends Controller
{
    public function start(Request $request)
    {
        $decCareerId = '';
        $decModuleId = '';

        try{
            $decCareerId = Crypt::decrypt(@$request->career_id);
            $decModuleId = Crypt::decrypt(@$request->module_id);
        }catch(\Exception $e){
            return redirect()->back();
        }

        // GET CAREER MODULE
        $careerModule = TestCareerModule::whereCareerId($decCareerId)->whereModuleId($decModuleId)->first();

        if(!$careerModule) return redirect()->back();

         // CHECK IF ONGOING MODULES ON
        $ongoing = TestUserOngoing::leftJoin('test_career_modules', 'test_career_modules.id', 'test_user_ongoings.module_career_id')
                    ->where('test_career_modules.career_id', $decCareerId)
                    ->where('test_user_ongoings.status', 1)
                    ->where('test_user_ongoings.user_id', Auth::user()->id)
                    ->whereNull('test_user_ongoings.deleted_at')
                    ->first();

        if($ongoing && $ongoing->module_id != $decModuleId){
            Session::flash('info', 'There is another module test ongoing, please finish that first.');
            return redirect()->back();
        }

        // RENDER
        $step = TestStep::with('module')->whereModuleId($decModuleId)->orderBy('order')->first();

        if(!$step){
            Session::flash('info', 'This test is not ready, please try again later.');
            return redirect()->back();
        }

        $questions = TestQuestion::with('step.module', 'choices', 'multiple_inputs', 'group_answer_rows.group_answer_columns')->whereStepId($step->id)->orderBy('order')->get();

        if(count(@$questions ?? []) == 0){
            Session::flash('info', 'This test is not ready, please try again later.');
            return redirect()->back();
        }

        // UPDATE ONGOING
        $test = TestUserOngoing::updateOrCreate([
                        'user_id' => Auth::user()->id,
                        'module_career_id' => $careerModule->id,
                    ],[
                        'status' => 1,
                    ]);

        // UPDATE TARGET
        if($test->target == null) $test->update(['target' => Carbon::now()->addMinutes($step->module->minutes)]);

        // CHECK IF PASS
        if($this->ongoing_pass($test->id)){
            Session::flash('info', 'Your time to do this test has ended. Thank you');
            return redirect()->back();
        }

        return $this->view_page('pages.admin.test.online', ['career_id' => $decCareerId, 'step' => $step, 'questions' => $questions, 'ongoing' => $test, 'title' => ['title_en' => 'Test Online', 'title_in' => 'Test Online']]);
    }

    public function progress(Request $request)
    {
        // return $request->all();

        // GET CAREER
        $career = CmsCareer::join('test_user_careers', 'test_user_careers.career_id', 'cms_career.id')
                    ->where('test_user_careers.user_id', Auth::user()->id)
                    ->whereNull('test_user_careers.deleted_at')
                    ->select('cms_career.*')
                    ->get();

        $decModuleId = '';
        $decCareerId = '';

        try{
            $decModuleId = Crypt::decrypt(@$request->module_id);
            $decCareerId = Crypt::decrypt(@$request->career_id);
        }catch(\Exception $e){
            return redirect(route('home', ['listjobs' => $career]));
        }

        // GET ONGOING
        $ongoing = TestUserOngoing::join('test_career_modules', 'test_career_modules.id', 'test_user_ongoings.module_career_id')
                    ->where('test_career_modules.career_id', $decCareerId)
                    ->where('test_career_modules.module_id', $decModuleId)
                    ->where('test_user_ongoings.user_id', Auth::user()->id)
                    ->whereNull('test_user_ongoings.deleted_at')
                    ->whereNull('test_career_modules.deleted_at')
                    ->select('test_user_ongoings.*')
                    ->first();

        // CHECK IF PASS
        if($this->ongoing_pass($ongoing->id)){
            Session::flash('info', 'Your time to do this test has ended. Thank you');
            return redirect()->route('hometest', ['id' => Crypt::encrypt($decCareerId)]);
        }

        // GET DATA MODULES
        $modules = TestModule::join('test_career_modules', 'test_career_modules.module_id', 'test_modules.id')
                    ->where('test_career_modules.career_id', $decCareerId)
                    ->whereNull('test_career_modules.deleted_at')
                    ->whereNull('test_modules.deleted_at')
                    ->select('test_modules.*', 'test_career_modules.id as module_career_id')
                    ->get();

        $career = CmsCareer::whereId($decCareerId)->first();

        /*
            ANSWERING
        */

        $this->answering($request->all(), $decCareerId); 

        /*
            NAVIGATION
        */

        if($request->navigation == 'last'){

            /*
            SET RESULTS
            */

            $this->set_results($decCareerId, $decModuleId, true); 

            // UPDATE STATUS ONGOING
            $updateOngoing = TestUserOngoing::whereId($ongoing->id)->first();
            if($updateOngoing) $updateOngoing->update(['status' => 2]);

            // CEK FOR REPORT TO HRD
            $zeroCheck = DB::table('test_user_ongoings')
                            ->join('test_career_modules', 'test_career_modules.id', 'test_user_ongoings.module_career_id')
                            ->where('test_user_ongoings.user_id', Auth::user()->id)
                            ->where('test_career_modules.career_id', $decCareerId)
                            ->where('test_user_ongoings.status', 0)
                            ->get()->count();

            if($zeroCheck > 0){
                Session::flash('status', 'Your answer have been submited. Please continue to another section.');
            }else{
                // SEND REPORT TO HRD
                $admemail = 'hr@reandabernardi.com';
                $nmmember = Auth::user()->first_name." ".Auth::user()->last_name;

                $data = array(
                    'name'          => $nmmember,
                    'email'         => Auth::user()->email,
                );

                // Mail::send('emails.notifikasihrd', $data, function ($message) use($admemail, $nmmember) {
                //     $message->from('info@reandabernardi.com', 'Info')->subject('Submit Test '.$nmmember.' | Reanda Bernardi');
                //     $message->to($admemail);
                // });

                Session::flash('status', 'Thank you for taking the test. We will review it shortly.');
            }

            return redirect()->route('hometest', ['id' => Crypt::encrypt($decCareerId)]);
        }

        $decStepId = $this->decrypt($request->step_id, 'module.index');

        $stepPrev = TestStep::whereId($decStepId)->first();

        if(!$stepPrev) return redirect()->route('hometest', ['id' => Crypt::encrypt($decCareerId)]);

        if($request->navigation == 'next'){
            /*
                SET RESULTS
            */

            $this->set_results($decCareerId, $decModuleId); 

            $step = TestStep::whereModuleId($decModuleId)->where('order', '>', $stepPrev->order)->orderBy('order')->first();
        }else if($request->navigation == 'prev'){
            $step = TestStep::whereModuleId($decModuleId)->where('order', '<', $stepPrev->order)->orderBy('order', 'DESC')->first();
        }

        /*
            CHECK STEP AND QUESTIONS
        */

        if(!$step) return redirect()->route('hometest', ['id' => Crypt::encrypt($decCareerId)]);

        $questions = TestQuestion::with('step.module', 'choices', 'multiple_inputs', 'group_answer_rows.group_answer_columns')->whereStepId($step->id)->orderBy('order')->get();

        return $this->view_page('pages.admin.test.online', ['career_id' => $decCareerId, 'step' => $step, 'questions' => $questions, 'ongoing' => $ongoing, 'title' => ['title_en' => 'Test Online', 'title_in' => 'Test Online']]);
    }

    public function answering($data, $career_id = null)
    {
        // return $data;

        foreach ($data as $key => $value) {

            if(in_array($key, $this->except_key())) continue;

            // MAPPING ANSWER
            $question = TestQuestion::whereCode($key)->first();

            if($question){ // QUESTION

                if($question->answer_type == 'Plain' || $question->answer_type == 'Choices'){

                    TestNewUserAnswer::updateOrCreate([
                        'user_id' => Auth::user()->id,
                        'code' => $key,
                        'career_id' => $career_id,
                    ],[
                        'answer' => $value,
                        'explanation' => @$data[$key.'_exp'] ?? null,
                    ]);

                }elseif($question->answer_type == 'Multiple Input'){

                    $multipleInputs = TestMultipleInput::whereQuestionId($question->id)->get();

                    if($multipleInputs->count() > 0){
                        $howMany = count($data[$multipleInputs->first()->code]);

                        // ADD JSON
                        $multipleAnswer = [];

                        for ($i = 0; $i < $howMany; $i++) {

                            $answerDetail = [];
                            foreach ($multipleInputs as $multipleInput) {
                                $answerDetail[$multipleInput->code] = @$data[@$multipleInput->code][$i] ?? null;
                            }

                            array_push($multipleAnswer, $answerDetail);
                        }

                        TestNewUserAnswer::updateOrCreate([
                            'user_id' => Auth::user()->id,
                            'code' => $key,
                            'career_id' => $career_id,
                        ],[
                            'answer' => json_encode($multipleAnswer),
                        ]);
                    }

                }
            }else{

                // SPECIAL CC
                if(Str::contains($key, 'CC')){
                    $question = TestQuestion::join('test_group_answer_rows', 'test_questions.id', 'test_group_answer_rows.question_id')
                                ->join('test_group_answer_columns', 'test_group_answer_rows.id', 'test_group_answer_columns.group_answer_row_id')
                                ->where('test_group_answer_columns.group_code', $key)
                                ->whereNull('test_questions.deleted_at')
                                ->whereNull('test_group_answer_rows.deleted_at')
                                ->whereNull('test_group_answer_columns.deleted_at')
                                ->first();

                    // if($question && $question->transpose_group == 1 && $question->only_one_choice == 2){
                        TestNewUserAnswer::updateOrCreate([
                            'user_id' => Auth::user()->id,
                            'code' => $key,
                            'career_id' => $career_id,
                        ],[
                            'answer' => $value,
                        ]); 
                    // }
                }else if(Str::contains($key, ['GC', 'CR'])){
                    TestNewUserAnswer::updateOrCreate([
                        'user_id' => Auth::user()->id,
                        'code' => $key,
                        'career_id' => $career_id,
                    ],[
                        'answer' => $value,
                    ]); 
                }
            }

        }

        return true;
    }

    public function except_key()
    {
        return ['_token', 'career_id', 'module_id', 'step_id', 'navigation'];
    }

    public function ongoing_pass($id)
    {
        $test = TestUserOngoing::whereId($id)->first();

        if(Carbon::now() > $test->target){
            $test->update(['status' => 2]);
            return true;
        }
    
        return false;
    }

    public function finished(Request $request)
    {
        // return $request->all();

        // GET CAREER
        $career = CmsCareer::join('test_user_careers', 'test_user_careers.career_id', 'cms_career.id')
                    ->where('test_user_careers.user_id', Auth::user()->id)
                    ->whereNull('test_user_careers.deleted_at')
                    ->select('cms_career.*')
                    ->get();

        $decModuleId = '';
        $decCareerId = '';

        try{
            $decModuleId = Crypt::decrypt(@$request->module_id);
            $decCareerId = Crypt::decrypt(@$request->career_id);
        }catch(\Exception $e){
            return redirect(route('home', ['listjobs' => $career]));
        }

        // GET ONGOING
        $ongoing = TestUserOngoing::join('test_career_modules', 'test_career_modules.id', 'test_user_ongoings.module_career_id')
                    ->where('test_career_modules.career_id', $decCareerId)
                    ->where('test_career_modules.module_id', $decModuleId)
                    ->where('test_user_ongoings.user_id', Auth::user()->id)
                    ->whereNull('test_user_ongoings.deleted_at')
                    ->whereNull('test_career_modules.deleted_at')
                    ->select('test_user_ongoings.*')
                    ->first();

        // CHECK IF PASS
        if($ongoing->status != 2){
            Session::flash('info', 'Please finish your test first. Thank you');
            return redirect()->route('hometest', ['id' => Crypt::encrypt($decCareerId)]);
        }

        // GET DATA MODULES
        $modules = TestModule::join('test_career_modules', 'test_career_modules.module_id', 'test_modules.id')
                    ->where('test_career_modules.career_id', $decCareerId)
                    ->whereNull('test_modules.deleted_at')
                    ->whereNull('test_career_modules.deleted_at')
                    ->select('test_modules.*', 'test_career_modules.id as module_career_id')
                    ->get();

        $career = CmsCareer::whereId($decCareerId)->first();

        /*
            NAVIGATION
        */

        if(!isset($request->step_id)){
            $step = TestStep::with('module')->whereModuleId($decModuleId)->orderBy('order')->first();
        }else{
            $decStepId = $this->decrypt($request->step_id, 'module.index');

            $stepPrev = TestStep::whereId($decStepId)->first();

            if(!$stepPrev) return redirect()->route('hometest', ['id' => Crypt::encrypt($decCareerId)]);

            if($request->navigation == 'next'){
                $step = TestStep::whereModuleId($decModuleId)->where('order', '>', $stepPrev->order)->orderBy('order')->first();
            }else if($request->navigation == 'prev'){
                $step = TestStep::whereModuleId($decModuleId)->where('order', '<', $stepPrev->order)->orderBy('order', 'DESC')->first();
            }
        }

        /*
            CHECK STEP AND QUESTIONS
        */

        if(!$step) return redirect()->route('hometest', ['id' => Crypt::encrypt($decCareerId)]);

        $questions = TestQuestion::with('step.module', 'choices', 'multiple_inputs', 'group_answer_rows.group_answer_columns')->whereStepId($step->id)->orderBy('order')->get();

        return $this->view_page('pages.admin.test.finished', ['career_id' => $decCareerId, 'step' => $step, 'questions' => $questions, 'title' => ['title_en' => 'See Answers', 'title_in' => 'See Answers']]);
    }

    public function set_results($career_id, $module_id, $last = false)
    {
        // CHECK IF RESULT COMPLETED
        $check = TestResult::whereUserId(Auth::user()->id)->whereCareerId($career_id)->whereModuleId($module_id)->first();

        if($check){
            if($check->status == 1) return true;
        }

        $module = TestModule::whereId($module_id)->first();

        if($module){
            // $result = TestResult::firstOrCreate([
            //     'career_id' => $career_id,
            //     'module_id' => $module_id,
            // ],[
            //     'status' => 0,
            // ]);

            $score = 0;

            // CROSS CHECK ANSWER AND ADD TO RESULT
            $stepIds = TestStep::whereModuleId($module_id)->pluck('id')->toArray();
            $questions = TestQuestion::whereIn('step_id', $stepIds)->get();

            foreach ($questions as $question) {

                if($question->type == 'Question' && ($question->answer_type == 'Plain' || $question->answer_type == 'Choices')){

                    if($question->right_answer != null && $question->score != null){

                        // dd('OK');

                        $answer = TestNewUserAnswer::whereUserId(Auth::user()->id)->whereCareerId($career_id)->whereCode($question->code)->first();

                        // if($question->code == 'QN7LMDUN0') dd(@$question->score);
                        

                        if($this->simply(@$answer->answer) == $this->simply(@$question->right_answer)) $score += @$question->score ?? 0;

                    }

                }else if($question->type == 'Question' && $question->answer_type == 'Group' && $question->group_answer_type == 1){

                    // dd('OK');

                    $groupColumn = TestGroupAnswerColumn::join('test_group_answer_rows', 'test_group_answer_rows.id', 'test_group_answer_columns.group_answer_row_id')
                                    ->where('test_group_answer_rows.question_id', $question->id)
                                    ->whereNull('test_group_answer_columns.deleted_at')
                                    ->whereNull('test_group_answer_rows.deleted_at')
                                    ->select('test_group_answer_columns.*')
                                    ->get();

                    foreach ($groupColumn as $columnDetail) {
                        
                        if($columnDetail->right_answer != null && $columnDetail->score != null){

                            $answer = TestNewUserAnswer::whereUserId(Auth::user()->id)->whereCareerId($career_id)->whereCode($columnDetail->code)->first();

                            if($this->simply(@$answer->answer) == $this->simply(@$columnDetail->right_answer)) $score += @$columnDetail->score ?? 0;

                        }
                    }
                }

            }

            // CHECK IF MODULE IS AUTOMATED SCORED OR NOT
            if($module->scored == 1 && $last){

                TestResult::updateOrCreate([
                    'user_id' => Auth::user()->id,
                    'career_id' => $career_id,
                    'module_id' => $module_id,
                ],[
                    'score_automated' => $score,
                    'status' => 1,
                ]);

            }else{

                if($module->scored != 3){

                    TestResult::updateOrCreate([
                        'user_id' => Auth::user()->id,
                        'career_id' => $career_id,
                        'module_id' => $module_id,
                    ],[
                        'score_automated' => $score,
                        'status' => 0, // COMPLETED AFTER MARKING
                    ]);

                }else{
                    TestResult::firstOrCreate([
                        'user_id' => Auth::user()->id,
                        'career_id' => $career_id,
                        'module_id' => $module_id,
                        'status' => 1,
                    ]);
                }
                
            }

            return true;
        }

        
    }

    public function finishedResult(Request $request)
    {
        // GET CAREER
        $career = CmsCareer::join('test_user_careers', 'test_user_careers.career_id', 'cms_career.id')
                    ->where('test_user_careers.user_id', Auth::user()->id)
                    ->whereNull('test_user_careers.deleted_at')
                    ->select('cms_career.*')
                    ->get();

        $decModuleId = '';
        $decCareerId = '';
        $decUserId = '';

        try{
            $decModuleId = Crypt::decrypt(@$request->module_id);
            $decCareerId = Crypt::decrypt(@$request->career_id);
            $decUserId = Crypt::decrypt(@$request->user_id);
        }catch(\Exception $e){
            return redirect(route('home', ['listjobs' => $career]));
        }

        // GET ONGOING
        $ongoing = TestUserOngoing::join('test_career_modules', 'test_career_modules.id', 'test_user_ongoings.module_career_id')
                    ->where('test_career_modules.career_id', $decCareerId)
                    ->where('test_career_modules.module_id', $decModuleId)
                    ->where('test_user_ongoings.user_id', $decUserId)
                    ->whereNull('test_user_ongoings.deleted_at')
                    ->whereNull('test_career_modules.deleted_at')
                    ->select('test_user_ongoings.*')
                    ->first();

        // CHECK IF PASS
        if($ongoing->status != 2){
            Session::flash('info', 'Selected module has not been completed by the participants');
            return redirect()->route('result.index');
        }

        // GET DATA MODULES
        $modules = TestModule::join('test_career_modules', 'test_career_modules.module_id', 'test_modules.id')
                    ->where('test_career_modules.career_id', $decCareerId)
                    ->whereNull('test_modules.deleted_at')
                    ->whereNull('test_career_modules.deleted_at')
                    ->select('test_modules.*', 'test_career_modules.id as module_career_id')
                    ->get();

        $career = CmsCareer::whereId($decCareerId)->first();

        /*
            NAVIGATION
        */

        if(!isset($request->step_id)){
            $step = TestStep::with('module')->whereModuleId($decModuleId)->orderBy('order')->first();
        }else{
            $decStepId = $this->decrypt($request->step_id, 'module.index');

            $stepPrev = TestStep::whereId($decStepId)->first();

            if(!$stepPrev) return redirect()->route('hometest', ['id' => Crypt::encrypt($decCareerId)]);

            if($request->navigation == 'next'){
                $step = TestStep::whereModuleId($decModuleId)->where('order', '>', $stepPrev->order)->orderBy('order')->first();
            }else if($request->navigation == 'prev'){
                $step = TestStep::whereModuleId($decModuleId)->where('order', '<', $stepPrev->order)->orderBy('order', 'DESC')->first();
            }
        }

        /*
            CHECK STEP AND QUESTIONS
        */

        if(!$step) return redirect()->route('hometest', ['id' => Crypt::encrypt($decCareerId)]);

        $questions = TestQuestion::with('step.module', 'choices', 'multiple_inputs', 'group_answer_rows.group_answer_columns')->whereStepId($step->id)->orderBy('order')->get();

        return $this->view_page('pages.admin.test.finished-result', ['user_id' => $decUserId, 'career_id' => $decCareerId, 'step' => $step, 'questions' => $questions, 'title' => ['title_en' => 'See Answers', 'title_in' => 'See Answers']]);
    }

    public function expired(Request $request)
    {
        $ongoing = TestUserOngoing::whereId($request->id)->first();

        if(!$ongoing) return response()->json(route('home'));

        $ongoing->update(['status' => 2]);

        return response()->json(route('hometest', Crypt::encrypt($ongoing->module_career->career_id)));
    }

    public function simply($text = '')
    {
        return trim(strtolower($text));
    }

    public function upload(Request $request)
    {
        // return response()->json(['msg' => 'Failed to upload'], 500);

        // return $request->all();

        $user = Auth::user();
        $file = $request->file('file');
        $token = $request->token;
        $code = $request->code;
        $career_id = $request->career_id;
        $filePath = 'test_attachment/'.$code.'/'.$user->id;

        try{

            $fileName = $file->getClientOriginalName();

            if(file_exists(public_path($filePath . '/' . $fileName))){
                $fileName = pathinfo($fileName, PATHINFO_FILENAME) . ' @' . Carbon::now()->timestamp . '.' . pathinfo($fileName, PATHINFO_EXTENSION);
            }

            $filePathDB = url($filePath) . '/' . $fileName;
            $file->move(public_path($filePath), $fileName);

            TestUserUpload::create([
                'user_id' => $user->id,
                'code' => $code,
                'career_id' => $career_id,
                'token' => $token,
                'filename' => $fileName,
                'filepath' => $filePath . '/' . $fileName,
                'url' => $filePathDB,
            ]);

        }catch(\Exception $e){
            \File::delete(public_path($filePath . '/' . $fileName));

            return response()->json(['msg' => 'Failed to upload'], 500);
        }

        // return $file->getClientOriginalName();

        return response()->json(['msg' => 'Success upload file', 'filename' => $fileName, 'url' => $filePathDB], 200);

    }

    public function uploadDelete(Request $request)
    {
        // return $request->all();
        // return env('APP_URL');

        $user = Auth::user();
        $upload = TestUserUpload::whereToken(@$request->token)->first();

        if(!$upload) return response()->json(['msg' => 'Failed to delete'], 500);

        $filePath = 'test_attachment/'.$upload->code.'/'.$user->id.'/'.$upload->filename;

        if(file_exists(public_path($filePath))){
            \File::delete(public_path($filePath));
        }

        $upload->delete();
    }
}
