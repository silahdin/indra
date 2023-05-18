<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
Use Session;
use Auth;
use App\EnglishEssay;
use App\EnglishQuestion;
use Crypt;

class EnglishController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function step1($jobid) {
        $denglish = DB::table('bank_essay')
        ->where('st_bankessay', 1)
        ->orderBy('id_bankessay', 'ASC')
        ->get();

        $dpribadi = DB::table('english_essay')
        ->select('id_essay')
        ->where('users_id', Auth::user()->id)
        ->where('id_career', Crypt::decryptString($jobid))
        ->first();

        if(isset($dpribadi->id_essay) && $dpribadi->id_essay != "") {
            return view('pages.english.step1edit')->with('denglish', $denglish)->with('jobid', $jobid);
        } else {
            return view('pages.english.step1')->with('denglish', $denglish)->with('jobid', $jobid);
        }        
    }

    public function step1_post(Request $request) {
        //dd($request->all());

        $attributeNames = array(
            'answer.0'                    => 'question number 1',
            'answer.1'                    => 'question number 2',
            'answer.2'                    => 'question number 3',
            'answer.3'                    => 'question number 4',
            'answer.4'                    => 'question number 5',
         );

        $validator = \Validator::make($request->all(), [
            'answer.0'          => 'required',
            'answer.1'          => 'required',
            'answer.2'          => 'required',
            'answer.3'          => 'required',
            'answer.4'          => 'required',
        ]);
        $validator->setAttributeNames($attributeNames);

        if($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }

        $count = count($request->q);
        if($request->step=="1e") {
            for ($i=0; $i < $count; $i++) {
                if($request->answer[$i] != "") {
                    $jenglish = DB::table('english_essay')->where('id_bankessay', $request->q[$i])->where('users_id', Auth::user()->id)->where('id_career', Crypt::decryptString($request->idjob))->update(['answer' => $request->answer[$i]]);
                }
            }
        } else {
            for ($i=0; $i < $count; $i++) {
                //DB::table('english_essay')->where('id_bankessay', $request->q[$i])->where('users_id', Auth::user()->id)->update(['answer' => $request->answer[$i]]);
                if($request->answer[$i] != "") {
                    $jenglish = EnglishEssay::create([
                        'users_id'              => Auth::user()->id,
                        'id_career'            => Crypt::decryptString($request->idjob),
                        'id_bankessay'          => $request->q[$i],
                        'answer'                => $request->answer[$i],
                    ]);
                }
            }
        }

        //if($jenglish) { 
            $status = "success"; $msg = "Data have been success to saved"; //} 
        //else { $status = "failed"; $msg = "Data have been failed to saved"; }
        
        $response = array(
            'status' => $status,
            'msg' => $msg,
        );
        return response()->json($response); 

    }

    public function step2($jobid) {
        $denglish = DB::table('bank_question')
        ->select('bank_question.id_question', 'bank_question.question', 'bank_question.a', 'bank_question.b', 'bank_question.c', 'bank_question.d', 'english_question.jwb')
        ->leftJoin('english_question', 'english_question.id_question', '=', 'bank_question.id_question')
        ->where('category', 'english_step1')
        ->orderBy('bank_question.id_question', 'ASC')
        ->groupBy('bank_question.id_question')
        ->get();

        $dpribadi = DB::table('bank_question')
        ->select('id_equestion')
        ->leftJoin('english_question', 'english_question.id_question', '=', 'bank_question.id_question')
        ->where('category', 'english_step1')
        ->where('users_id', Auth::user()->id)
        ->where('id_career', Crypt::decryptString($jobid))
        ->first();

        if(isset($dpribadi->id_equestion) && $dpribadi->id_equestion != "") {
            return view('pages.english.step2edit')->with('denglish', $denglish)->with('jobid', $jobid);  
        } else {
            return view('pages.english.step2')->with('denglish', $denglish)->with('jobid', $jobid);
        }   
    }

    public function step2_post(Request $request) {
        //dd($request->all());

        $attributeNames = array(
            'jwb_1'                    => 'question number 1',
            'jwb_2'                    => 'question number 2',
            'jwb_3'                    => 'question number 3',
            'jwb_4'                    => 'question number 4',
            'jwb_5'                    => 'question number 5',
            'jwb_6'                    => 'question number 6',
            'jwb_7'                    => 'question number 7',
            'jwb_8'                    => 'question number 8',
            'jwb_9'                    => 'question number 9',
            'jwb_10'                   => 'question number 10',
            'jwb_11'                   => 'question number 11',
            'jwb_12'                   => 'question number 12',
            'jwb_13'                   => 'question number 13',
            'jwb_14'                   => 'question number 14',
            'jwb_15'                   => 'question number 15',
            'jwb_16'                   => 'question number 16',
            'jwb_17'                   => 'question number 17',
            'jwb_18'                   => 'question number 18',
            'jwb_19'                   => 'question number 19',
            'jwb_20'                   => 'question number 20',
         );

        $validator = \Validator::make($request->all(), [
            'jwb_1'             => 'required',
            'jwb_2'             => 'required',
            'jwb_3'             => 'required',
            'jwb_4'             => 'required',
            'jwb_5'             => 'required',
            'jwb_6'             => 'required',
            'jwb_7'             => 'required',
            'jwb_8'             => 'required',
            'jwb_9'             => 'required',
            'jwb_10'            => 'required',
            'jwb_11'            => 'required',
            'jwb_12'            => 'required',
            'jwb_13'            => 'required',
            'jwb_14'            => 'required',
            'jwb_15'            => 'required',
            'jwb_16'            => 'required',
            'jwb_17'            => 'required',
            'jwb_18'            => 'required',
            'jwb_19'            => 'required',
            'jwb_20'            => 'required',
        ]);
        $validator->setAttributeNames($attributeNames);

        if($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }

        if($request->step=="2e") {
            $count = count($request->q);
            for ($i=0; $i < $count; $i++) {
                $nil = "jwb_".$request->q[$i];
                DB::table('english_question')->where('id_question', $request->q[$i])->where('users_id', Auth::user()->id)->where('id_career', Crypt::decryptString($request->idjob))->update(['jwb' => $request->$nil]);
            }

            //if($jenglish) { 
                $status = "success"; $msg = "Data have been success to saved"; //} 
                //else { $status = "failed"; $msg = "Data have been failed to saved"; }
        } else {
            $count = count($request->q);
            for ($i=0; $i < $count; $i++) {
                $nil = "jwb_".$request->q[$i];
                $jenglish = EnglishQuestion::create([
                    'users_id'         => Auth::user()->id,
                    'id_career'            => Crypt::decryptString($request->idjob),
                    'id_question'      => $request->q[$i],
                    'jwb'              => $request->$nil,
                ]);
            }

            if($jenglish) { 
                $status = "success"; $msg = "Data have been success to saved"; } 
            else { $status = "failed"; $msg = "Data have been failed to saved"; }
        }

        
        
        $response = array(
            'status' => $status,
            'msg' => $msg,
        );
        return response()->json($response); 

    }

    public function step3($jobid) {
        $denglish = DB::table('bank_question')
        ->select('bank_question.id_question', 'bank_question.question', 'bank_question.a', 'bank_question.b', 'bank_question.c', 'bank_question.d', 'bank_question.e', 'english_question.jwb')
        ->leftJoin('english_question', 'english_question.id_question', '=', 'bank_question.id_question')
        ->where('category', 'english_step2')
        ->orderBy('bank_question.id_question', 'ASC')
        ->groupBy('bank_question.id_question')
        ->get();

        $dpribadi = DB::table('bank_question')
        ->select('id_equestion')
        ->leftJoin('english_question', 'english_question.id_question', '=', 'bank_question.id_question')
        ->where('category', 'english_step2')
        ->where('users_id', Auth::user()->id)
        ->where('id_career', Crypt::decryptString($jobid))
        ->first();

        if(isset($dpribadi->id_equestion) && $dpribadi->id_equestion != "") {
            return view('pages.english.step3edit')->with('denglish', $denglish)->with('jobid', $jobid);  
        } else {
            return view('pages.english.step3')->with('denglish', $denglish)->with('jobid', $jobid);
        }       
    }

    public function step3_post(Request $request) {
        //dd($request->all());

        $attributeNames = array(
            'jwb_21'                    => 'question number 21',
            'jwb_22'                    => 'question number 22',
            'jwb_23'                    => 'question number 23',
            'jwb_24'                    => 'question number 24',
            'jwb_25'                    => 'question number 25',
            'jwb_26'                    => 'question number 26',
            'jwb_27'                    => 'question number 27',
            'jwb_28'                    => 'question number 28',
            'jwb_29'                    => 'question number 29',
            'jwb_30'                    => 'question number 30',
         );

        $validator = \Validator::make($request->all(), [
            'jwb_21'             => 'required',
            'jwb_22'             => 'required',
            'jwb_23'             => 'required',
            'jwb_24'             => 'required',
            'jwb_25'             => 'required',
            'jwb_26'             => 'required',
            'jwb_27'             => 'required',
            'jwb_28'             => 'required',
            'jwb_29'             => 'required',
            'jwb_30'             => 'required',
        ]);
        $validator->setAttributeNames($attributeNames);

        if($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }

        if($request->step=="3e") {
            $count = count($request->q);
            for ($i=0; $i < $count; $i++) {
                $nil = "jwb_".$request->q[$i];
                DB::table('english_question')->where('id_question', $request->q[$i])->where('users_id', Auth::user()->id)->where('id_career', Crypt::decryptString($request->idjob))->update(['jwb' => $request->$nil]);
            }

            //if($jenglish) { 
                $status = "success"; $msg = "Data have been success to saved"; //} 
                //else { $status = "failed"; $msg = "Data have been failed to saved"; }
        } else {
            $count = count($request->q);
            for ($i=0; $i < $count; $i++) {
                $nil = "jwb_".$request->q[$i];
                $jenglish = EnglishQuestion::create([
                    'users_id'         => Auth::user()->id,
                    'id_career'            => Crypt::decryptString($request->idjob),
                    'id_question'      => $request->q[$i],
                    'jwb'              => $request->$nil,
                ]);
            }

            if($jenglish) { 
                $status = "success"; $msg = "Data have been success to saved"; } 
            else { $status = "failed"; $msg = "Data have been failed to saved"; }
        }
        
        $response = array(
            'status' => $status,
            'msg' => $msg,
        );
        return response()->json($response); 

    }

    public function step4($jobid) {
        $denglish = DB::table('bank_question')
        ->select('bank_question.id_question', 'bank_question.question', 'bank_question.a', 'bank_question.b', 'bank_question.c', 'bank_question.d', 'english_question.jwb')
        ->leftJoin('english_question', 'english_question.id_question', '=', 'bank_question.id_question')
        ->where('category', 'english_step3')
        ->orderBy('bank_question.id_question', 'ASC')
        ->groupBy('bank_question.id_question')
        ->get();

        $dpribadi = DB::table('bank_question')
        ->select('id_equestion')
        ->leftJoin('english_question', 'english_question.id_question', '=', 'bank_question.id_question')
        ->where('category', 'english_step3')
        ->where('users_id', Auth::user()->id)
        ->where('id_career', Crypt::decryptString($jobid))
        ->first();

        if(isset($dpribadi->id_equestion) && $dpribadi->id_equestion != "") {
            return view('pages.english.step4edit')->with('denglish', $denglish)->with('jobid', $jobid);  
        } else {
            return view('pages.english.step4')->with('denglish', $denglish)->with('jobid', $jobid);
        }   
    }

    public function step4_post(Request $request) {
        //dd($request->all());

        $attributeNames = array(
            'jwb_31'                    => 'question number 31',
            'jwb_32'                    => 'question number 32',
            'jwb_33'                    => 'question number 33',
            'jwb_34'                    => 'question number 34',
            'jwb_35'                    => 'question number 35',
            'jwb_36'                    => 'question number 36',
            'jwb_37'                    => 'question number 37',
            'jwb_38'                    => 'question number 38',
            'jwb_39'                    => 'question number 39',
            'jwb_40'                    => 'question number 40',
            'jwb_41'                    => 'question number 41',
            'jwb_42'                    => 'question number 42',
            'jwb_43'                    => 'question number 43',
            'jwb_44'                    => 'question number 44',
            'jwb_45'                    => 'question number 45',
            'jwb_46'                    => 'question number 46',
            'jwb_47'                    => 'question number 47',
            'jwb_48'                    => 'question number 48',
            'jwb_49'                    => 'question number 49',
            'jwb_50'                    => 'question number 50',
         );

        $validator = \Validator::make($request->all(), [
            'jwb_31'             => 'required',
            'jwb_32'             => 'required',
            'jwb_33'             => 'required',
            'jwb_34'             => 'required',
            'jwb_35'             => 'required',
            'jwb_36'             => 'required',
            'jwb_37'             => 'required',
            'jwb_38'             => 'required',
            'jwb_39'             => 'required',
            'jwb_40'             => 'required',
            'jwb_41'             => 'required',
            'jwb_42'             => 'required',
            'jwb_43'             => 'required',
            'jwb_44'             => 'required',
            'jwb_45'             => 'required',
            'jwb_46'             => 'required',
            'jwb_47'             => 'required',
            'jwb_48'             => 'required',
            'jwb_49'             => 'required',
            'jwb_50'             => 'required',
        ]);
        $validator->setAttributeNames($attributeNames);

        if($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }

        if($request->step=="4e") {
            $count = count($request->q);
            for ($i=0; $i < $count; $i++) {
                $nil = "jwb_".$request->q[$i];
                DB::table('english_question')->where('id_question', $request->q[$i])->where('users_id', Auth::user()->id)->where('id_career', Crypt::decryptString($request->idjob))->update(['jwb' => $request->$nil]);
            }

            //if($jenglish) { 
                $status = "success"; $msg = "Data have been success to saved"; //} 
                //else { $status = "failed"; $msg = "Data have been failed to saved"; }
        } else {
            $count = count($request->q);
            for ($i=0; $i < $count; $i++) {
                $nil = "jwb_".$request->q[$i];
                $jenglish = EnglishQuestion::create([
                    'users_id'         => Auth::user()->id,
                    'id_career'            => Crypt::decryptString($request->idjob),
                    'id_question'      => $request->q[$i],
                    'jwb'              => $request->$nil,
                ]);
            }

            if($jenglish) { 
                $status = "success"; $msg = "Data have been success to saved"; } 
            else { $status = "failed"; $msg = "Data have been failed to saved"; }
        }

        //Update status menjadi Lock
        DB::table('tbl_test_user')->where('id_test', 2)->where('users_id', Auth::user()->id)->where('id_career', Crypt::decryptString($request->idjob))->update(['st_test' => 1, 'updated_at' => NOW()]);
        
        $response = array(
            'status' => $status,
            'msg' => $msg,
        );
        return response()->json($response); 

    }

    public function english_summary($jobid) {
        $denglish = DB::table('bank_essay')
        ->leftJoin('english_essay', 'english_essay.id_bankessay', '=', 'bank_essay.id_bankessay')
        ->where('st_bankessay', 1)
        ->orderBy('bank_essay.id_bankessay', 'ASC')
        ->get();

        $denglish2 = DB::table('bank_question')
        ->select('bank_question.id_question', 'bank_question.question', 'bank_question.a', 'bank_question.b', 'bank_question.c', 'bank_question.d', 'bank_question.e', 'english_question.jwb', 'bank_question.key')
        ->leftJoin('english_question', 'english_question.id_question', '=', 'bank_question.id_question')
        //->where('category', 'english_step1')
        ->whereIn('bank_question.category', ['english_step1', 'english_step2', 'english_step3'])
        ->groupBy('bank_question.id_question')
        ->orderBy('bank_question.id_question', 'ASC')
        ->get();

        return view('pages.english.summary')->with('denglish', $denglish)->with('denglish2', $denglish2)->with('jobid', $jobid);    
    }

    public function truncate(){

        EnglishEssay::truncate();
        EnglishQuestion::truncate();

        DB::table('tbl_test_user')->where('users_id', Auth::user()->id)->where('id_test', 2)->delete();

        return redirect()->route('home');
    }

}
