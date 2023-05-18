<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;

use DB;
use Session;
use Auth;

use App;
use App\Push;
use App\CmsNova;
use App\CmsBranch;
use App\CmsMessages;
use App\CmsSubscribed;
use App\CmsTrainRegis;

class NewComproController extends Controller{

  public function langIn(){
    $langIN = 'in';
    session()->put('langIN', $langIN);
        // session()->forget('id_selected_offer');
    session()->forget('langEN');
    return redirect()->back();
  }



  public function langEn(){
    $langEN = 'en';
    session()->put('langEN', $langEN);
    session()->forget('langIN');
    return redirect()->back();
  }

  public function index($lang='en') {

    if(Auth::check()) return redirect()->route('home');

    $lang_org = session('language');

    if ($lang_org == NULL) {
      App::setlocale($lang);

      session(['language' => $lang]);
    }

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

    return view('pages.compro.home')->with('servs', $serv)->with('footerTrain', $footerTrain)->with('setting', $setting)->with('tata', $tata)->with('hub', $hub)->with('page', $page)->with('post', $post)->with('slider', $slider)->with('footer', $footer)->with('img', $img)->with('partner',$partner)->with('listTrain',$listTrain)->with('testi',$testi);
  }



  public function service(){

    $title = new \stdClass();
    $title->title_in = 'Pelayanan';
    $title->title_en = 'Services';

    $services = DB::table('cms_services')
    ->where('rowstate', 1)
    ->orderBy('id', 'ASC')
    ->get();

    $servicespage = DB::table('cms_servicepage')
    ->where('id', 1)
    ->first();

    $footer = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    $hub = DB::table('cms_hubinvest')
    ->first();

    $tata = DB::table('cms_goverment')
    ->first();


    $serv = DB::table('cms_servicelist')
    ->orderBy('name', 'ASC')
    ->get();


    $content = DB::table('cms_about')
    ->first();

    $menuTop = DB::table('cms_pages')
    ->leftJoin('cms_position', 'cms_position.position_id', '=', 'cms_pages.position')
    ->where('cms_pages.rowstate', 1)
    ->where('cms_pages.position', 2)
    ->orderBy('cms_pages.id', 'ASC')
    ->get();

    $menuMiddle = DB::table('cms_pages')
    ->leftJoin('cms_position', 'cms_position.position_id', '=', 'cms_pages.position')
    ->where('cms_pages.rowstate', 1)
    ->where('cms_pages.position', 1)
    ->orderBy('cms_pages.id', 'ASC')
    ->get();

    $setting = DB::table('cms_setting')
    ->where('id', 1)
    ->first();


     $imgTop = DB::table('cms_img_top')
    ->where('id', 1)
    ->first();
      return view('pages.compro.service')->with('servs', $serv)->with('setting', $setting)->with('content', $content)->with('tata', $tata)->with('hub', $hub)->with('menuTop', $menuTop)->with('menuMiddle', $menuMiddle)->with('footer', $footer)->with('title', $title)->with('imgTop', $imgTop)->with('services',$services)->with('servicespage',$servicespage);
  }

  public function AboutUs(){

    $title = new \stdClass();
    $title->title_in = 'Tentang Kami';
    $title->title_en = 'About Us';

    $serv = DB::table('cms_servicelist')
    ->orderBy('name', 'ASC')
    ->get();

    $footer = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    $timtrainer = DB::table('cms_timtrainer')
    ->where('rowstate', 1)
    ->get();


    $timmanagement  = DB::table('cms_timmanagement')
    ->where('rowstate', 1)
    ->get();

    $content = DB::table('cms_about')
    ->first();

    $visi = DB::table('cms_vision')
    ->first();

    $menuTop = DB::table('cms_pages')
    ->leftJoin('cms_position', 'cms_position.position_id', '=', 'cms_pages.position')
    ->where('cms_pages.rowstate', 1)
    ->where('cms_pages.position', 2)
    ->orderBy('cms_pages.id', 'ASC')
    ->get();

    $menuMiddle = DB::table('cms_pages')
    ->leftJoin('cms_position', 'cms_position.position_id', '=', 'cms_pages.position')
    ->where('cms_pages.rowstate', 1)
    ->where('cms_pages.position', 1)
    ->orderBy('cms_pages.id', 'ASC')
    ->get();

    $setting = DB::table('cms_setting')
    ->where('id', 1)
    ->first();

    $footerTrain = DB::table('cms_training')
    ->where('rowstate', 1)
    ->orderBy('id', 'ASC')
    ->get();

     $imgTop = DB::table('cms_img_top')
    ->where('id', 1)
    ->first();

      return view('pages.compro.about')->with('servs', $serv)->with('setting', $setting)->with('content', $content)->with('footerTrain', $footerTrain)->with('timtrainer', $timtrainer)->with('menuTop', $menuTop)->with('menuMiddle', $menuMiddle)->with('footer', $footer)->with('title', $title)->with('imgTop', $imgTop)->with('visi', $visi)->with('timmanagement', $timmanagement) ;
  }


  public function visi(){

    $title = new \stdClass();
    $title->title_in = 'Visi & Misi';
    $title->title_en = 'Vision & Mission';

    $title = new \stdClass();
    $title->title_in = 'Tentang Kami';
    $title->title_en = 'About Us';

    $serv = DB::table('cms_servicelist')
    ->orderBy('name', 'ASC')
    ->get();


    $footer = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    $timtrainer = DB::table('cms_timtrainer')
    ->where('rowstate', 1)
    ->get();

    $content = DB::table('cms_about')
    ->first();


    $menuTop = DB::table('cms_pages')
    ->leftJoin('cms_position', 'cms_position.position_id', '=', 'cms_pages.position')
    ->where('cms_pages.rowstate', 1)
    ->where('cms_pages.position', 2)
    ->orderBy('cms_pages.id', 'ASC')
    ->get();

    $menuMiddle = DB::table('cms_pages')
    ->leftJoin('cms_position', 'cms_position.position_id', '=', 'cms_pages.position')
    ->where('cms_pages.rowstate', 1)
    ->where('cms_pages.position', 1)
    ->orderBy('cms_pages.id', 'ASC')
    ->get();

    $setting = DB::table('cms_setting')
    ->where('id', 1)
    ->first();

    $footerTrain = DB::table('cms_training')
    ->where('rowstate', 1)
    ->orderBy('id', 'ASC')
    ->get();

     $imgTop = DB::table('cms_img_top')
    ->where('id', 1)
    ->first();

    return view('pages.compro.about')->with('servs', $serv)->with('setting', $setting)->with('content', $content)->with('footerTrain', $footerTrain)->with('timtrainer', $timtrainer)->with('menuTop', $menuTop)->with('menuMiddle', $menuMiddle)->with('footer', $footer)->with('title', $title)->with('imgTop', $imgTop);
  }


  public function management(){

    $title = new \stdClass();
    $title->title_in = 'Manajemen Gedung';
    $title->title_en = 'Building Management';

    $footer = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    $serv = DB::table('cms_servicelist')
    ->orderBy('name', 'ASC')
    ->get();

    $timtrainer = DB::table('cms_timtrainer')
    ->where('rowstate', 1)
    ->get();

    $content = DB::table('cms_management')
    ->first();

    $visi = DB::table('cms_vision')
    ->first();

    $menuTop = DB::table('cms_pages')
    ->leftJoin('cms_position', 'cms_position.position_id', '=', 'cms_pages.position')
    ->where('cms_pages.rowstate', 1)
    ->where('cms_pages.position', 2)
    ->orderBy('cms_pages.id', 'ASC')
    ->get();

    $menuMiddle = DB::table('cms_pages')
    ->leftJoin('cms_position', 'cms_position.position_id', '=', 'cms_pages.position')
    ->where('cms_pages.rowstate', 1)
    ->where('cms_pages.position', 1)
    ->orderBy('cms_pages.id', 'ASC')
    ->get();

    $setting = DB::table('cms_setting')
    ->where('id', 1)
    ->first();

    $footerTrain = DB::table('cms_training')
    ->where('rowstate', 1)
    ->orderBy('id', 'ASC')
    ->get();

    $listTrain = DB::table('cms_management')
    ->where('rowstate', 1)
    ->orderBy('id', 'ASC')
    ->get();

     $imgTop = DB::table('cms_img_top')
    ->where('id', 1)
    ->first();

    return view('pages.compro.management')->with('servs', $serv)->with('setting', $setting)->with('content', $content)->with('footer', $footer)->with('title', $title)->with('footerTrain', $footerTrain)->with('listTrain', $listTrain);
  }

  public function managementSingle($id){

    $content = DB::table('cms_management')
    ->where('rowstate', 1)
    ->where('id', $id)
    ->first();

    $title = new \stdClass();
    $title->title_in = 'Manajemen Gedung - '.$content->title_in;
    $title->title_en = 'Building Management - '.$content->title_en;

    $serv = DB::table('cms_servicelist')
    ->orderBy('name', 'ASC')
    ->get();


    $footer = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    $listTrain = DB::table('cms_management')
    ->where('rowstate', 1)
    ->where('id', $id)
    ->first();

    $setting = DB::table('cms_setting')
    ->where('id', 1)
    ->first();

    $footerTrain = DB::table('cms_training')
    ->where('rowstate', 1)
    ->orderBy('id', 'ASC')
    ->get();

    return view('pages.compro.managementSingle')->with('servs', $serv)->with('setting', $setting)->with('content', $content)->with('footer', $footer)->with('title', $title)->with('footerTrain', $footerTrain)->with('listTrain', $listTrain);
  }

  public function getRegister(){

    $title = new \stdClass();
    $title->title_in = 'Daftar';
    $title->title_en = 'Register';

    $footer = DB::table('cms_contact')
    ->where('id', 1)
    ->first();


    $serv = DB::table('cms_servicelist')
    ->orderBy('name', 'ASC')
    ->get();

    $hub = DB::table('cms_hubinvest')
    ->first();

    $tata = DB::table('cms_goverment')
    ->first();

    $menuTop = DB::table('cms_pages')
    ->leftJoin('cms_position', 'cms_position.position_id', '=', 'cms_pages.position')
    ->where('cms_pages.rowstate', 1)
    ->where('cms_pages.position', 2)
    ->orderBy('cms_pages.id', 'ASC')
    ->get();

    $menuMiddle = DB::table('cms_pages')
    ->leftJoin('cms_position', 'cms_position.position_id', '=', 'cms_pages.position')
    ->where('cms_pages.rowstate', 1)
    ->where('cms_pages.position', 1)
    ->orderBy('cms_pages.id', 'ASC')
    ->get();

    $setting = DB::table('cms_setting')
    ->where('id', 1)
    ->first();


    return view('pages.compro.getResigter')->with('servs', $serv)->with('setting', $setting)->with('tata', $tata)->with('hub', $hub)->with('menuTop', $menuTop)->with('menuMiddle', $menuMiddle)->with('footer', $footer)->with('title', $title);

  }

  public function mediaCenter(){
    $title = new \stdClass();
    $title->title_in = 'Media Center';
    $title->title_en = "Media Center";

    $footer = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    $serv = DB::table('cms_servicelist')
    ->orderBy('name', 'ASC')
    ->get();


    $setting = DB::table('cms_setting')
    ->where('id', 1)
    ->first();

    $otherPost = DB::table('cms_article')
    ->orderBy('article_id', 'DESC')
    ->where('cms_article.rowstate', 1)
    ->get();

    $post = DB::table('cms_article')
    ->select('cms_article.*', 'cms_categories.name_in', 'cms_categories.name_en')
    ->leftJoin('cms_categories', 'cms_categories.id', '=', 'cms_article.categories_id')
    ->where('cms_article.rowstate', 1)
    ->orderBy('article_id', 'DESC')
    ->paginate(6);

      $footerTrain = DB::table('cms_training')
      ->where('rowstate', 1)
      ->orderBy('id', 'ASC')
      ->get();

     $imgTop = DB::table('cms_img_top')
    ->where('id', 1)
    ->first();

    return view('pages.compro.mediaCenter')->with('servs', $serv)->with('otherPost', $otherPost)->with('post', $post)->with('setting', $setting)->with('footerTrain', $footerTrain)->with('footer', $footer)->with('title', $title)->with('imgTop', $imgTop);
  }

  public function mediaCenterOne($id,$url){
    $title = new \stdClass();
    $title->title_in = 'Media Center ';
    $title->title_en = 'Media Center ';

    $footer = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    $hub = DB::table('cms_hubinvest')
    ->first();

    $serv = DB::table('cms_servicelist')
    ->orderBy('name', 'ASC')
    ->get();


    $tata = DB::table('cms_goverment')
    ->first();
    $menuTop = DB::table('cms_pages')
    ->leftJoin('cms_position', 'cms_position.position_id', '=', 'cms_pages.position')
    ->where('cms_pages.rowstate', 1)
    ->where('cms_pages.position', 2)
    ->orderBy('cms_pages.id', 'ASC')
    ->get();

    $menuMiddle = DB::table('cms_pages')
    ->leftJoin('cms_position', 'cms_position.position_id', '=', 'cms_pages.position')
    ->where('cms_pages.rowstate', 1)
    ->where('cms_pages.position', 1)
    ->orderBy('cms_pages.id', 'ASC')
    ->get();

    $setting = DB::table('cms_setting')
    ->where('id', 1)
    ->first();


    $post = DB::table('cms_article')
    ->select('cms_article.*', 'cms_categories.name_in', 'cms_categories.name_en')
    ->leftJoin('cms_categories', 'cms_categories.id', '=', 'cms_article.categories_id')
    // ->leftJoin('cms_categories', 'cms_categories.id', '=', 'cms_article.categories_id')
    ->where('cms_article.article_id', $id)
    ->first();

    // ->where('cms_article.rowstate', 1)
    // ->orderBy('article_id', 'DESC')
    // ->get();

    $otherPost = DB::table('cms_article')
    ->where('article_id', '!=', $id)
    ->get();

    $title_sub = true;

      $footerTrain = DB::table('cms_training')
      ->where('rowstate', 1)
      ->orderBy('id', 'ASC')
      ->get();

      return view('pages.compro.mediaCenterOne')->with('servs', $serv)->with('post', $post)->with('setting', $setting)->with('footerTrain', $footerTrain)->with('hub', $hub)->with('menuTop', $menuTop)->with('menuMiddle', $menuMiddle)->with('footer', $footer)->with('title', $title)->with('otherPost', $otherPost)->with('title_sub',$title_sub);
  }

  public function hal($id,$url){
    $title = new \stdClass();
    $title->title_in = 'Halaman';
    $title->title_en = 'Page';

    $footer = DB::table('cms_contact')
    ->where('id', 1)
    ->first();


    $serv = DB::table('cms_servicelist')
    ->orderBy('name', 'ASC')
    ->get();

    $hub = DB::table('cms_hubinvest')
    ->first();

    $tata = DB::table('cms_goverment')
    ->first();

    $menuTop = DB::table('cms_pages')
    ->leftJoin('cms_position', 'cms_position.position_id', '=', 'cms_pages.position')
    ->where('cms_pages.rowstate', 1)
    ->where('cms_pages.position', 2)
    ->orderBy('cms_pages.id', 'ASC')
    ->get();

    $menuMiddle = DB::table('cms_pages')
    ->leftJoin('cms_position', 'cms_position.position_id', '=', 'cms_pages.position')
    ->where('cms_pages.rowstate', 1)
    ->where('cms_pages.position', 1)
    ->orderBy('cms_pages.id', 'ASC')
    ->get();
    $setting = DB::table('cms_setting')
    ->where('id', 1)
    ->first();


    $post = DB::table('cms_pages')
    // ->leftJoin('cms_categories', 'cms_categories.id', '=', 'cms_article.categories_id')
    ->where('id', $id)
    ->first();

    // return view('pages.cms_compro.artikel.edit')->with('post', $post)->with('cat', $cat);

      // echo "<pre>";
      // print_r($post);
      // echo "</pre>";

      // die();

      return view('pages.compro.halaman')->with('servs', $serv)->with('post', $post)->with('setting', $setting)->with('tata', $tata)->with('hub', $hub)->with('menuTop', $menuTop)->with('menuMiddle', $menuMiddle)->with('footer', $footer)->with('title', $title);
  }

  public function careerFinded(Request $request){

    $this->validate($request, [
      'search'             => 'required'
    ]);

    $title = new \stdClass();
    $title->title_in = 'Karir - Result = '.$request->search;
    $title->title_en = 'Career - Hasil = '.$request->search;

    $string = $request->search;

    $serv = DB::table('cms_servicelist')
    ->orderBy('name', 'ASC')
    ->get();


    $footer = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    $setting = DB::table('cms_setting')
    ->where('id', 1)
    ->first();

    $produk = DB::table('cms_career')
    // ->orderBy('date_start', 'ASC')
    ->where('jobdesk_en', 'like', '%'.$string.'%')
    // ->orWhere('jobdesk_en',  'like', '%'.$string.'%')
    ->orderBy('created_at', 'DESC')
    ->where('rowstate',1)
    ->paginate(10);
    // ->get();

    $allProduk = DB::table('cms_career')
    ->where('jobdesk_en', 'like', '%'.$string.'%')
    // ->orWhere('jobdesk_en',  'like', '%'.$string.'%')
    ->orderBy('created_at', 'DESC')
    ->where('rowstate', 1)
    ->get();

    return view('pages.compro.careerFinded')->with('servs', $serv)->with('produk', $produk)->with('setting', $setting)->with('footer', $footer)->with('title', $title)->with('allProduk',$allProduk)->with('finded',$string);
  }

  public function career(){

    $title = new \stdClass();
    $title->title_in = 'Karir';
    $title->title_en = 'Career';

    $footer = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    $tata = DB::table('cms_goverment')
    ->first();


    $serv = DB::table('cms_servicelist')
    ->orderBy('name', 'ASC')
    ->get();

    $menuTop = DB::table('cms_pages')
    ->leftJoin('cms_position', 'cms_position.position_id', '=', 'cms_pages.position')
    ->where('cms_pages.rowstate', 1)
    ->where('cms_pages.position', 2)
    ->orderBy('cms_pages.id', 'ASC')
    ->get();

    $menuMiddle = DB::table('cms_pages')
    ->leftJoin('cms_position', 'cms_position.position_id', '=', 'cms_pages.position')
    ->where('cms_pages.rowstate', 1)
    ->where('cms_pages.position', 1)
    ->orderBy('cms_pages.id', 'ASC')
    ->get();
    $setting = DB::table('cms_setting')
    ->where('id', 1)
    ->first();


    $produk = DB::table('cms_career')
    ->where('rowstate', 1)
    // ->orderBy('date_start', 'ASC')
    ->paginate(10);


    $allProduk = DB::table('cms_career')
    ->where('rowstate', 1)
    // ->orderBy('date_start', 'ASC')
    ->get();



    $imgTop = DB::table('cms_img_top')
    ->where('id', 1)
    ->first();


    $footerTrain = DB::table('cms_training')
    ->where('rowstate', 1)
    ->orderBy('id', 'ASC')
    ->get();

    $text = DB::table('new_cms_career_text')
        ->first();

      // echo "<pre>";
      // print_r($produk);
      // echo "</pre>";   x

      // die();
      // return view('pages.cms_compro.produk.index')->with('posts', $post);
    return view('pages.compro.career')->with('servs', $serv)->with('produk', $produk)->with('setting', $setting)->with('tata', $tata)->with('footerTrain', $footerTrain)->with('menuTop', $menuTop)->with('menuMiddle', $menuMiddle)->with('footer', $footer)->with('title', $title)->with('imgTop', $imgTop)->with('allProduk',$allProduk)->with('text', $text);
      // return view('pages.compro.karir');
  }

  public function careerMeet(){

    $title = new \stdClass();
    $title->title_in = 'Karir - Bertemu dengan Kami';
    $title->title_en = 'Career - Meet Our People';

    $footer = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    $tata = DB::table('cms_goverment')
    ->first();


    $serv = DB::table('cms_servicelist')
    ->orderBy('name', 'ASC')
    ->get();

    $menuTop = DB::table('cms_pages')
    ->leftJoin('cms_position', 'cms_position.position_id', '=', 'cms_pages.position')
    ->where('cms_pages.rowstate', 1)
    ->where('cms_pages.position', 2)
    ->orderBy('cms_pages.id', 'ASC')
    ->get();

    $menuMiddle = DB::table('cms_pages')
    ->leftJoin('cms_position', 'cms_position.position_id', '=', 'cms_pages.position')
    ->where('cms_pages.rowstate', 1)
    ->where('cms_pages.position', 1)
    ->orderBy('cms_pages.id', 'ASC')
    ->get();
    $setting = DB::table('cms_setting')
    ->where('id', 1)
    ->first();


    $produk = DB::table('cms_career')
    ->where('rowstate', 1)
    // ->orderBy('date_start', 'ASC')
    ->paginate(10);


    $allProduk = DB::table('cms_career')
    ->where('rowstate', 1)
    // ->orderBy('date_start', 'ASC')
    ->get();



    $imgTop = DB::table('cms_img_top')
    ->where('id', 1)
    ->first();


    $footerTrain = DB::table('cms_training')
    ->where('rowstate', 1)
    ->orderBy('id', 'ASC')
    ->get();

    $text = DB::table('new_cms_career_text')
        ->first();

      // echo "<pre>";
      // print_r($produk);
      // echo "</pre>";   x

      // die();
      // return view('pages.cms_compro.produk.index')->with('posts', $post);
    return view('pages.compro.career_meet')->with('servs', $serv)->with('produk', $produk)->with('setting', $setting)->with('tata', $tata)->with('footerTrain', $footerTrain)->with('menuTop', $menuTop)->with('menuMiddle', $menuMiddle)->with('footer', $footer)->with('title', $title)->with('imgTop', $imgTop)->with('allProduk',$allProduk)->with('text', $text);
      // return view('pages.compro.karir');
  }

  public function careerFaq(){

    $title = new \stdClass();
    $title->title_in = 'Karir - Pertanyaan yang sering Diajukan';
    $title->title_en = 'Career - Frequently Asked Questions';

    $footer = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    $tata = DB::table('cms_goverment')
    ->first();


    $serv = DB::table('cms_servicelist')
    ->orderBy('name', 'ASC')
    ->get();

    $menuTop = DB::table('cms_pages')
    ->leftJoin('cms_position', 'cms_position.position_id', '=', 'cms_pages.position')
    ->where('cms_pages.rowstate', 1)
    ->where('cms_pages.position', 2)
    ->orderBy('cms_pages.id', 'ASC')
    ->get();

    $menuMiddle = DB::table('cms_pages')
    ->leftJoin('cms_position', 'cms_position.position_id', '=', 'cms_pages.position')
    ->where('cms_pages.rowstate', 1)
    ->where('cms_pages.position', 1)
    ->orderBy('cms_pages.id', 'ASC')
    ->get();
    $setting = DB::table('cms_setting')
    ->where('id', 1)
    ->first();


    $produk = DB::table('cms_career')
    ->where('rowstate', 1)
    // ->orderBy('date_start', 'ASC')
    ->paginate(10);


    $allProduk = DB::table('cms_career')
    ->where('rowstate', 1)
    // ->orderBy('date_start', 'ASC')
    ->get();



    $imgTop = DB::table('cms_img_top')
    ->where('id', 1)
    ->first();


    $footerTrain = DB::table('cms_training')
    ->where('rowstate', 1)
    ->orderBy('id', 'ASC')
    ->get();

    $text = DB::table('new_cms_career_text')
        ->first();

      // echo "<pre>";
      // print_r($produk);
      // echo "</pre>";   x

      // die();
      // return view('pages.cms_compro.produk.index')->with('posts', $post);
    return view('pages.compro.career_faq')->with('servs', $serv)->with('produk', $produk)->with('setting', $setting)->with('tata', $tata)->with('footerTrain', $footerTrain)->with('menuTop', $menuTop)->with('menuMiddle', $menuMiddle)->with('footer', $footer)->with('title', $title)->with('imgTop', $imgTop)->with('allProduk',$allProduk)->with('text', $text);
      // return view('pages.compro.karir');
  }

  public function karirOne($position, $id){
    // public function karirOne($id){
    $title = new \stdClass();
    $title->title_in = 'Karir';
    $title->title_en = 'Career';

    $footer = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    $serv = DB::table('cms_servicelist')
    ->orderBy('name', 'ASC')
    ->get();


    $tata = DB::table('cms_goverment')
    ->first();

    $produk = DB::table('cms_career')
    ->where('rowstate', 1)
    ->where('id', $id)
    // ->orderBy('date_start', 'ASC')
    ->first();

    $setting = DB::table('cms_setting')
    ->where('id', 1)
    ->first();

    $pickOne = DB::table('cms_training')
    ->where('rowstate', 1)
    ->orderBy('id', 'ASC')
    ->first();

    $footerTrain = DB::table('cms_training')
    ->where('rowstate', 1)
    ->orderBy('id', 'ASC')
    ->get();

    return view('pages.compro.karirSingle')->with('servs', $serv)->with('produk', $produk)->with('setting', $setting)->with('footer', $footer)->with('title', $title)->with('footerTrain', $footerTrain)->with('pickOne', $pickOne);
  }


  public function reandaInternational() {

    $title = new \stdClass();
    $title->title_in = 'Reanda International';
    $title->title_en = 'Reanda International';

    $footer = DB::table('cms_contact')
    ->where('id', 1)
    ->first();


    $serv = DB::table('cms_servicelist')
    ->orderBy('name', 'ASC')
    ->get();

    $setting = DB::table('cms_setting')
    ->where('id', 1)
    ->first();

    $produk = DB::table('cms_contact')
    ->where('id', 1)
    ->first();


    //pages.compro.newReandaInternational
    return view('pages.compro.reandainternasional')->with('servs', $serv)->with('produk', $produk)->with('setting', $setting)->with('footer', $footer)->with('title', $title);


    /*$title = new \stdClass();
    $title->title_in = 'Reanda International';
    $title->title_en = 'Reanda International';

    $footer = DB::table('cms_contact')
    ->where('id', 1)
    ->first();


    $serv = DB::table('cms_servicelist')
    ->orderBy('name', 'ASC')
    ->get();

    $setting = DB::table('cms_setting')
    ->where('id', 1)
    ->first();

    $produk = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    $dir = DB::table('cms_directory')
    ->orderBy('directory_id', 'ASC')
    ->get();
    $country = DB::table('cms_country')
    ->orderBy('country_id', 'ASC')
    ->get();
    $gdir = DB::table('cms_global_directory')
    ->get();

    return view('pages.compro.newReandaInternational')->with('files',$gdir)->with('country', $country)->with('dirs', $dir)->with('servs', $serv)->with('produk', $produk)->with('setting', $setting)->with('footer', $footer)->with('title', $title);
  */

    }

  public function charimanmessage(){
    $title = new \stdClass();
    $title->title_in = 'Chariman Message';
    $title->title_en = 'Chariman Message';

    $footer = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    $serv = DB::table('cms_servicelist')
    ->orderBy('name', 'ASC')
    ->get();


    $setting = DB::table('cms_setting')
    ->where('id', 1)
    ->first();

    $produk = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    return view('pages.compro.charimanmessage')->with('servs', $serv)->with('produk', $produk)->with('setting', $setting)->with('footer', $footer)->with('title', $title);
  }

  public function TL(){
    $title = new \stdClass();
    $title->title_in = 'Thought Leaders';
    $title->title_en = 'Thought Leaders';

    $footer = DB::table('cms_contact')
    ->where('id', 1)
    ->first();


    $serv = DB::table('cms_servicelist')
    ->orderBy('name', 'ASC')
    ->get();

    $hub = DB::table('cms_hubinvest')
    ->first();

    $tata = DB::table('cms_goverment')
    ->first();

    $menuTop = DB::table('cms_pages')
    ->leftJoin('cms_position', 'cms_position.position_id', '=', 'cms_pages.position')
    ->where('cms_pages.rowstate', 1)
    ->where('cms_pages.position', 2)
    ->orderBy('cms_pages.id', 'ASC')
    ->get();

    $menuMiddle = DB::table('cms_pages')
    ->leftJoin('cms_position', 'cms_position.position_id', '=', 'cms_pages.position')
    ->where('cms_pages.rowstate', 1)
    ->where('cms_pages.position', 1)
    ->orderBy('cms_pages.id', 'ASC')
    ->get();

    $setting = DB::table('cms_setting')
    ->where('id', 1)
    ->first();

    $produk = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    $leaders = DB::table('cms_leaders')
    ->orderBy('urutan', 'ASC')
    ->get();

    return view('pages.compro.TLNew')->with('servs', $serv)->with('leaders', $leaders)->with('produk', $produk)->with('setting', $setting)->with('tata', $tata)->with('hub', $hub)->with('menuTop', $menuTop)->with('menuMiddle', $menuMiddle)->with('footer', $footer)->with('title', $title);
  }

  public function ocv(){
    $title = new \stdClass();
    $title->title_in = 'Our Core Values';
    $title->title_en = 'Our Core Values';

    $footer = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    $serv = DB::table('cms_servicelist')
    ->orderBy('name', 'ASC')
    ->get();


    $hub = DB::table('cms_hubinvest')
    ->first();

    $tata = DB::table('cms_goverment')
    ->first();

    $menuTop = DB::table('cms_pages')
    ->leftJoin('cms_position', 'cms_position.position_id', '=', 'cms_pages.position')
    ->where('cms_pages.rowstate', 1)
    ->where('cms_pages.position', 2)
    ->orderBy('cms_pages.id', 'ASC')
    ->get();

    $menuMiddle = DB::table('cms_pages')
    ->leftJoin('cms_position', 'cms_position.position_id', '=', 'cms_pages.position')
    ->where('cms_pages.rowstate', 1)
    ->where('cms_pages.position', 1)
    ->orderBy('cms_pages.id', 'ASC')
    ->get();

    $setting = DB::table('cms_setting')
    ->where('id', 1)
    ->first();

    $produk = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    return view('pages.compro.ocv')->with('servs', $serv)->with('produk', $produk)->with('setting', $setting)->with('tata', $tata)->with('hub', $hub)->with('menuTop', $menuTop)->with('menuMiddle', $menuMiddle)->with('footer', $footer)->with('title', $title);
  }



  public function TLOne($id){
    $title = new \stdClass();

    $leader = DB::table('cms_leaders')
    ->where('leader_id', $id)
    ->first();

    $serv = DB::table('cms_servicelist')
    ->orderBy('name', 'ASC')
    ->get();


    $title->title_in = 'Thought Leaders - '.$leader->nama;
    $title->title_en = 'Thought Leaders - '.$leader->nama;

    $footer = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    $hub = DB::table('cms_hubinvest')
    ->first();

    $tata = DB::table('cms_goverment')
    ->first();

    $menuTop = DB::table('cms_pages')
    ->leftJoin('cms_position', 'cms_position.position_id', '=', 'cms_pages.position')
    ->where('cms_pages.rowstate', 1)
    ->where('cms_pages.position', 2)
    ->orderBy('cms_pages.id', 'ASC')
    ->get();

    $menuMiddle = DB::table('cms_pages')
    ->leftJoin('cms_position', 'cms_position.position_id', '=', 'cms_pages.position')
    ->where('cms_pages.rowstate', 1)
    ->where('cms_pages.position', 1)
    ->orderBy('cms_pages.id', 'ASC')
    ->get();

    $setting = DB::table('cms_setting')
    ->where('id', 1)
    ->first();

    $produk = DB::table('cms_contact')
    ->where('id', 1)
    ->first();


    return view('pages.compro.TLOneNew')->with('servs', $serv)->with('leader', $leader)->with('produk', $produk)->with('setting', $setting)->with('tata', $tata)->with('hub', $hub)->with('menuTop', $menuTop)->with('menuMiddle', $menuMiddle)->with('footer', $footer)->with('title', $title);
  }


  public function servLists(){
    $title = new \stdClass();
    $title->title_in = 'Services';
    $title->title_en = 'Services';


    $serv = DB::table('cms_servicelist')
    ->orderBy('name', 'ASC')
    ->get();

    $footer = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    $setting = DB::table('cms_setting')
    ->where('id', 1)
    ->first();

    $services = DB::table('cms_servicelist')
        ->orderBy('name', 'ASC')
        ->get();

    $size = count($services);
    $med = $this->median($size);
    return view('pages.compro.servicesLists')->with('servs', $serv)->with('size',$size)->with('med',$med)->with('services', $services)->with('setting', $setting)->with('footer', $footer)->with('title', $title);

  }

  public function serviceListId($id){
    $title = new \stdClass();
    $title->title_in = 'Services';
    $title->title_en = 'Services';


    $serv = DB::table('cms_servicelist')
    ->orderBy('name', 'ASC')
    ->get();

    $footer = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    $setting = DB::table('cms_setting')
    ->where('id', 1)
    ->first();

    $service = DB::table('cms_servicelist')
    // ->where('service_id', $id)
    ->where('slug', $id)
    ->first();

    if(!$service) return redirect()->back();

    $subService = DB::table('cms_sub_services')
    // ->where('service_id', $id)
    ->where('service_id', @$service->service_id ?? null)
    ->get();

    $count = count($subService);

    $contact = DB::table('cms_service_contact')
    ->where('contact_id', $service->contact_person)
    ->first();

    $contact1 = DB::table('cms_service_contact')
    ->where('contact_id', $service->contact_person1)
    ->first();

    $attachment = DB::table('cms_page_attachments')
    ->where('model', 'services-list')
    ->where('model_id', $service->service_id)
    ->get();

    return view('pages.compro.servicesListId')->with('servs', $serv)->with('count', $count)->with('contact1', $contact1)->with('contact', $contact)->with('subService', $subService)->with('service', $service)->with('setting', $setting)->with('footer', $footer)->with('title', $title)->with('attachment', $attachment);

  }


  public function serviceSub($id){
    $title = new \stdClass();
    $title->title_in = 'Services';
    $title->title_en = 'Services';


    $serv = DB::table('cms_servicelist')
    ->orderBy('name', 'ASC')
    ->get();

    $footer = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    $setting = DB::table('cms_setting')
    ->where('id', 1)
    ->first();

    $subService = DB::table('cms_sub_services')
    // ->where('sub_services_id', $id)
    ->where('slug', $id)
    ->first();

    if(!$subService) return redirect()->back();

    $contact_one = DB::table('cms_service_contact')
    ->where('contact_id', $subService->contact_one)
    ->first();

    $contact_two = DB::table('cms_service_contact')
    ->where('contact_id', $subService->contact_two)
    ->first();

    $partner = DB::table('cms_services_partner')
    ->where('sub_service_id', $subService->sub_services_id)
    ->get();

    $attachment = DB::table('cms_page_attachments')
    ->where('model', 'services-sub')
    ->where('model_id', $subService->sub_services_id)
    ->get();

    return view('pages.compro.subService')->with('servs', $serv)->with('partner', $partner)->with('contact_two', $contact_two)->with('contact_one', $contact_one)->with('subService', $subService)->with('setting', $setting)->with('footer', $footer)->with('title', $title)->with('attachment', $attachment);

  }

  public function median($size){
    if($size%2==0){
      return $size/2;
    }else{
      return ($size+1)/2;
    }
  }



  public function serviceContact($id, $sername){

    $title = new \stdClass();
    $title->title_in = 'Kontak Kami';
    $title->title_en = 'Contact Us';

    $footer = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    $setting = DB::table('cms_setting')
    ->where('id', 1)
    ->first();

    $produk = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    $serv = DB::table('cms_servicelist')
    ->orderBy('name', 'ASC')
    ->get();

    $post = DB::table('cms_service_contact')
    ->where('contact_id', $id)
    ->first();

    return view('pages.compro.contactServ')->with('sername', $sername)->with('post', $post)->with('servs', $serv)->with('produk', $produk)->with('setting', $setting)->with('footer', $footer)->with('title', $title);
  }

  public function sendMailOnContactServ(Request $request){

    //   echo "<pre>";
    //   print_r($_POST);
    //   echo "</pre>";

    //dd($request->all());
    $this->validate($request, [
        'enquiry'             => 'required',
        'title'           => 'required',
        'fname'           => 'required',
        'lname'           => 'required',
        'company'           => 'required',
        'email'             => 'required|email',
        'phone'           => 'required',
        'mes'           => 'required',
    ]);

    $sendTo = $request->cmail;

    $data = array(
        'enquiry'        => $request->enquiry,
        'title'         => $request->title,
        'fname'         => $request->fname,
        'lname'         => $request->lname,
        'company'         => $request->company,
        'email'         => $request->email,
        'phone'         => $request->phone,
        'mes'        => $request->mes,
        'created_at'      => date('Y-m-d H:i:s')
      );

    $emailto = $sendTo;
    $name = $request->fname.' '.$request->lname;

   // dd($data);

    Mail::send('emails.mesOnContact', $data, function ($message) use($emailto, $name, $sendTo) {
        $message->from('info@reandabernardi.com', 'Info');
        $message->to($emailto)->subject('Some Message, from '.$name.' | To '.$sendTo);
    });

    Session::flash('success', 'Message was successfully delivered.');
    // return redirect()->route('compro.contact');
    return redirect()->back();
  }


  public function servAuditAss(){
    $title = new \stdClass();
    $title->title_in = 'Audit & Assurance';
    $title->title_en = 'Audit & Assurance';

    $footer = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    $setting = DB::table('cms_setting')
    ->where('id', 1)
    ->first();

    $produk = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    return view('pages.compro.servAuditAss')->with('produk', $produk)->with('setting', $setting)->with('footer', $footer)->with('title', $title);
  }

  public function servAuditAss_review(){
    $title = new \stdClass();
    $title->title_in = 'Audit & Assurance - Financial Accounting Audit & Reviews';
    $title->title_en = 'Audit & Assurance - Financial Accounting Audit & Reviews';

    $footer = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    $setting = DB::table('cms_setting')
    ->where('id', 1)
    ->first();

    $produk = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    return view('pages.compro.servAuditAss_review')->with('produk', $produk)->with('setting', $setting)->with('footer', $footer)->with('title', $title);
  }

  public function servAuditAss_advisory(){
    $title = new \stdClass();
    $title->title_in = 'Audit & Assurance - Financial accounting advisory';
    $title->title_en = 'Audit & Assurance - Financial accounting advisory';

    $footer = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    $setting = DB::table('cms_setting')
    ->where('id', 1)
    ->first();

    $produk = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    return view('pages.compro.servAuditAss_advisory')->with('produk', $produk)->with('setting', $setting)->with('footer', $footer)->with('title', $title);
  }

  public function servAuditAss_outsourcing(){
    $title = new \stdClass();
    $title->title_in = 'Audit & Assurance - Accounts Outsourcing';
    $title->title_en = 'Audit & Assurance - Accounts Outsourcing';

    $footer = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    $setting = DB::table('cms_setting')
    ->where('id', 1)
    ->first();

    $produk = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    return view('pages.compro.servAuditAss_outsourcing')->with('produk', $produk)->with('setting', $setting)->with('footer', $footer)->with('title', $title);
  }


  public function servAccount(){
    $title = new \stdClass();
    $title->title_in = 'Accounting Advisory Services';
    $title->title_en = 'Accounting Advisory Services';

    $footer = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    $setting = DB::table('cms_setting')
    ->where('id', 1)
    ->first();

    $produk = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    return view('pages.compro.servAccount')->with('produk', $produk)->with('setting', $setting)->with('footer', $footer)->with('title', $title);
  }

  public function servCapital(){
    $title = new \stdClass();
    $title->title_in = 'Capital Market Services';
    $title->title_en = 'Capital Market Services';

    $footer = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    $setting = DB::table('cms_setting')
    ->where('id', 1)
    ->first();

    $produk = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    return view('pages.compro.servCapital')->with('produk', $produk)->with('setting', $setting)->with('footer', $footer)->with('title', $title);
  }

  public function servChina(){
    $title = new \stdClass();
    $title->title_in = 'China Business Desk';
    $title->title_en = 'China Business Desk';

    $footer = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    $setting = DB::table('cms_setting')
    ->where('id', 1)
    ->first();

    $produk = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    return view('pages.compro.servChina')->with('produk', $produk)->with('setting', $setting)->with('footer', $footer)->with('title', $title);
  }

  public function servConsul(){
    $title = new \stdClass();
    $title->title_in = 'Consulting';
    $title->title_en = 'Consulting';

    $footer = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    $setting = DB::table('cms_setting')
    ->where('id', 1)
    ->first();

    $produk = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    return view('pages.compro.servConsul')->with('produk', $produk)->with('setting', $setting)->with('footer', $footer)->with('title', $title);
  }

  public function servConsul_change(){
    $title = new \stdClass();
    $title->title_in = 'Consulting - Change Management';
    $title->title_en = 'Consulting - Change Management';

    $footer = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    $setting = DB::table('cms_setting')
    ->where('id', 1)
    ->first();

    $produk = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    return view('pages.compro.servConsul_change')->with('produk', $produk)->with('setting', $setting)->with('footer', $footer)->with('title', $title);
  }

  public function servConsul_performance(){
    $title = new \stdClass();
    $title->title_in = 'Consulting - Performance Improvement';
    $title->title_en = 'Consulting - Performance Improvement';

    $footer = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    $setting = DB::table('cms_setting')
    ->where('id', 1)
    ->first();

    $produk = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    return view('pages.compro.servConsul_performance')->with('produk', $produk)->with('setting', $setting)->with('footer', $footer)->with('title', $title);
  }

  public function servConsul_enter(){
    $title = new \stdClass();
    $title->title_in = 'Consulting - Enterprise Risk Management';
    $title->title_en = 'Consulting - Enterprise Risk Management';

    $footer = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    $setting = DB::table('cms_setting')
    ->where('id', 1)
    ->first();

    $produk = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    return view('pages.compro.servConsul_enter')->with('produk', $produk)->with('setting', $setting)->with('footer', $footer)->with('title', $title);
  }

  public function servEntrep(){
    $title = new \stdClass();
    $title->title_in = 'Entrepreneurial Services';
    $title->title_en = 'Entrepreneurial Services';

    $footer = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    $setting = DB::table('cms_setting')
    ->where('id', 1)
    ->first();

    $produk = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    return view('pages.compro.servEntrep')->with('produk', $produk)->with('setting', $setting)->with('footer', $footer)->with('title', $title);
  }

  public function servFraud(){
    $title = new \stdClass();
    $title->title_in = 'Fraud Services ';
    $title->title_en = 'Fraud Services ';

    $footer = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    $setting = DB::table('cms_setting')
    ->where('id', 1)
    ->first();

    $produk = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    return view('pages.compro.servFraud')->with('produk', $produk)->with('setting', $setting)->with('footer', $footer)->with('title', $title);
  }

  public function servJapan(){
    $title = new \stdClass();
    $title->title_in = 'Japan Business Desk ';
    $title->title_en = 'Japan Business Desk';

    $footer = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    $setting = DB::table('cms_setting')
    ->where('id', 1)
    ->first();

    $produk = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    return view('pages.compro.servJapan')->with('produk', $produk)->with('setting', $setting)->with('footer', $footer)->with('title', $title);
  }

  public function servMA(){
    $title = new \stdClass();
    $title->title_in = 'Merge & Acquisitions ';
    $title->title_en = 'Merge & Acquisitions';

    $footer = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    $setting = DB::table('cms_setting')
    ->where('id', 1)
    ->first();

    $produk = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    return view('pages.compro.servMA')->with('produk', $produk)->with('setting', $setting)->with('footer', $footer)->with('title', $title);
  }

  public function servTax(){
    $title = new \stdClass();
    $title->title_in = 'Tax ';
    $title->title_en = 'Tax';

    $footer = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    $setting = DB::table('cms_setting')
    ->where('id', 1)
    ->first();

    $produk = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    return view('pages.compro.servTax')->with('produk', $produk)->with('setting', $setting)->with('footer', $footer)->with('title', $title);
  }

  public function servTecho(){
    $title = new \stdClass();
    $title->title_in = 'Technology and Operations Services ';
    $title->title_en = 'Technology and Operations Services';

    $footer = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    $setting = DB::table('cms_setting')
    ->where('id', 1)
    ->first();

    $produk = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    return view('pages.compro.servTecho')->with('produk', $produk)->with('setting', $setting)->with('footer', $footer)->with('title', $title);
  }

  public function indusGov(){
    $title = new \stdClass();
    $title->title_in = 'Government, Entertainment and Non Profit ';
    $title->title_en = 'Government, Entertainment and Non Profit';

    $footer = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    $setting = DB::table('cms_setting')
    ->where('id', 1)
    ->first();

    $produk = DB::table('cms_contact')
    ->where('id', 1)
    ->first();


    $serv = DB::table('cms_servicelist')
    ->orderBy('name', 'ASC')
    ->get();

    return view('pages.compro.indusGov')->with('servs', $serv)->with('produk', $produk)->with('setting', $setting)->with('footer', $footer)->with('title', $title);
  }


  public function indusFinan(){
    $title = new \stdClass();
    $title->title_in = 'Financial Services';
    $title->title_en = 'Financial Services';

    $footer = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    $setting = DB::table('cms_setting')
    ->where('id', 1)
    ->first();

    $produk = DB::table('cms_contact')
    ->where('id', 1)
    ->first();


    $serv = DB::table('cms_servicelist')
    ->orderBy('name', 'ASC')
    ->get();

    return view('pages.compro.indusFinan')->with('servs', $serv)->with('produk', $produk)->with('setting', $setting)->with('footer', $footer)->with('title', $title);
  }

  public function indusEnergy(){
    $title = new \stdClass();
    $title->title_in = 'Energy, Utilities and Mining';
    $title->title_en = 'Energy, Utilities and Mining';

    $footer = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    $setting = DB::table('cms_setting')
    ->where('id', 1)
    ->first();

    $produk = DB::table('cms_contact')
    ->where('id', 1)
    ->first();


    $serv = DB::table('cms_servicelist')
    ->orderBy('name', 'ASC')
    ->get();

    return view('pages.compro.indusEnergy')->with('servs', $serv)->with('produk', $produk)->with('setting', $setting)->with('footer', $footer)->with('title', $title);
  }

  public function indusCons(){
    $title = new \stdClass();
    $title->title_in = 'Consumer, Industrial Products and Services';
    $title->title_en = 'Consumer, Industrial Products and Services';

    $footer = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    $setting = DB::table('cms_setting')
    ->where('id', 1)
    ->first();

    $produk = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    $serv = DB::table('cms_servicelist')
    ->orderBy('name', 'ASC')
    ->get();


    return view('pages.compro.indusCons')->with('servs', $serv)->with('produk', $produk)->with('setting', $setting)->with('footer', $footer)->with('title', $title);
  }


  public function indusTel(){
    $title = new \stdClass();
    $title->title_in = 'Telecommunications, Media and Technology';
    $title->title_en = 'Telecommunications, Media and Technology';

    $footer = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    $setting = DB::table('cms_setting')
    ->where('id', 1)
    ->first();

    $produk = DB::table('cms_contact')
    ->where('id', 1)
    ->first();


    $serv = DB::table('cms_servicelist')
    ->orderBy('name', 'ASC')
    ->get();

    return view('pages.compro.indusTel')->with('servs', $serv)->with('produk', $produk)->with('setting', $setting)->with('footer', $footer)->with('title', $title);
  }

  public function pubAn(){
    $title = new \stdClass();
    $title->title_in = 'Annual Review';
    $title->title_en = 'Annual Review';

    $footer = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    $setting = DB::table('cms_setting')
    ->where('id', 1)
    ->first();

    $produk = DB::table('cms_puban')
    ->orderBy('id', 'DESC')
    ->get();


    $serv = DB::table('cms_servicelist')
    ->orderBy('name', 'ASC')
    ->get();

    return view('pages.compro.pubAn')->with('servs', $serv)->with('produk', $produk)->with('setting', $setting)->with('footer', $footer)->with('title', $title);
  }

  public function pubCon(){
    $title = new \stdClass();
    $title->title_in = 'Country Report';
    $title->title_en = 'Country Report';

    $footer = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    $setting = DB::table('cms_setting')
    ->where('id', 1)
    ->first();

    $produk = DB::table('cms_pubcon')
    ->orderBy('id', 'DESC')
    ->get();


    $serv = DB::table('cms_servicelist')
    ->orderBy('name', 'ASC')
    ->get();

    return view('pages.compro.pubCon')->with('servs', $serv)->with('produk', $produk)->with('setting', $setting)->with('footer', $footer)->with('title', $title);
  }

  public function pubDB(){
    $title = new \stdClass();
    $title->title_in = 'Doing Business Guide';
    $title->title_en = 'Doing Business Guide';

    $footer = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    $setting = DB::table('cms_setting')
    ->where('id', 1)
    ->first();

    $produk = DB::table('cms_pubdb')
    ->orderBy('id', 'DESC')
    ->get();


    $serv = DB::table('cms_servicelist')
    ->orderBy('name', 'ASC')
    ->get();

    return view('pages.compro.pubDB')->with('servs', $serv)->with('produk', $produk)->with('setting', $setting)->with('footer', $footer)->with('title', $title);
  }

  public function pubPrim(){
    $title = new \stdClass();
    $title->title_in = 'PRISM Newsletter';
    $title->title_en = 'PRISM Newsletter';

    $footer = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    $setting = DB::table('cms_setting')
    ->where('id', 1)
    ->first();

    $produk = DB::table('cms_pubprims')
    ->orderBy('id', 'DESC')
    ->get();


    $serv = DB::table('cms_servicelist')
    ->orderBy('name', 'ASC')
    ->get();

    return view('pages.compro.pubPrim')->with('servs', $serv)->with('produk', $produk)->with('setting', $setting)->with('footer', $footer)->with('title', $title);
  }

  public function pubTax(){
    $title = new \stdClass();
    $title->title_in = 'Tax Year Book';
    $title->title_en = 'Tax Year Book';
    $lang_org = session('language');

    $footer = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    $setting = DB::table('cms_setting')
    ->where('id', 1)
    ->first();

    $produk = DB::table('cms_pubtax')
    ->where('rowstate', 1)
    ->where('title_language', 1)
    ->orderBy('title_language', 'ASC')
    ->get();
    $produk_ch = DB::table('cms_pubtax')
    ->where('rowstate', 1)
    ->where('title_language', 2)
    ->orderBy('title_language', 'ASC')
    ->get();


    $serv = DB::table('cms_servicelist')
    ->orderBy('name', 'ASC')
    ->get();

    return view('pages.compro.pubTax')->with('servs', $serv)->with('produk', $produk)->with('produk_ch', $produk_ch)->with('setting', $setting)->with('footer', $footer)->with('title', $title);
  }

  public function publications(){
    $title = new \stdClass();
    $title->title_in = 'Publications';
    $title->title_en = 'Publications';

    $footer = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    $setting = DB::table('cms_setting')
    ->where('id', 1)
    ->first();

    $produk = DB::table('cms_contact')
    ->where('id', 1)
    ->first();


    $serv = DB::table('cms_servicelist')
    ->orderBy('name', 'ASC')
    ->get();

    return view('pages.compro.publications')->with('servs', $serv)->with('produk', $produk)->with('setting', $setting)->with('footer', $footer)->with('title', $title);
  }

  public function meetOur(){
    $title = new \stdClass();
    $title->title_in = 'Meet Our People';
    $title->title_en = 'Meet Our People';

    $footer = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    $setting = DB::table('cms_setting')
    ->where('id', 1)
    ->first();

    $produk = DB::table('cms_contact')
    ->where('id', 1)
    ->first();


    $serv = DB::table('cms_servicelist')
    ->orderBy('name', 'ASC')
    ->get();

    return view('pages.compro.meetOur')->with('servs', $serv)->with('produk', $produk)->with('setting', $setting)->with('footer', $footer)->with('title', $title);
  }

  public function meetNadya(){
    $title = new \stdClass();
    $title->title_in = 'Meet Our People - Nadya Aurora Pratiwi';
    $title->title_en = 'Meet Our People - Nadya Aurora Pratiwi';

    $footer = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    $setting = DB::table('cms_setting')
    ->where('id', 1)
    ->first();

    $produk = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    $serv = DB::table('cms_servicelist')
    ->orderBy('name', 'ASC')
    ->get();


    return view('pages.compro.meetNadya')->with('servs', $serv)->with('produk', $produk)->with('setting', $setting)->with('footer', $footer)->with('title', $title);
  }

  public function meetStep(){
    $title = new \stdClass();
    $title->title_in = 'Meet Our People - Stephanie Octavia';
    $title->title_en = 'Meet Our People - Stephanie Octavia';

    $footer = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    $setting = DB::table('cms_setting')
    ->where('id', 1)
    ->first();

    $produk = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    $serv = DB::table('cms_servicelist')
    ->orderBy('name', 'ASC')
    ->get();


    return view('pages.compro.meetStep')->with('servs', $serv)->with('produk', $produk)->with('setting', $setting)->with('footer', $footer)->with('title', $title);
  }

  public function meetAdit(){
    $title = new \stdClass();
    $title->title_in = 'Meet Our People - Aditiya Febriansyah';
    $title->title_en = 'Meet Our People - Aditiya Febriansyah';

    $footer = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    $setting = DB::table('cms_setting')
    ->where('id', 1)
    ->first();

    $produk = DB::table('cms_contact')
    ->where('id', 1)
    ->first();


    $serv = DB::table('cms_servicelist')
    ->orderBy('name', 'ASC')
    ->get();

    return view('pages.compro.meetAdit')->with('servs', $serv)->with('produk', $produk)->with('setting', $setting)->with('footer', $footer)->with('title', $title);
  }


  public function contact(){
    $title = new \stdClass();
    $title->title_in = 'Kontak Kami';
    $title->title_en = 'Contact Us';

    $footer = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    $setting = DB::table('cms_setting')
    ->where('id', 1)
    ->first();

    $produk = DB::table('cms_contact')
    ->where('id', 1)
    ->first();


    $serv = DB::table('cms_servicelist')
    ->orderBy('name', 'ASC')
    ->get();

    return view('pages.compro.contact')->with('servs', $serv)->with('produk', $produk)->with('setting', $setting)->with('footer', $footer)->with('title', $title);
  }


  public function sendMailOnContact(Request $request){


    //   echo "<pre>";
    //   print_r($_POST);
    //   echo "</pre>";

    // die();
    // dd($request->all());

    $serv = DB::table('cms_servicelist')
    ->orderBy('name', 'ASC')
    ->get();


    $this->validate($request, [
        'enquiry'             => 'required',
        'title'           => 'required',
        'fname'           => 'required',
        'lname'           => 'required',
        'company'           => 'required',
        'email'             => 'required|email',
        'phone'           => 'required',
        'mes'           => 'required',
    ]);

    $sendTo = 'enquiry@reandabernardi.com';

    $data = array(
        'enquiry'        => $request->enquiry,
        'title'         => $request->title,
        'fname'         => $request->fname,
        'lname'         => $request->lname,
        'company'         => $request->company,
        'email'         => $request->email,
        'phone'         => $request->phone,
        'mes'        => $request->mes,
        'created_at'      => date('Y-m-d H:i:s')
      );

    $emailto = $sendTo;
    $name = $request->fname.' '.$request->lname;

    // dd($data);

    Mail::send('emails.mesOnContact', $data, function ($message) use($emailto, $name) {
        $message->from('no-reply@artdigi.co.id', 'Info');
        $message->to($emailto)->subject('Some Message, from '.$name.' | To Admin Reanda');
    });

    Session::flash('success', 'Message was successfully delivered.');
    return redirect()->route('compro.contact');
  }






  public function sendMail(Request $request){

    $serv = DB::table('cms_servicelist')
    ->orderBy('name', 'ASC')
    ->get();

    $this->validate($request, [
        'name'             => 'required',
        'email'             => 'required|email',
        'phone'           => 'required',
        'message'           => 'required'
    ]);

    $sendTo = 'habib@artdigi.co.id';
    // $sendTo = 'info@artdigi.co.id';

    //   echo "<pre>";
    //   print_r($_POST);
    //   echo "</pre>";
    // die();

    // $post = CmsMessages::create([
    //     'name'          => $request->name,
    //     'email'          => $request->email,
    //     'phone'        => $request->phone,
    //     'message'        => $request->message,
    //     'send_to'     => $sendTo,
    //     'created_at'        => date('Y-m-d H:i:s')
    // ]);

    $data = array(
        'name'        => $request->name,
        'email'         => $request->email,
        'phone'         => $request->phone,
        'messages'        => $request->message,
        'created_at'      => date('Y-m-d H:i:s')
      );

    $emailto = $sendTo;
    $name = $request->fname+" "+$request->lname;

    Mail::send('emails.message', $data, function ($message) use($emailto, $name) {
        $message->from('no-reply@artdigi.co.id', 'Info');
        $message->to($emailto)->subject('Some Message, from '.$name.' | To Admin Artdigi');
    });

    Session::flash('success', 'Message was successfully delivered.');
    return redirect()->route('compro.contact');
  }

  public function trainingNext($id){

    $serv = DB::table('cms_servicelist')
    ->orderBy('name', 'ASC')
    ->get();


    $content = DB::table('cms_training')
    ->where('id', '>', $id)
    ->where('rowstate', 1)
    ->first();

    if($content == []){
      $content = DB::table('cms_training')
      ->where('rowstate', 1)
      ->first();
      $newId = $content->id;

    }else{
      $newId = $content->id;
    }

    return redirect()->route('compro.training', [ 'id' => $newId ] );
  }


  public function trainingPrev($id){


    $serv = DB::table('cms_servicelist')
    ->orderBy('name', 'ASC')
    ->get();

    $content = DB::table('cms_training')
    ->where('id', '<', $id)
    ->orderBy('id', 'DESC')
    ->take(1)
    // ->first();
    ->first();

    if($content == ''){
      $content = DB::table('cms_training')
      ->orderBy('id', 'DESC')
      ->take(1)
      ->where('rowstate', 1)
      ->first();
      $newId = $content->id;
    }else{
      $newId = $content->id;
    }

    return redirect()->route('compro.training', [ 'id' => $newId ] );
  }

  public function training($id){

    $serv = DB::table('cms_servicelist')
    ->orderBy('name', 'ASC')
    ->get();

    $title = new \stdClass();
    $title->title_in = 'Training';
    $title->title_en = 'Training';

    $footerTrain = DB::table('cms_training')
    ->where('rowstate', 1)
    ->orderBy('id', 'ASC')
    ->get();

    $footer = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    $hub = DB::table('cms_hubinvest')
    ->first();

    $tata = DB::table('cms_goverment')
    ->first();

    $menuTop = DB::table('cms_pages')
    ->leftJoin('cms_position', 'cms_position.position_id', '=', 'cms_pages.position')
    ->where('cms_pages.rowstate', 1)
    ->where('cms_pages.position', 2)
    ->orderBy('cms_pages.id', 'ASC')
    ->get();

    $menuMiddle = DB::table('cms_pages')
    ->leftJoin('cms_position', 'cms_position.position_id', '=', 'cms_pages.position')
    ->where('cms_pages.rowstate', 1)
    ->where('cms_pages.position', 1)
    ->orderBy('cms_pages.id', 'ASC')
    ->get();

    $setting = DB::table('cms_setting')
    ->where('id', 1)
    ->first();

    $produk = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    $content = DB::table('cms_training')
    ->where('id', $id)
    ->where('rowstate', 1)
    ->first();

    $schedule = DB::table('cms_training_class')
    ->where('id_training', $id)
    ->where('rowstate', 1)
    ->get();

    $produk = DB::table('cms_training')
    ->where('rowstate', 1)
    ->orderBy('id', 'ASC')
    ->get();


    return view('pages.compro.trainingSingle')->with('servs', $serv)->with('produk', $produk)->with('setting', $setting)->with('tata', $tata)->with('hub', $hub)->with('menuTop', $menuTop)->with('menuMiddle', $menuMiddle)->with('footer', $footer)->with('schedule', $schedule)->with('title', $title)->with('content', $content)->with('footerTrain', $footerTrain);
  }

  // SHOW FORM INPUT REGISTER
  public function registerTrain(){


    $serv = DB::table('cms_servicelist')
    ->orderBy('name', 'ASC')
    ->get();

    $title = new \stdClass();
    $title->title_in = 'Daftar Training';
    $title->title_en = 'Register Training';

    $footerTrain = DB::table('cms_training')
    ->where('rowstate', 1)
    ->orderBy('id', 'ASC')
    ->get();

    $footer = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    $hub = DB::table('cms_hubinvest')
    ->first();

    $tata = DB::table('cms_goverment')
    ->first();

    $menuTop = DB::table('cms_pages')
    ->leftJoin('cms_position', 'cms_position.position_id', '=', 'cms_pages.position')
    ->where('cms_pages.rowstate', 1)
    ->where('cms_pages.position', 2)
    ->orderBy('cms_pages.id', 'ASC')
    ->get();

    $menuMiddle = DB::table('cms_pages')
    ->leftJoin('cms_position', 'cms_position.position_id', '=', 'cms_pages.position')
    ->where('cms_pages.rowstate', 1)
    ->where('cms_pages.position', 1)
    ->orderBy('cms_pages.id', 'ASC')
    ->get();

    $setting = DB::table('cms_setting')
    ->where('id', 1)
    ->first();


    $produk = DB::table('cms_training')
    ->where('rowstate', 1)
    ->orderBy('id', 'ASC')
    ->get();

    $class = DB::table('cms_training_class')
    ->where('rowstate', 1)
    ->orderBy('id', 'ASC')
    ->get();

    $time = DB::table('cms_training_time')
    ->where('rowstate', 1)
    ->orderBy('id', 'ASC')
    ->get();

    if ( Session::get('userLogin') ){
      $findSaved = DB::table('cms_training_regis_saved')
      ->where( 'id_user', Session::get('userLogin')['id'] )
      ->first();
    }else{
      $findSaved = '';
    }

    $content = 'asd';

    // echo '<pre>';
    // print_r($class);
    // echo '</pre>';

    return view('pages.compro.registerTrain')->with('servs', $serv)->with('produk', $produk)->with('setting', $setting)->with('tata', $tata)->with('hub', $hub)->with('menuTop', $menuTop)->with('menuMiddle', $menuMiddle)->with('footer', $footer)->with('title', $title)->with('content', $content)->with('footerTrain', $footerTrain)->with('class', $class)->with('time', $time)->with('findSaved', $findSaved);
  }

  // MAKE SESSION CART & REDIRECT
  public function trainRegis(Request $request){


    $serv = DB::table('cms_servicelist')
    ->orderBy('name', 'ASC')
    ->get();

    function convert_tgl_to_db($tgl){
      //UBAH TANGGAL INPUTAN BIAR BISA MASUK KE DATABASE
      $tgl_1 = substr($tgl, 0,2);
      $tgl_2 = substr($tgl, 3,2);
      $tgl_3 = substr($tgl, 6,4);
      $total = $tgl_3.'-'.$tgl_2.'-'.$tgl_1;
      return $total;
    }

    $this->validate($request, [
      'name'             => 'required',
      'birth'             => 'required',
      'gender'             => 'required',
      'email'             => 'required',
      'phone'             => 'required',
      'ktp'             => 'required',
      'occupation'             => 'required',
      'institution'             => 'required',
      'education'             => 'required',
      'training'             => 'required',
      'idClass'             => 'required',
      'schedule'             => 'required',
    ]);

    if ( Session::get('userLogin') ){
      $findSaved = DB::table('cms_training_regis_saved')
      ->where( 'id_user', Session::get('userLogin')['id'] )
      ->first();

      if($findSaved){
        $white = DB::table('cms_training_regis_saved')->where('id_user', Session::get('userLogin')['id'] )->update([
          'id_user'             => Session::get('userLogin')['id'],
          'name'             => $request->name,
          'birth'             => $request->birth,
          'gender'             => $request->gender,
          'email'             => $request->email,
          'phone'             => $request->phone,
          'ktp'             => $request->ktp,
          'occupation'             => $request->occupation,
          'institution'             => $request->institution,
          'education'             => $request->education,
          'updated_at'        => date('Y-m-d h:i:s')
        ]);

      }else if(!$findSaved){
        $post = DB::table('cms_training_regis_saved')->insert([
          'id_user'             => Session::get('userLogin')['id'],
          'name'             => $request->name,
          'birth'             => $request->birth,
          'gender'             => $request->gender,
          'email'             => $request->email,
          'phone'             => $request->phone,
          'ktp'             => $request->ktp,
          'occupation'             => $request->occupation,
          'institution'             => $request->institution,
          'education'             => $request->education,
          'rowstate'          => 1,
          'created_at'        => date('Y-m-d H:i:s')
        ]);
      }
    }

    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";
    // die();





    $setting = DB::table('cms_setting')
    ->where('id', 1)
    ->first();

    $post = DB::table('cms_training_class')
    ->where('id', $request->idClass)
    ->first();

    $tt = DB::table('cms_training')
    ->where('id', $request->training)
    ->first();

    $tc = DB::table('cms_training_class')
    ->where('id', $request->idClass)
    ->first();

    session()->forget('cart');

    $cart = [
      'name'             => $request->name,
      'birth'             => convert_tgl_to_db($request->birth),
      'gender'             => $request->gender,
      'cost_price'             => $post->price,
      'cost_regis'             => $setting->fee_register,
      'cost_total'             => $post->price + $setting->fee_register,
      'email'             => $request->email,
      'mobile'             => $request->phone,
      'ktp'             => $request->ktp,
      'occupation'             => $request->occupation,
      'institution'             => $request->institution,
      'education'             => $request->education,
      'id_train'             => $request->training,
      'name_train_in'             => $tt->title_in,
      'name_train_en'             => $tt->title_en,
      'id_class'          => $request->idClass,
      'name_class_in'          => $tc->class_name_in,
      'name_class_en'          => $tc->class_name_en,
      'id_schedule'          => $request->schedule,
    ];


    Session::push('cart', $cart);

    // echo "<pre>";
    // print_r(Session::get('cart'));
    // echo "</pre>";
    // die();
    return redirect()->route('compro.regisSummary');
  }

  // SHOW SUMMARY
  public function regisSummary(){

    $serv = DB::table('cms_servicelist')
    ->orderBy('name', 'ASC')
    ->get();

    // die('woii');
    $sum = Session::get('cart')[0];
    // echo "<pre>";
    // print_r($sum);
    // echo "</pre>";
    // die();

    $title = new \stdClass();
    $title->title_in = 'Summary Register';
    $title->title_en = 'Summary Register';

    $footer = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    $schedule = DB::table('cms_training_time')
    ->where('id', $sum['id_schedule'])
    ->get();

    $setting = DB::table('cms_setting')
    ->where('id', 1)
    ->first();

    $footerTrain = DB::table('cms_training')
    ->where('rowstate', 1)
    ->orderBy('id', 'ASC')
    ->get();

    return view('pages.compro.registerTrainSummary')->with('servs', $serv)->with('footerTrain', $footerTrain)->with('setting', $setting)->with('footer', $footer)->with('title', $title)->with('sum', $sum)->with('schedule',$schedule);

  }

  // INPUT TO DB & REDIRECT
  public function regisProcees(){

    $serv = DB::table('cms_servicelist')
    ->orderBy('name', 'ASC')
    ->get();


    if(Session::get('cart')){
      $sum = Session::get('cart')[0];
      $content = DB::table('cms_nova')
      ->orderBy('id', 'ASC')
      ->take(1)
      ->where('email', $sum['email'])
      ->first();

      if( $content ){

      }else{
        $content = DB::table('cms_nova')
        ->orderBy('id', 'ASC')
        ->take(1)
        ->where('email', NULL)
        ->first();
      }

      // echo "<pre>";
      // print_r($sum);
      // print_r($content);
      // echo $content->norek;
      // echo "</pre>";
      // die('woii');

      $dark = DB::table('cms_nova')->where('id', $content->id)->update([
        'email'             => $sum['email'],
        'updated_at'        => date('Y-m-d h:i:s')
      ]);



      $trainTime = DB::table('cms_training_time')
      ->where('id', $sum['id_schedule'])
      ->first();

      $message = "Silahkan kirim transfer";

      $toMail = $sum['email'];

      $transfer = [
        'name'             => $sum['name'],
        'birth'             => $sum['birth'],
        'gender'             => $sum['gender'],
        'cost_price'             => $sum['cost_price'],
        'cost_regis'             => $sum['cost_regis'],
        'cost_total'             => $sum['cost_total'],
        'email'             => $sum['email'],
        'mobile'             => $sum['mobile'],
        'ktp'             => $sum['ktp'],
        'occupation'             => $sum['occupation'],
        'institution'             => $sum['institution'],
        'education'             => $sum['education'],
        'id_train'             => $sum['id_train'],
        'name_train_in'             => $sum['name_train_in'],
        'name_train_en'             => $sum['name_train_en'],
        'id_class'          => $sum['id_class'],
        'name_class_in'          => $sum['name_class_in'],
        'name_class_en'          => $sum['name_class_en'],
        'id_schedule'          => $sum['id_schedule'],
        'schedule'          => $trainTime,
        'id_nova'             => $content->id,
        'norek'             => $content->norek,
        'messages'        => $message
      ];
      // echo "<pre>";
      // print_r($sum);
      // print_r($transfer);
      // echo "</pre>";
      // die('woii');

      $post = CmsTrainRegis::create([
        'name'             => $sum['name'],
        'birth'             => $sum['birth'],
        'gender'             => $sum['gender'],
        'cost_price'             => $sum['cost_price'],
        'cost_regis'             => $sum['cost_regis'],
        'cost_total'             => $sum['cost_total'],
        'norek'             => $content->norek,
        'email'             => $sum['email'],
        'mobile'             => $sum['mobile'],
        'ktp'             => $sum['ktp'],
        'occupation'             => $sum['occupation'],
        'institution'             => $sum['institution'],
        'education'             => $sum['education'],
        'id_train'             => $sum['id_train'],
        'id_class'          => $sum['id_class'],
        'id_schedule'          => $sum['id_schedule'],
        'rowstate'          => 3,
        'created_at'        => date('Y-m-d H:i:s')
      ]);


      //   echo "<pre>";
      //   print_r($content);
      //   echo "</pre>";
      // // die();


      session()->forget('transfer');
      Session::push('transfer', $transfer);
      session()->forget('cart');

      $emailto = $toMail;
      // $emailto = 'habibulumudin@gmail.com';
      $name = $transfer['name'];

      Mail::send('emails.message', $transfer, function ($message) use ($emailto, $name) {
        $message->from('no-reply@polismart.id', 'Info from Recare Registration');
        $message->to($emailto)->subject('Some Message, to '.$name.' | from Admin Recare');
      });

      // $datas = array(
      //   'name'  => 'heeroo',
      //     'created_at'      => date('Y-m-d H:i:s')
      //   );

      // $message = 'isi  pesaan';
      // $name = 'habib';

      // Mail::send('emails.test_mail', $datas, function ($message) use ($emailto, $name) {
      //   $message->from('no-reply@polismart.id', 'Info');
      //   $message->to($emailto)->subject('Some Message, from '.$name.' | To User');
      // });
      return redirect()->route('compro.regisProceedSum');
    }else{
      return redirect()->route('compro.regisProceedSum');

    }

  }

  public function regisProceedSum(){

    $serv = DB::table('cms_servicelist')
    ->orderBy('name', 'ASC')
    ->get();

    // die('woii');
    // echo "<pre>";
    // print_r(session()->get('transfer')[0]);
    // echo "</pre>";
    // die();

    $sum = Session::get('transfer')[0];

    $title = new \stdClass();
    $title->title_in = 'Payment Method';
    $title->title_en = 'Payment Method';

    $footer = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    $schedule = DB::table('cms_training_time')
    ->where('id', $sum['id_schedule'])
    ->get();

    $setting = DB::table('cms_setting')
    ->where('id', 1)
    ->first();

    $footerTrain = DB::table('cms_training')
    ->where('rowstate', 1)
    ->orderBy('id', 'ASC')
    ->get();

    return view('pages.compro.registerProceedSum')->with('servs', $serv)->with('footerTrain', $footerTrain)->with('setting', $setting)->with('footer', $footer)->with('title', $title)->with('sum', $sum)->with('schedule', $schedule);

  }

  public function testMail(){
    $datas = array(
      'name'  => 'heeroo',
        'created_at'      => date('Y-m-d H:i:s')
      );

    $message = 'isi  pesaan';
    $emailto = 'habibulumudin@gmail.com';
    $name = 'habib';


    $serv = DB::table('cms_servicelist')
    ->orderBy('name', 'ASC')
    ->get();

    Mail::send('emails.test_mail', $datas, function ($message) use ($emailto, $name) {
      $message->from('no-reply@polismart.id', 'Info');
      $message->to($emailto)->subject('Some Message, from '.$name.' | To User');
    });
  }

  public function subscribed(Request $request){
    $this->validate($request, [
        'email'             => 'required'
    ]);


    $serv = DB::table('cms_servicelist')
    ->orderBy('name', 'ASC')
    ->get();

    $post = CmsSubscribed::create([
        'email'             => $request->email,
        'rowstate'          => 1,
        'created_at'        => date('Y-m-d H:i:s')
    ]);

    return redirect()->route('compro.home');

  }


  public function pencarian(Request $request){

    $this->validate($request, [
        'cari'             => 'required'
    ]);


    $serv = DB::table('cms_servicelist')
    ->orderBy('name', 'ASC')
    ->get();

    $string = $request->cari;

    $title = new \stdClass();
    $title->title_in = 'Pencarian';
    $title->title_en = 'Searching';

    $footer = DB::table('cms_contact')
    ->where('id', 1)
    ->first();

    $hub = DB::table('cms_hubinvest')
    ->first();

    $tata = DB::table('cms_goverment')
    ->first();

    $menuTop = DB::table('cms_pages')
    ->leftJoin('cms_position', 'cms_position.position_id', '=', 'cms_pages.position')
    ->where('cms_pages.rowstate', 1)
    ->where('cms_pages.position', 2)
    ->orderBy('cms_pages.id', 'ASC')
    ->get();

    $menuMiddle = DB::table('cms_pages')
    ->leftJoin('cms_position', 'cms_position.position_id', '=', 'cms_pages.position')
    ->where('cms_pages.rowstate', 1)
    ->where('cms_pages.position', 1)
    ->orderBy('cms_pages.id', 'ASC')
    ->get();

    $setting = DB::table('cms_setting')
    ->where('id', 1)
    ->first();

    if ( Session::get('langIN') != NULL || Session::get('langEN') == NULL ) {
        $produk = DB::table('cms_article')
        ->where('title_in', 'like', '%'.$string.'%')
        ->orWhere('content_in',  'like', '%'.$string.'%')
        ->orderBy('created_at', 'DESC')
        ->where('rowstate',1)
        ->get();
    }else{
        $produk = DB::table('cms_article')
        ->where('title_en', 'like', '%'.$string.'%')
        ->orWhere('content_en',  'like', '%'.$string.'%')
        ->orderBy('created_at', 'DESC')
        ->where('rowstate',1)
        ->get();
    }

    $serv = DB::table('cms_servicelist')
    ->orderBy('name', 'ASC')
    ->get();


    return view('pages.compro.cari')->with('servs', $serv)->with('produk', $produk)->with('setting', $setting)->with('tata', $tata)->with('hub', $hub)->with('menuTop', $menuTop)->with('menuMiddle', $menuMiddle)->with('footer', $footer)->with('title', $title)->with('cari',$string);
  }

  public function setlang(Request $request) {
    
    $lang = $request['lang'];
    
    App::setlocale($lang);
    session(['language' => $lang]);
    return $lang;
  }
}
