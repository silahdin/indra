<?php

namespace App\Http\Controllers\Admin\Result;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use DB;
Use Session;
use Auth;
use Crypt;

class PelamarpribadiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function summary($iduser, $jobid) {

        $dpribadi = DB::table('pelamar_pribadi')
        ->where('users_id', $iduser)
        ->where('id_career', $jobid)
        ->first();
        
        return view('result.wizard.summary')->with('dpribadi', $dpribadi)->with('jobid', $jobid)->with('iduser', $iduser);
    }
    
}
