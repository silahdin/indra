<?php

namespace App\Http\Controllers\Admin\Result;
use App\Http\Controllers\Controller;

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

    public function step1($iduser, $jobid) {
        $dhealth = DB::table('bank_health')
        ->where('st_health', 1)
        ->where('category', 1)
        ->orderBy('id_health', 'ASC')
        ->get();

        $dpribadi = DB::table('health_question')
        ->select('id_hquestion')
        ->where('users_id', $iduser)
        ->where('id_career', $jobid)
        ->where('id_health', 40)
        ->first();

        return view('result.health.step1')->with('dhealths', $dhealth)->with('jobid', $jobid)->with('iduser', $iduser); 
    }

}
