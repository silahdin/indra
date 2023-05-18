<?php

namespace App\Http\Controllers\Admin\Result;
use App\Http\Controllers\Controller;
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

    public function summary($iduser, $jobid) {
        $denglish = DB::table('bank_essay')
        ->leftJoin('english_essay', 'english_essay.id_bankessay', '=', 'bank_essay.id_bankessay')
        //->where('st_bankessay', 1)
        ->where('users_id', $iduser)
        ->groupBy('bank_essay.id_bankessay')
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

        return view('result.english.summary')->with('denglish', $denglish)->with('denglish2', $denglish2)->with('jobid', $jobid)->with('iduser', $iduser);          
    }

}
