<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Auth;
use DB;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showLinkRequestForm()
    {
        if(Auth::check() && $blade == 'home') $blade = 'home_reg';

        $footer = DB::table('cms_contact')
        ->where('id', 1)
        ->first();

        $img = DB::table('cms_image')
        ->where('id', 1)
        ->first();

        $page = DB::table('cms_homepage')
        ->where('id', 1)
        ->first();

        $hub = DB::table('cms_hubinvest')
        ->first();

        $tata = DB::table('cms_goverment')
        ->first();

        $slider = DB::table('cms_slider')
        ->where('rowstate', 1)
        ->orderBy('id', 'ASC')
        ->get();

        $footerTrain = DB::table('cms_training')
        ->where('rowstate', 1)
        ->orderBy('id', 'ASC')
        ->get();

        $partner = DB::table('cms_partner')
        ->where('rowstate', 1)
        ->orderBy('id', 'ASC')
        ->get();

        $testi = DB::table('cms_testi')
        ->where('rowstate', 1)
        ->orderBy('id', 'ASC')
        ->get();

        $listTrain = DB::table('cms_training')
        ->where('rowstate', 1)
        ->orderBy('id', 'ASC')
        ->get();

        $post = DB::table('cms_article')
        ->select('cms_article.*', 'cms_categories.name_in', 'cms_categories.name_en')
        ->leftJoin('cms_categories', 'cms_categories.id', '=', 'cms_article.categories_id')
        ->where('cms_article.rowstate', 1)
        ->orderBy('article_id', 'DESC')
        ->get();

        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();

        $serv = DB::table('cms_servicelist')
        ->orderBy('sortir', 'ASC')
        ->get();

        return view('auth.passwords.email')->with('servs', $serv)->with('footerTrain', $footerTrain)->with('setting', $setting)->with('tata', $tata)->with('hub', $hub)->with('page', $page)->with('post', $post)->with('slider', $slider)->with('footer', $footer)->with('img', $img)->with('partner',$partner)->with('listTrain',$listTrain)->with('testi',$testi);
    }
}
