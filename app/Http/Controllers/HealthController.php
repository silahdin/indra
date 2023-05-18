<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
Use Session;
use Auth;
use App\HealthQuestion;
use Crypt;

class HealthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function step1($jobid) {
        $dhealth = DB::table('bank_health')
        ->where('st_health', 1)
        ->where('category', 1)
        ->orderBy('id_health', 'ASC')
        ->get();

        $dpribadi = DB::table('health_question')
        ->select('id_hquestion')
        ->where('users_id', Auth::user()->id)
        ->where('id_career', Crypt::decryptString($jobid))
        ->where('id_health', 40)
        ->first();

        if(isset($dpribadi->id_hquestion) && $dpribadi->id_hquestion != "") {
            return view('pages.health.step1')->with('dhealths', $dhealth)->with('jobid', $jobid);
        } else {
            return view('pages.health.step1')->with('dhealths', $dhealth)->with('jobid', $jobid);
        }        
    }

    public function step1_post(Request $request) {
        //dd($request->all());

        $attributeNames = array(
            'q_1'                    => 'question number 1',
            'q_2'                    => 'question number 2',
            'q_3'                    => 'question number 3',
            'q_4'                    => 'question number 4',
            'q_5'                    => 'question number 5',
            'q_6'                    => 'question number 6',
            'q_7'                    => 'question number 7',
            'q_8'                    => 'question number 8',
            'q_9'                    => 'question number 9',
            'q_10'                   => 'question number 10',
            'q_11'                    => 'question number 11',
            'q_12'                    => 'question number 12',
            'q_13'                    => 'question number 13',
            'q_14'                    => 'question number 14',
            'q_15'                    => 'question number 15',
            'q_16'                    => 'question number 16',
            'q_17'                    => 'question number 17',
            'q_18'                    => 'question number 18',
            'q_19'                    => 'question number 19',
            'q_20'                   => 'question number 20',
            'q_21'                    => 'question number 21',
            'q_22'                    => 'question number 22',
            'q_23'                    => 'question number 23',
            'q_24'                    => 'question number 24',
            'q_25'                    => 'question number 25',
            'q_26'                    => 'question number 26',
            'q_27'                    => 'question number 27',
            'q_28'                    => 'question number 28',
            'q_29'                    => 'question number 29',
            'q_30'                   => 'question number 30',
            'q_31'                    => 'question number 31',
            'q_32'                    => 'question number 32',
            'q_33'                    => 'question number 33',
            'q_34'                    => 'question number 34',
            'q_35'                    => 'question number 35',
            'q_36'                    => 'question number 36',
            'q_37'                    => 'question number 37',
            'q_38'                    => 'question number 38',
            'q_39'                    => 'question number 39',
            'q_40'                   => 'question number 40',
            'q_41'                    => 'question number 41',
            'q_42'                    => 'question number 42',
            'q_43'                    => 'question number 43',
            'q_44'                    => 'question number 44',
            'q_45'                    => 'question number 45',
            'q_46'                    => 'question number 46',
            'q_47'                    => 'question number 47',
            'q_48'                    => 'question number 48',
            'q_49'                    => 'question number 49',
            'q_50'                   => 'question number 50',
            'q_51'                    => 'question number 51',
            'q_52'                    => 'question number 52',
            'q_53'                    => 'question number 53',
            'q_54'                    => 'question number 54',
            'q_55'                    => 'question number 55',
            'q_56'                    => 'question number 56',
            'q_57'                    => 'question number 57',
            'q_58'                    => 'question number 58',
            'q_59'                    => 'question number 59',
            'q_60'                   => 'question number 60',
            'q_61'                    => 'question number 61',
            'q_62'                    => 'question number 62',
            'q_63'                    => 'question number 63',
            'q_64'                    => 'question number 64',
            'q_65'                    => 'question number 65',
            'q_66'                    => 'question number 66',
            'q_67'                    => 'question number 67',
            'q_68'                    => 'question number 68',
            'q_69'                    => 'question number 69',
            'q_70'                   => 'question number 70',
            'q_71'                   => 'question number 71',
         );

        $validator = \Validator::make($request->all(), [
            'q_1'                    => 'required',
            'q_2'                    => 'required',
            'q_3'                    => 'required',
            'q_4'                    => 'required',
            'q_5'                    => 'required',
            'q_6'                    => 'required',
            'q_7'                    => 'required',
            'q_8'                    => 'required',
            'q_9'                    => 'required',
            'q_10'                   => 'required',
            'q_11'                    => 'required',
            'q_12'                    => 'required',
            'q_13'                    => 'required',
            'q_14'                    => 'required',
            'q_15'                    => 'required',
            'q_16'                    => 'required',
            'q_17'                    => 'required',
            'q_18'                    => 'required',
            'q_19'                    => 'required',
            'q_20'                   => 'required',
            'q_21'                    => 'required',
            'q_22'                    => 'required',
            'q_23'                    => 'required',
            'q_24'                    => 'required',
            'q_25'                    => 'required',
            'q_26'                    => 'required',
            'q_27'                    => 'required',
            'q_28'                    => 'required',
            'q_29'                    => 'required',
            'q_30'                   => 'required',
            'q_31'                    => 'required',
            'q_32'                    => 'required',
            'q_33'                    => 'required',
            'q_34'                    => 'required',
            'q_35'                    => 'required',
            'q_36'                    => 'required',
            'q_37'                    => 'required',
            'q_38'                    => 'required',
            'q_39'                    => 'required',
            'q_40'                   => 'required',
            'q_41'                    => 'required',
            'q_42'                    => 'required',
            'q_43'                    => 'required',
            'q_44'                    => 'required',
            'q_45'                    => 'required',
            'q_46'                    => 'required',
            'q_47'                    => 'required',
            'q_48'                    => 'required',
            'q_49'                    => 'required',
            
            'q_53'                    => 'required',
            'q_54'                    => 'required',
            'q_55'                    => 'required',
            'q_56'                    => 'required',
            'q_57'                    => 'required',
            'q_58'                    => 'required',
            'q_59'                    => 'required',
            'q_60'                   => 'required',
            'q_61'                    => 'required',
            'q_62'                    => 'required',
            
            'q_64'                    => 'required',
            'q_65'                    => 'required',
        ]);
        $validator->setAttributeNames($attributeNames);

        if($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }

        $count = 71; //count($request->q);
        $i = 1;

        while($i <= $count) {

            $jwab = "q_".$i;
            $rmks = "k_".$i;
            //if($request->$jwab != "") {
                $plang = HealthQuestion::create([
                    'users_id'      => Auth::user()->id,
                    'id_career'     => Crypt::decryptString($request->idjob),
                    'id_health'     => $request->q[$i],
                    'jwb'           => $request->$jwab,
                    'remarks'       => $request->$rmks
                ]);
            //}

        $i++;
        } 

        //Lock Jawaba Peserta
        DB::table('tbl_test_user')->where('users_id', Auth::user()->id)->where('id_test', 5)->update(['st_test' => 1, 'updated_at' => NOW()]);

        $status = "success"; $msg = "Data have been success to saved";
        $response = array(
            'status' => $status,
            'msg' => $msg,
        );
        return response()->json($response); 

    }

    public function truncate(){

        HealthQuestion::truncate();

        DB::table('tbl_test_user')->where('users_id', Auth::user()->id)->where('id_test', 5)->delete();

        return redirect()->route('home');
    }
}
