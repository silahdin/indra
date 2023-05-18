<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
Use Session;
use Auth;
use App\PersonalityQuestion;
use Crypt;

class PersonalityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function step1($jobid) {
        $dpers = DB::table('bank_words')
        ->select('id_words', 'question', 'key')
        ->where('category', 'person')
        ->where('key', 1)
        ->where('st_words', 1)
        ->orderBy('id_words', 'ASC')
        ->take(4)
        ->get();

        return view('pages.personality.step1')->with('dpers', $dpers)->with('jobid', $jobid);      
    }

    public function step1_post(Request $request) {

        //dd($request->all());

        $attributeNames = array(
            'jwb_m_1'                    => 'question M number 1',
            'jwb_l_1'                    => 'question L number 1',
            'jwb_m_2'                    => 'question M number 2',
            'jwb_l_2'                    => 'question L number 2',
            'jwb_m_3'                    => 'question M number 3',
            'jwb_l_3'                    => 'question L number 3',
            'jwb_m_4'                    => 'question M number 4',
            'jwb_l_4'                    => 'question L number 4',
            'jwb_m_5'                    => 'question M number 5',
            'jwb_l_5'                    => 'question L number 5',
            'jwb_m_6'                    => 'question M number 6',
            'jwb_l_6'                    => 'question L number 6',
            'jwb_m_7'                    => 'question M number 7',
            'jwb_l_7'                    => 'question L number 7',
            'jwb_m_8'                    => 'question M number 8',
            'jwb_l_8'                    => 'question L number 8',
            'jwb_m_9'                    => 'question M number 9',
            'jwb_l_9'                    => 'question L number 9',
            'jwb_m_10'                    => 'question M number 10',
            'jwb_l_10'                    => 'question L number 10',
            'jwb_m_11'                    => 'question M number 11',
            'jwb_l_11'                    => 'question L number 11',
            'jwb_m_12'                    => 'question M number 12',
            'jwb_l_12'                    => 'question L number 12',
            'jwb_m_13'                    => 'question M number 13',
            'jwb_l_13'                    => 'question L number 13',
            'jwb_m_14'                    => 'question M number 14',
            'jwb_l_14'                    => 'question L number 14',
            'jwb_m_15'                    => 'question M number 15',
            'jwb_l_15'                    => 'question L number 15',
            'jwb_m_16'                    => 'question M number 16',
            'jwb_l_16'                    => 'question L number 16',
            'jwb_m_17'                    => 'question M number 17',
            'jwb_l_17'                    => 'question L number 17',
            'jwb_m_18'                    => 'question M number 18',
            'jwb_l_18'                    => 'question L number 18',
            'jwb_m_19'                    => 'question M number 19',
            'jwb_l_19'                    => 'question L number 19',
            'jwb_m_20'                    => 'question M number 20',
            'jwb_l_20'                    => 'question L number 20',
            'jwb_m_21'                    => 'question M number 21',
            'jwb_l_21'                    => 'question L number 21',
            'jwb_m_22'                    => 'question M number 22',
            'jwb_l_22'                    => 'question L number 22',
            'jwb_m_23'                    => 'question M number 23',
            'jwb_l_23'                    => 'question L number 23',
            'jwb_m_24'                    => 'question M number 24',
            'jwb_l_24'                    => 'question L number 24',
         );

        $validator = \Validator::make($request->all(), [
            'jwb_m_1'             => 'required',
            'jwb_l_1'             => 'required',
            'jwb_m_2'             => 'required',
            'jwb_l_2'             => 'required',
            'jwb_m_3'             => 'required',
            'jwb_l_3'             => 'required',
            'jwb_m_4'             => 'required',
            'jwb_l_4'             => 'required',
            'jwb_m_5'             => 'required',
            'jwb_l_5'             => 'required',
            'jwb_m_6'             => 'required',
            'jwb_l_6'             => 'required',
            'jwb_m_7'             => 'required',
            'jwb_l_7'             => 'required',
            'jwb_m_8'             => 'required',
            'jwb_l_8'             => 'required',
            'jwb_m_9'             => 'required',
            'jwb_l_9'             => 'required',
            'jwb_m_10'             => 'required',
            'jwb_l_10'             => 'required',
            'jwb_m_11'             => 'required',
            'jwb_l_11'             => 'required',
            'jwb_m_12'             => 'required',
            'jwb_l_12'             => 'required',
            'jwb_m_13'             => 'required',
            'jwb_l_13'             => 'required',
            'jwb_m_14'             => 'required',
            'jwb_l_14'             => 'required',
            'jwb_m_15'             => 'required',
            'jwb_l_15'             => 'required',
            'jwb_m_16'             => 'required',
            'jwb_l_16'             => 'required',
            'jwb_m_17'             => 'required',
            'jwb_l_17'             => 'required',
            'jwb_m_18'             => 'required',
            'jwb_l_18'             => 'required',
            'jwb_m_19'             => 'required',
            'jwb_l_19'             => 'required',
            'jwb_m_20'             => 'required',
            'jwb_l_20'             => 'required',
            'jwb_m_21'             => 'required',
            'jwb_l_21'             => 'required',
            'jwb_m_22'             => 'required',
            'jwb_l_22'             => 'required',
            'jwb_m_23'             => 'required',
            'jwb_l_23'             => 'required',
            'jwb_m_24'             => 'required',
            'jwb_l_24'             => 'required',
        ]);
        $validator->setAttributeNames($attributeNames);

        if($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }

        $count = 96;
        for ($i=1; $i <= $count; $i++) {
            $mjwb = "jwb_m_".$i;
            $ljwb = "jwb_l_".$i;
            
            if(isset($request->$mjwb) && $request->$mjwb != "") {
                $dperson = PersonalityQuestion::create([
                    'users_id'          => Auth::user()->id,
                    'id_career'            => Crypt::decryptString($request->idjob),
                    'id_words_m'          => substr($request->$mjwb, 2),
                    'jwb_m'             => substr($request->$mjwb, 0, 1),
                    'id_words_l'          => substr($request->$ljwb, 2),
                    'jwb_l'             => substr($request->$ljwb, 0, 1),
                ]);
            }

        }

        //Update status menjadi Lock
        DB::table('tbl_test_user')->where('id_test', 4)->where('users_id', Auth::user()->id)->update(['st_test' => 1, 'updated_at' => NOW()]);

        $status = "success"; $msg = "Data have been success to saved"; 

        $response = array(
            'status' => $status,
            'msg' => $msg,
        );
        return response()->json($response); 

    }

    public function truncate(){

        PersonalityQuestion::truncate();

        DB::table('tbl_test_user')->where('users_id', Auth::user()->id)->where('id_test', 4)->delete();

        return redirect()->route('home');
    }
}
