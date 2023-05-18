<?php

namespace App\Http\Controllers\Admin\Result;
use App\Http\Controllers\Controller;

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

    public function step2($iduser, $jobid) {

        $dtax = DB::table('bank_words')
        ->select('id_words', 'question', 'key')
        ->where('category', 'tax')
        ->where('st_words', 1)
        ->orderBy('id_words', 'ASC')
        ->get();

        return view('result.tax.step2')->with('dtaxs', $dtax)->with('jobid', $jobid)->with('iduser', $iduser);
    }
}
