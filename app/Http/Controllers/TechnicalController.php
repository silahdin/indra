<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
Use Session;
use Auth;
use App\TechnicalQuestion;
use App\TechnicalAdditional;
use Crypt;

class TechnicalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function test1($jobid) {
        $denglish = DB::table('bank_question')
        ->select('bank_question.id_question', 'bank_question.question', 'bank_question.a', 'bank_question.b', 'bank_question.c', 'bank_question.d', 'english_question.jwb')
        ->leftJoin('english_question', 'english_question.id_question', '=', 'bank_question.id_question')
        ->where('category', 'technical_step1a')
        ->orderBy('bank_question.id_question', 'ASC')
        ->get();

        $denglish2 = DB::table('bank_question')
        ->select('bank_question.id_question', 'bank_question.question', 'bank_question.a', 'bank_question.b', 'bank_question.c', 'bank_question.d', 'english_question.jwb')
        ->leftJoin('english_question', 'english_question.id_question', '=', 'bank_question.id_question')
        ->where('category', 'technical_step1b')
        ->orderBy('bank_question.id_question', 'ASC')
        ->get();

        $dpribadi = DB::table('bank_question')
        ->select('id_equestion')
        ->leftJoin('english_question', 'english_question.id_question', '=', 'bank_question.id_question')
        ->where('category', 'technical_step1a')
        ->where('users_id', Auth::user()->id)
        ->where('id_career', Crypt::decryptString($jobid))
        ->first();

        if(isset($dpribadi->id_essay) && $dpribadi->id_essay != "") {
            return view('pages.technical.test1')->with('denglish', $denglish)->with('denglish2', $denglish2)->with('jobid', $jobid);
        } else {
            return view('pages.technical.test1')->with('denglish', $denglish)->with('denglish2', $denglish2)->with('jobid', $jobid);
        }        
    }

    public function step1_post(Request $request) {
        //dd($request->all());

        $attributeNames = array(
            'jwb_51'                    => 'question number 1',
            'jwb_52'                    => 'question number 2',
            'jwb_53'                    => 'question number 3',
            'jwb_54'                    => 'question number 4',
            'jwb_55'                    => 'question number 5',
            'jwb_56'                    => 'question number 6',
            'jwb_57'                    => 'question number 7',
            'jwb_58'                    => 'question number 8',
            'jwb_59'                    => 'question number 9',
            'jwb_60'                    => 'question number 10',
            'jwb_61'                    => 'question number 11',
            'jwb_62'                    => 'question number 12',
            'jwb_63'                    => 'question number 13',
            'jwb_64'                    => 'question number 14',
            'jwb_65'                    => 'question number 15',
            'jwb_66'                    => 'question number 16',
            'jwb_67'                    => 'question number 17',
            'jwb_68'                    => 'question number 18',
            'jwb_69'                    => 'question number 19',
            'jwb_70'                    => 'question number 20',
            'jwb_71'                    => 'question number 21',
            'jwb_72'                    => 'question number 22',
            'jwb_73'                    => 'question number 23',
            'jwb_74'                    => 'question number 24',
            'jwb_75'                    => 'question number 25',
         );

        $validator = \Validator::make($request->all(), [
            'jwb_51'             => 'required',
            'jwb_52'             => 'required',
            'jwb_53'             => 'required',
            'jwb_54'             => 'required',
            'jwb_55'             => 'required',
            'jwb_56'             => 'required',
            'jwb_57'             => 'required',
            'jwb_58'             => 'required',
            'jwb_59'             => 'required',
            'jwb_60'             => 'required',
            'jwb_61'             => 'required',
            'jwb_62'             => 'required',
            'jwb_63'             => 'required',
            'jwb_64'             => 'required',
            'jwb_65'             => 'required',
            'jwb_66'             => 'required',
            'jwb_67'             => 'required',
            'jwb_68'             => 'required',
            'jwb_69'             => 'required',
            'jwb_70'             => 'required',
            'jwb_71'             => 'required',
            'jwb_72'             => 'required',
            'jwb_73'             => 'required',
            'jwb_74'             => 'required',
            'jwb_75'             => 'required',
        ]);
        $validator->setAttributeNames($attributeNames);

        if($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }

        $count = count($request->q);
        for ($i=0; $i < $count; $i++) {
            $nil = "jwb_".$request->q[$i];
            $jenglish = TechnicalQuestion::create([
                'users_id'         => Auth::user()->id,
                'id_career'            => Crypt::decryptString($request->idjob),
                'id_question'      => $request->q[$i],
                'jwb'              => $request->$nil,
            ]);
        }

        $status = "success"; $msg = "Data have been success to saved"; 

        $response = array(
            'status' => $status,
            'msg' => $msg,
        );
        return response()->json($response); 

    }

    public function test2($jobid) {
        $denglish = DB::table('bank_question')
        ->select('bank_question.id_question', 'bank_question.question', 'bank_question.a', 'bank_question.b', 'bank_question.c', 'bank_question.d', 'english_question.jwb')
        ->leftJoin('english_question', 'english_question.id_question', '=', 'bank_question.id_question')
        ->where('category', 'technical_step26')
        ->orderBy('bank_question.id_question', 'ASC')
        ->get();

        $denglish2 = DB::table('bank_question')
        ->select('bank_question.id_question', 'bank_question.question', 'bank_question.a', 'bank_question.b', 'bank_question.c', 'bank_question.d', 'english_question.jwb')
        ->leftJoin('english_question', 'english_question.id_question', '=', 'bank_question.id_question')
        ->where('category', 'technical_step27')
        ->orderBy('bank_question.id_question', 'ASC')
        ->get();

        $dpribadi = DB::table('bank_question')
        ->select('id_equestion')
        ->leftJoin('english_question', 'english_question.id_question', '=', 'bank_question.id_question')
        ->where('category', 'technical_step1a')
        ->where('users_id', Auth::user()->id)
        ->where('id_career', Crypt::decryptString($jobid))
        ->first();

        if(isset($dpribadi->id_essay) && $dpribadi->id_essay != "") {
            return view('pages.technical.test2')->with('denglish', $denglish)->with('denglish2', $denglish2)->with('jobid', $jobid);
        } else {
            return view('pages.technical.test2')->with('denglish', $denglish)->with('denglish2', $denglish2)->with('jobid', $jobid);
        }        
    }

    public function step2_post(Request $request) {
        //dd($request->all());

        $attributeNames = array(
            'jwb_76'                    => 'question number 26',
            'jwb_77'                    => 'question number 27',
            'jwb_78'                    => 'question number 28',
            'jwb_79'                    => 'question number 29',
            'jwb_80'                    => 'question number 30',
            'jwb_81'                    => 'question number 31',
            'jwb_82'                    => 'question number 32',
            'jwb_83'                    => 'question number 33',
            'jwb_84'                    => 'question number 34',
            'jwb_85'                    => 'question number 35',
            'jwb_86'                    => 'question number 36',
            'jwb_87'                    => 'question number 37',
            'jwb_88'                    => 'question number 38',
            'jwb_89'                    => 'question number 39',
            'jwb_90'                    => 'question number 40',
            'jwb_91'                    => 'question number 41',
            'jwb_92'                    => 'question number 42',
            'jwb_93'                    => 'question number 43',
            'jwb_94'                    => 'question number 44',
            'jwb_95'                    => 'question number 45',
            'jwb_96'                    => 'question number 46',
            'jwb_97'                    => 'question number 47',
            'jwb_98'                    => 'question number 48',
            'jwb_99'                    => 'question number 49',
            'jwb_100'                   => 'question number 50',
            
         );

        $validator = \Validator::make($request->all(), [
            'jwb_76'             => 'required',
            'jwb_77'             => 'required',
            'jwb_78'             => 'required',
            'jwb_79'             => 'required',
            'jwb_80'             => 'required',
            'jwb_81'             => 'required',
            'jwb_82'             => 'required',
            'jwb_83'             => 'required',
            'jwb_84'             => 'required',
            'jwb_85'             => 'required',
            'jwb_86'             => 'required',
            'jwb_87'             => 'required',
            'jwb_88'             => 'required',
            'jwb_89'             => 'required',
            'jwb_90'             => 'required',
            'jwb_91'             => 'required',
            'jwb_92'             => 'required',
            'jwb_93'             => 'required',
            'jwb_94'             => 'required',
            'jwb_95'             => 'required',
            'jwb_96'             => 'required',
            'jwb_97'             => 'required',
            'jwb_98'             => 'required',
            'jwb_99'             => 'required',
            'jwb_100'            => 'required',
            
        ]);
        $validator->setAttributeNames($attributeNames);

        if($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }

        $count = count($request->q);
        for ($i=0; $i < $count; $i++) {
            $nil = "jwb_".$request->q[$i];
            $jenglish = TechnicalQuestion::create([
                'users_id'         => Auth::user()->id,
                'id_career'            => Crypt::decryptString($request->idjob),
                'id_question'      => $request->q[$i],
                'jwb'              => $request->$nil,
            ]);
        }

        //Update status menjadi Lock
        DB::table('tbl_test_user')->where('id_test', 3)->where('users_id', Auth::user()->id)->update(['st_test' => 1, 'updated_at' => NOW()]);

        $status = "success"; $msg = "Data have been success to saved"; 

        $response = array(
            'status' => $status,
            'msg' => $msg,
        );
        return response()->json($response); 

    }

    public function set3($jobid) {
        $denglish = DB::table('bank_question')
        ->select('bank_question.id_question', 'bank_question.question', 'bank_question.a', 'bank_question.b', 'bank_question.c', 'bank_question.d', 'english_question.jwb')
        ->leftJoin('english_question', 'english_question.id_question', '=', 'bank_question.id_question')
        ->where('category', 'technical_test31')
        ->orderBy('bank_question.id_question', 'ASC')
        ->get();

        $denglish2 = DB::table('bank_question')
        ->select('bank_question.id_question', 'bank_question.question', 'bank_question.a', 'bank_question.b', 'bank_question.c', 'bank_question.d', 'english_question.jwb')
        ->leftJoin('english_question', 'english_question.id_question', '=', 'bank_question.id_question')
        ->where('category', 'technical_test32')
        ->orderBy('bank_question.id_question', 'ASC')
        ->get();


        return view('pages.technical.set3')->with('denglish', $denglish)->with('denglish2', $denglish2)->with('jobid', $jobid);      
    }

    public function set3_post(Request $request) {
        //dd($request->all());

        $attributeNames = array(
            'jwb_101'                    => 'question number 1',
            'jwb_102'                    => 'question number 2',
            'jwb_103'                    => 'question number 3',
            'jwb_104'                    => 'question number 4',
            'jwb_105'                    => 'question number 5',
            'jwb_106'                    => 'question number 6',
            'jwb_107'                    => 'question number 7',
            'jwb_108'                    => 'question number 8',
            'jwb_109'                    => 'question number 9',
            'jwb_110'                    => 'question number 10',
            'jwb_111'                    => 'question number 11',
            'jwb_112'                    => 'question number 12',
            'jwb_113'                    => 'question number 13',
            'jwb_114'                    => 'question number 14',
            'jwb_115'                    => 'question number 15',
            
         );

        $validator = \Validator::make($request->all(), [
            'jwb_101'             => 'required',
            'jwb_102'             => 'required',
            'jwb_103'             => 'required',
            'jwb_104'             => 'required',
            'jwb_105'             => 'required',
            'jwb_106'             => 'required',
            'jwb_107'             => 'required',
            'jwb_108'             => 'required',
            'jwb_109'             => 'required',
            'jwb_110'             => 'required',
            'jwb_111'             => 'required',
            'jwb_112'             => 'required',
            'jwb_113'             => 'required',
            'jwb_114'             => 'required',
            'jwb_115'             => 'required',            
        ]);
        $validator->setAttributeNames($attributeNames);

        if($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }

        $count = count($request->q);
        for ($i=0; $i < $count; $i++) {
            $nil = "jwb_".$request->q[$i];
            $jenglish = TechnicalQuestion::create([
                'users_id'         => Auth::user()->id,
                'id_career'            => Crypt::decryptString($request->idjob),
                'id_question'      => $request->q[$i],
                'jwb'              => $request->$nil,
            ]);
        }

        //Update status menjadi Lock
        DB::table('tbl_test_user')->where('id_test', 6)->where('users_id', Auth::user()->id)->update(['st_test' => 1, 'updated_at' => NOW()]);

        $status = "success"; $msg = "Data have been success to saved"; 

        $response = array(
            'status' => $status,
            'msg' => $msg,
        );
        return response()->json($response); 

    }

    public function set4($jobid) {

        return view('pages.technical.set4')->with('jobid', $jobid);      
    }

    public function set4_post(Request $request) {
        //dd($request->all()); //59

        $attributeNames = array(
            'jwb_1_1_1' => 'question number 1',
            'jwb_1_1_2' => 'question number 1',
            'jwb_1_1_3' => 'question number 1',
            'jwb_1_1_4' => 'question number 1',
            'jwb_1_2_1' => 'question number 1',
            'jwb_1_2_2' => 'question number 1',
            'jwb_1_2_3' => 'question number 1',
            'jwb_1_2_4' => 'question number 1',
            'jwb_1_3_1' => 'question number 1',
            'jwb_1_3_2' => 'question number 1',
            'jwb_1_3_3' => 'question number 1',
            'jwb_1_3_4' => 'question number 1',
            'jwb_1_4_1' => 'question number 1',
            'jwb_1_4_3' => 'question number 1',
            'jwb_2_1_1' => 'question number 2',
            'jwb_2_1_2' => 'question number 2',
            'jwb_2_2_1' => 'question number 2',
            'jwb_2_2_2' => 'question number 2',
            'jwb_2_3_1' => 'question number 2',
            'jwb_2_4_1' => 'question number 2',
            'jwb_2_4_2' => 'question number 2',
            'jwb_2_5_1' => 'question number 2',
            'jwb_3_1_1' => 'question number 3',
            'jwb_3_1_2' => 'question number 3',
            'jwb_3_2_1' => 'question number 3',
            'jwb_3_2_2' => 'question number 3',
            'jwb_3_3_1' => 'question number 3',
            'jwb_3_4_1' => 'question number 3',
            'jwb_3_4_2' => 'question number 3',
            'jwb_3_5_1' => 'question number 3',
            'jwb_4_1_2' => 'question number 4',
            'jwb_4_3_1' => 'question number 4',
            'jwb_4_4_1' => 'question number 4',
            'jwb_4_5_1' => 'question number 4',
            'jwb_4_6_2' => 'question number 4',
            'jwb_4_7_1' => 'question number 4',
            'jwb_4_8_1' => 'question number 4',
            'jwb_4_9_1' => 'question number 4',
            'jwb_4_10_2' => 'question number 4',
            'jwb_4_11_2' => 'question number 4',
            'jwb_4_12_2' => 'question number 4',
            'jwb_4_13_2' => 'question number 4',
            'jwb_4_14_2' => 'question number 4',
            'jwb_4_15_2' => 'question number 4',
            'jwb_4_16_1' => 'question number 4',
            'jwb_4_17_2' => 'question number 4',
            'jwb_5_1_1' => 'question number 5',
            'jwb_5_1_2' => 'question number 5',
            'jwb_5_1_3' => 'question number 5',
            'jwb_5_1_4' => 'question number 5',
            'jwb_5_2_1' => 'question number 5',
            'jwb_5_2_2' => 'question number 5',
            'jwb_5_2_3' => 'question number 5',
            'jwb_5_2_4' => 'question number 5',
            'jwb_5_3_1' => 'question number 5',
            'jwb_5_3_2' => 'question number 5',
            'jwb_5_3_3' => 'question number 5',
            'jwb_5_3_4' => 'question number 5',
            'jwb_5_4_4' => 'question number 5',
         );

        $validator = \Validator::make($request->all(), [
            'jwb_1_1_1' => 'required',
            'jwb_1_1_2' => 'required',
            'jwb_1_1_3' => 'required',
            'jwb_1_1_4' => 'required',
            'jwb_1_2_1' => 'required',
            'jwb_1_2_2' => 'required',
            'jwb_1_2_3' => 'required',
            'jwb_1_2_4' => 'required',
            'jwb_1_3_1' => 'required',
            'jwb_1_3_2' => 'required',
            'jwb_1_3_3' => 'required',
            'jwb_1_3_4' => 'required',
            'jwb_1_4_1' => 'required',
            'jwb_1_4_3' => 'required',
            'jwb_2_1_1' => 'required',
            'jwb_2_1_2' => 'required',
            'jwb_2_2_1' => 'required',
            'jwb_2_2_2' => 'required',
            'jwb_2_3_1' => 'required',
            'jwb_2_4_1' => 'required',
            'jwb_2_4_2' => 'required',
            'jwb_2_5_1' => 'required',
            'jwb_3_1_1' => 'required',
            'jwb_3_1_2' => 'required',
            'jwb_3_2_1' => 'required',
            'jwb_3_2_2' => 'required',
            'jwb_3_3_1' => 'required',
            'jwb_3_4_1' => 'required',
            'jwb_3_4_2' => 'required',
            'jwb_3_5_1' => 'required',
            'jwb_4_1_2' => 'required',
            'jwb_4_3_1' => 'required',
            'jwb_4_4_1' => 'required',
            'jwb_4_5_1' => 'required',
            'jwb_4_6_2' => 'required',
            'jwb_4_7_1' => 'required',
            'jwb_4_8_1' => 'required',
            'jwb_4_9_1' => 'required',
            'jwb_4_10_2' => 'required',
            'jwb_4_11_2' => 'required',
            'jwb_4_12_2' => 'required',
            'jwb_4_13_2' => 'required',
            'jwb_4_14_2' => 'required',
            'jwb_4_15_2' => 'required',
            'jwb_4_16_1' => 'required',
            'jwb_4_17_2' => 'required',
            'jwb_5_1_1' => 'required',
            'jwb_5_1_2' => 'required',
            'jwb_5_1_3' => 'required',
            'jwb_5_1_4' => 'required',
            'jwb_5_2_1' => 'required',
            'jwb_5_2_2' => 'required',
            'jwb_5_2_3' => 'required',
            'jwb_5_2_4' => 'required',
            'jwb_5_3_1' => 'required',
            'jwb_5_3_2' => 'required',
            'jwb_5_3_3' => 'required',
            'jwb_5_3_4' => 'required',
            'jwb_5_4_4' => 'required',      
              
        ]);
        $validator->setAttributeNames($attributeNames);

        if($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }

        //Update status menjadi Lock
        DB::table('tbl_test_user')->where('id_test', 8)->where('users_id', Auth::user()->id)->update(['st_test' => 1, 'updated_at' => NOW()]);

        $dreq = $request->all();
        $query = TechnicalAdditional::create($dreq);

        $lastid = $query->id_tadd;

        DB::table('technical_additional')->where('id_tadd', $lastid)->update(['users_id' => Auth::user()->id, 'id_career' => Crypt::decryptString($request->idjob)]);

        if($query){
            $notification = "success";
        } else{
            $notification = "Failed";
        }

        $status = $notification; $msg = "Data have been success to saved"; 

        $response = array(
            'status' => $status,
            'msg' => $msg,
        );
        return response()->json($response); 

    }

    public function truncate(){

        TechnicalQuestion::truncate();

        DB::table('tbl_test_user')->where('users_id', Auth::user()->id)->where('id_test', 3)->delete();
        DB::table('tbl_test_user')->where('users_id', Auth::user()->id)->where('id_test', 6)->delete();
        DB::table('tbl_test_user')->where('users_id', Auth::user()->id)->where('id_test', 8)->delete();

        return redirect()->route('home');
    }
}
