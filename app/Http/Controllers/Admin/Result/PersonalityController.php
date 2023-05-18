<?php

namespace App\Http\Controllers\Admin\Result;
use App\Http\Controllers\Controller;

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
    
    public function summary($iduser, $jobid) {
        $dpers = DB::table('bank_words')
        ->select('id_words', 'question', 'key')
        ->where('category', 'person')
        ->where('key', 1)
        ->where('st_words', 1)
        ->orderBy('id_words', 'ASC')
        ->take(4)
        ->get();

        return view('result.personality.step1')->with('dpers', $dpers)->with('jobid', $jobid)->with('iduser', $iduser);                
    }
}
