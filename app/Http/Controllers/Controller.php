<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Crypt;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function view_page($blade = 'home', $data = [])
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

	    return view($blade, $data)->with('servs', $serv)->with('footerTrain', $footerTrain)->with('setting', $setting)->with('tata', $tata)->with('hub', $hub)->with('page', $page)->with('post', $post)->with('slider', $slider)->with('footer', $footer)->with('img', $img)->with('partner',$partner)->with('listTrain',$listTrain)->with('testi',$testi);
    }

    public function decrypt($id, $redirect = 'home')
    {
    	try{
            $decId = Crypt::decrypt($id);
        }catch(\Exception $e){
            return redirect(route($redirect));
        }

        return $decId;
    }
}
