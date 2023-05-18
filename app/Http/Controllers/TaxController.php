<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
Use Session;
use Auth;
use App\TaxQuestion;
use App\TaxQuestionWord;
use Crypt;

class TaxController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function step1($jobid) {
        $dtax = DB::table('bank_question')
        ->select('bank_question.id_question', 'bank_question.question', 'bank_question.a', 'bank_question.b', 'bank_question.c', 'bank_question.d', 'english_question.jwb')
        ->leftJoin('english_question', 'english_question.id_question', '=', 'bank_question.id_question')
        ->where('category', 'tax1')
        ->orderBy('bank_question.id_question', 'ASC')
        ->get();

        return view('pages.tax.step1')->with('dtaxs', $dtax)->with('jobid', $jobid);      
    }

    public function step1_post(Request $request) {
        //dd($request->all());

        $attributeNames = array(
            'jwb_116'                  => 'question number 1',
            'jwb_117'                    => 'question number 2',
            'jwb_118'                    => 'question number 3',
            'jwb_119'                    => 'question number 4',
            'jwb_120'                    => 'question number 5',
            'jwb_121'                    => 'question number 6',
            'jwb_122'                    => 'question number 7',
            'jwb_123'                    => 'question number 8',
            'jwb_124'                    => 'question number 9',
            'jwb_125'                    => 'question number 10',
            'jwb_126'                    => 'question number 11',
            'jwb_127'                    => 'question number 12',
            'jwb_128'                    => 'question number 13',
            'jwb_129'                    => 'question number 14',
            'jwb_130'                    => 'question number 15',
            'jwb_131'                    => 'question number 16',
            'jwb_132'                    => 'question number 17',
            'jwb_133'                    => 'question number 18',
            'jwb_134'                    => 'question number 19',
            'jwb_135'                    => 'question number 20',
         );

        $validator = \Validator::make($request->all(), [
            'jwb_116'             => 'required',
            'jwb_117'             => 'required',
            'jwb_118'             => 'required',
            'jwb_119'             => 'required',
            'jwb_120'             => 'required',
            'jwb_121'             => 'required',
            'jwb_122'             => 'required',
            'jwb_123'             => 'required',
            'jwb_124'             => 'required',
            'jwb_125'             => 'required',
            'jwb_126'             => 'required',
            'jwb_127'             => 'required',
            'jwb_128'             => 'required',
            'jwb_129'             => 'required',
            'jwb_130'             => 'required',
            'jwb_131'             => 'required',
            'jwb_132'             => 'required',
            'jwb_133'             => 'required',
            'jwb_134'             => 'required',
            'jwb_135'             => 'required',
        ]);
        $validator->setAttributeNames($attributeNames);

        if($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }

        $count = count($request->q);
        for ($i=0; $i < $count; $i++) {
            $nil = "jwb_".$request->q[$i];
            $jenglish = TaxQuestion::create([
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

    public function step2($jobid) {

        $dtax = DB::table('bank_words')
        ->select('id_words', 'question')
        ->where('category', 'tax')
        ->where('st_words', 1)
        ->orderBy('id_words', 'ASC')
        ->get();

        return view('pages.tax.step2')->with('dtaxs', $dtax)->with('jobid', $jobid);
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
            'jwb_10'                    => 'question number 10',
            'jwb_11'                    => 'question number 11',
            'jwb_12'                    => 'question number 12',
            'jwb_13'                    => 'question number 13',
            'jwb_14'                    => 'question number 14',
            'jwb_15'                    => 'question number 15',
            'jwb_16'                    => 'question number 16',
            'jwb_17'                    => 'question number 17',
            'jwb_18'                    => 'question number 18',
            'jwb_19'                    => 'question number 19',
            'jwb_20'                    => 'question number 10',
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
            'jwb_51'                    => 'question number 51',
            'jwb_52'                    => 'question number 52',
            'jwb_53'                    => 'question number 53',
            'jwb_54'                    => 'question number 54',
            'jwb_55'                    => 'question number 55',
            'jwb_56'                    => 'question number 56',
            'jwb_57'                    => 'question number 57',
            'jwb_58'                    => 'question number 58',
            'jwb_59'                    => 'question number 59',
            'jwb_60'                    => 'question number 60',
            'jwb_61'                    => 'question number 61',
            'jwb_62'                    => 'question number 62',
            'jwb_63'                    => 'question number 63',
            'jwb_64'                    => 'question number 64',
            'jwb_65'                    => 'question number 65',
            'jwb_66'                    => 'question number 66',
            'jwb_67'                    => 'question number 67',
            'jwb_68'                    => 'question number 68',
            'jwb_69'                    => 'question number 69',
            'jwb_70'                    => 'question number 70',
            'jwb_71'                    => 'question number 71',
            'jwb_72'                    => 'question number 72',
            'jwb_73'                    => 'question number 73',
            'jwb_74'                    => 'question number 74',
            'jwb_75'                    => 'question number 75',
            'jwb_76'                    => 'question number 76',
            'jwb_77'                    => 'question number 77',
            'jwb_78'                    => 'question number 78',
            'jwb_79'                    => 'question number 79',
            'jwb_80'                    => 'question number 80',
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
            'jwb_10'             => 'required',
            'jwb_11'             => 'required',
            'jwb_12'             => 'required',
            'jwb_13'             => 'required',
            'jwb_14'             => 'required',
            'jwb_15'             => 'required',
            'jwb_16'             => 'required',
            'jwb_17'             => 'required',
            'jwb_18'             => 'required',
            'jwb_19'             => 'required',
            'jwb_20'             => 'required',
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
            'jwb_76'             => 'required',
            'jwb_77'             => 'required',
            'jwb_78'             => 'required',
            'jwb_79'             => 'required',
            'jwb_80'             => 'required',
        ]);
        $validator->setAttributeNames($attributeNames);

        if($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }

        $count = count($request->q);
        for ($i=0; $i < $count; $i++) {
            $nil = "jwb_".$request->q[$i];
            $jenglish = TaxQuestionWord::create([
                'users_id'         => Auth::user()->id,
                'id_career'            => Crypt::decryptString($request->idjob),
                'id_words'         => $request->q[$i],
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

    public function step3($jobid) {

        $dtax = DB::table('bank_question')
        ->select('bank_question.id_question', 'bank_question.question', 'bank_question.a', 'bank_question.b', 'bank_question.c', 'bank_question.d', 'bank_question.e', 'english_question.jwb')
        ->leftJoin('english_question', 'english_question.id_question', '=', 'bank_question.id_question')
        ->where('category', 'tax7')
        ->orderBy('bank_question.id_question', 'ASC')
        ->get();

        return view('pages.tax.step3')->with('dtaxs', $dtax)->with('jobid', $jobid); 
    }

    public function step3_post(Request $request) {
        //dd($request->all());

        $attributeNames = array(
            'jwb_136'                    => 'question number 1',
            'jwb_137'                    => 'question number 2',
            'jwb_138'                    => 'question number 3',
            'jwb_139'                    => 'question number 4',
            'jwb_140'                    => 'question number 5',
            'jwb_141'                    => 'question number 6',
            'jwb_142'                    => 'question number 7',
            'jwb_143'                    => 'question number 8',
            'jwb_144'                    => 'question number 9',
            'jwb_145'                    => 'question number 10',
         );

        $validator = \Validator::make($request->all(), [
            'jwb_136'             => 'required',
            'jwb_137'             => 'required',
            'jwb_138'             => 'required',
            'jwb_139'             => 'required',
            'jwb_140'             => 'required',
            'jwb_141'             => 'required',
            'jwb_142'             => 'required',
            'jwb_143'             => 'required',
            'jwb_144'             => 'required',
            'jwb_145'             => 'required',
        ]);
        $validator->setAttributeNames($attributeNames);

        if($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }

        $count = count($request->q);
        for ($i=0; $i < $count; $i++) {
            $nil = "jwb_".$request->q[$i];
            $jenglish = TaxQuestion::create([
                'users_id'         => Auth::user()->id,
                'id_career'            => Crypt::decryptString($request->idjob),
                'id_question'      => $request->q[$i],
                'jwb'              => $request->$nil,
            ]);
        }

        //Update status menjadi Lock
        DB::table('tbl_test_user')->where('id_test', 7)->where('users_id', Auth::user()->id)->update(['st_test' => 1, 'updated_at' => NOW()]);

        $status = "success"; $msg = "Data have been success to saved"; 

        $response = array(
            'status' => $status,
            'msg' => $msg,
        );
        return response()->json($response); 

    }

    public function truncate(){

        TechnicalQuestion::truncate();

        DB::table('tbl_test_user')->where('users_id', Auth::user()->id)->where('id_test', 7)->delete();

        return redirect()->route('home');
    }
}
