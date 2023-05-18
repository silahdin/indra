<?php

namespace App\Http\Controllers;

use App\Bidding;
use App\Car;
use App\CmsCareer;
use App\Inbox;
use App\Models\TestCareerModule;
use App\Models\TestModule;
use App\Models\TestUserOngoing;
use App\Subscribe;
use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($lang='en')
    {
// die
//         return('halooo');
        // $setting = DB::table('cms_setting')
        // ->where('id', 1)
        // ->first();        
        // return view('home')->with('setting', $setting);

        if(!Auth::check()) return redirect()->route('login');

        // GO TO USER HOME
        $lang_org = session('language');

        if ($lang_org == NULL) {
          App::setlocale($lang);

          session(['language' => $lang]);
        }

        if(Auth::user()->level == 'Admin' || Auth::user()->level == 'Administrator' || Auth::user()->level == 'admin') return redirect()->route('dashboard');

        // GET CAREER
        $career = CmsCareer::join('test_user_careers', 'test_user_careers.career_id', 'cms_career.id')
                    ->where('test_user_careers.user_id', Auth::user()->id)
                    ->whereNull('test_user_careers.deleted_at')
                    ->select('cms_career.*')
                    ->get();

        return $this->view_page('home_reg', ['listjobs' => $career]);
    }

    public function dashboard(){
        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();        
        return view('dashboard')->with('setting', $setting);
    }

    public function home(){

        return view('welcome');

        /*$car = DB::table('cars')
        ->select('cars.id', 'cars.name', 'cars.slug', 'cars.image', 'cars.price', 'cars.tahun', 'dealers.name as dealer', 'merk_mobil.name as merk', 'type_mobil.name as type')
        ->leftJoin('dealers', 'dealers.id', '=', 'cars.dealer_id')
        ->leftJoin('merk_mobil', 'merk_mobil.id', '=', 'cars.merk')
        ->leftJoin('type_mobil', 'type_mobil.id', '=', 'cars.type')
        ->where('st_car', 1)
        ->orderBy('cars.id', 'DESC')
        ->get();*/

        $car = DB::table('push')
        ->select('cars.id', 'cars.transmisi', 'cars.name', 'cars.slug', 'cars.image', 'cars.price', 'cars.tahun', 'dealers.name as dealer', 'dealers.city', 'merk_mobil.name as merk', 'type_mobil.name as type')
        ->leftJoin('cars', 'cars.id', '=', 'push.car_id')
        ->leftJoin('dealers', 'dealers.id', '=', 'cars.dealer_id')
        ->leftJoin('merk_mobil', 'merk_mobil.id', '=', 'cars.merk')
        ->leftJoin('type_mobil', 'type_mobil.id', '=', 'cars.type')
        ->where('push.to_date', '>=', date('Y-m-d'))
        ->where('push.st_push', 1)
        ->orderBy('push.to_date', 'DESC')
        ->get();

        $dealers = DB::table('dealers')
        ->orderBy('name', 'ASC')
        ->get();

        $merk = DB::table('merk_mobil')
        ->orderBy('name', 'ASC')
        ->get();

        $type = DB::table('type_mobil')
        ->orderBy('name', 'ASC')
        ->get();

        $kota = DB::table('kotamadya')
        ->orderBy('name', 'ASC')
        ->get();

        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();        

        return view('pages.front.home.index')->with('cars', $car)->with('dealers', $dealers)->with('merks', $merk)->with('types', $type)->with('kotas', $kota)->with('setting', $setting);
    }

    public function cardetail($id){
        $car = DB::table('cars')
        ->select('cars.id', 'cars.merk as dmerk', 'cars.type as dtype', 'cars.dealer_id', 'cars.name', 'cars.warna', 'cars.kilometer', 'cars.transmisi', 'cars.pajak', 'cars.hits', 'cars.description', 'cars.slug', 'cars.image', 'cars.price', 'cars.tahun', 'dealers.name as dealer', 'dealers.city', 'merk_mobil.name as merk', 'type_mobil.name as type', 'dealers.address', 'dealers.phone', 'dealers.slug as dealerslug', 'dealers.images as imgdealer', 'dealers.id as delaerid', 'dealers.user_id as userid', 'kotamadya.name as kota')
        ->leftJoin('dealers', 'dealers.id', '=', 'cars.dealer_id')
        ->leftJoin('merk_mobil', 'merk_mobil.id', '=', 'cars.merk')
        ->leftJoin('type_mobil', 'type_mobil.id', '=', 'cars.type')
        ->leftJoin('kotamadya', 'kotamadya.kotamadya_id', '=', 'dealers.kotamadya_id')
        ->where('st_car', 1)
        ->where('cars.slug', $id)
        ->first();

        $car_similar = DB::table('cars')
        ->select('cars.id', 'cars.transmisi', 'cars.name', 'cars.description', 'cars.slug', 'cars.image', 'cars.price', 'cars.tahun', 'dealers.name as dealer', 'dealers.city', 'merk_mobil.name as merk', 'type_mobil.name as type', 'dealers.address', 'dealers.phone', 'dealers.images as imgdealer')
        ->leftJoin('dealers', 'dealers.id', '=', 'cars.dealer_id')
        ->leftJoin('merk_mobil', 'merk_mobil.id', '=', 'cars.merk')
        ->leftJoin('type_mobil', 'type_mobil.id', '=', 'cars.type')
        ->where('st_car', 1)
        ->where('cars.merk', $car->dmerk)
        ->where('cars.type', $car->dtype)
        ->where('cars.id', '!=', $car->id)
        ->get();

        $hitsbr = $car->hits + 1;
        DB::table('cars')->where('id', $car->id)->update(['hits' => $hitsbr]);
        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();
        return view('pages.front.car.detail')->with('car', $car)->with('similars', $car_similar)->with('setting', $setting);
    }

    public function tentangkami(){
        $set = DB::table('setting')
        ->select('aboutus')
        ->first();
        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();
        return view('pages.front.home.tentangkami')->with('set', $set)->with('setting', $setting);
    }

    public function hubungikami(){
        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();        
        return view('pages.front.home.hubungikami')->with('setting', $setting);
    }

    public function sendhubungikami(Request $request){

        $bid = Inbox::create([
            't_user_id'         => 1,
            'nama'              => $request->nama,
            'email'             => $request->email,
            'nomer_hp'          => $request->nomer_hp,
            'type'              => 'hubungikami',
            'subject'           => 'Form Hubungi Kami - '.$request->nama,
            'slug_subject'      => 'hubungi-kami-webiste-'.time(),
            'content'           => $request->pesan

        ]);

        Session::flash('success', 'Pesan berhasil terkirim');
        return redirect()->route('hubungi.kami');

    }

    public function homesearch(Request $request){
        $result = DB::table('cars')
        ->select('cars.id', 'cars.name', 'cars.slug', 'cars.image', 'cars.price', 'cars.tahun', 'dealers.name as dealer', 'dealers.city', 'merk_mobil.name as merk', 'type_mobil.name as type')
        //->leftJoin('cars', 'cars.id', '=', 'push.car_id')
        ->leftJoin('dealers', 'dealers.id', '=', 'cars.dealer_id')
        ->leftJoin('merk_mobil', 'merk_mobil.id', '=', 'cars.merk')
        ->leftJoin('type_mobil', 'type_mobil.id', '=', 'cars.type')
        //->where('push.to_date', '>=', date('Y-m-d'))
        //->where('push.st_push', 1)
        ->where('cars.st_car', 1)
        ->where('cars.name', 'like', '%' . $request->q . '%')
        ->OrWhere('merk_mobil.name', 'like', '%' . $request->q . '%')
        ->OrWhere('type_mobil.name', 'like', '%' . $request->q . '%')
        ->get();
        //->where('cars.slug', $id)
        //$result = $car->get();

        $dealers = DB::table('dealers')
        ->orderBy('name', 'ASC')
        ->get();

        $merk = DB::table('merk_mobil')
        ->orderBy('name', 'ASC')
        ->get();

        $type = DB::table('type_mobil')
        ->orderBy('name', 'ASC')
        ->get();

        $kotas = DB::table('kotamadya')
        ->orderBy('name', 'ASC')
        ->get();

        $set = array(
            'merkmobil'         => ucwords(strtolower($request->q)),
            'typemobil'         => '',
            'kotamadyamobil'    => '',
            'ftahun'            => '',
            'ttahun'            => '',
            'trans'             => '',
        );
        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();
        return view('pages.front.car.search')->with('cars', $result)->with('dealers', $dealers)->with('merks', $merk)->with('types', $type)->with('kotas', $kotas)->with($set)->with('setting', $setting);
    }

    public function carsearch(Request $request) {

      $car = DB::table('cars')
      ->select('cars.id', 'cars.name', 'cars.slug', 'cars.image', 'cars.price', 'cars.tahun', 'dealers.name as dealer', 'dealers.city', 'merk_mobil.name as merk', 'type_mobil.name as type')
      //->leftJoin('cars', 'cars.id', '=', 'push.car_id')
      ->leftJoin('dealers', 'dealers.id', '=', 'cars.dealer_id')
      ->leftJoin('merk_mobil', 'merk_mobil.id', '=', 'cars.merk')
      ->leftJoin('type_mobil', 'type_mobil.id', '=', 'cars.type')
      ->where('cars.st_car', 1);
      //->where('push.to_date', '>=', date('Y-m-d'))
      //->where('push.st_push', 1);

      $carpush = DB::table('push')
      ->select('cars.id', 'cars.transmisi', 'cars.name', 'cars.slug', 'cars.image', 'cars.price', 'cars.tahun', 'dealers.name as dealer', 'dealers.city', 'merk_mobil.name as merk', 'type_mobil.name as type')
      ->leftJoin('cars', 'cars.id', '=', 'push.car_id')
      ->leftJoin('dealers', 'dealers.id', '=', 'cars.dealer_id')
      ->leftJoin('merk_mobil', 'merk_mobil.id', '=', 'cars.merk')
      ->leftJoin('type_mobil', 'type_mobil.id', '=', 'cars.type')
      ->where('push.to_date', '>=', date('Y-m-d'))
      ->where('push.st_push', 1)
      ->where('push.possition', 'pencarian');

        if($request->dealer){
            $car->where('dealers.id', $request->dealer);
        }
        if($request->merk){
            $car->where('merk_mobil.id', $request->merk);
            $carpush->where('merk_mobil.id', $request->merk);
        }
        if($request->type){
            $car->where('type_mobil.id', $request->type);
            $carpush->where('type_mobil.id', $request->type);
        }
        if($request->kotamadya){
            $car->where('dealers.kotamadya_id', $request->kotamadya);
        }

        if(($request->price_range) && $request->price_range != "20000000,20000000"){
            $hrg = explode(',', $request->price_range);
            $car->where('cars.price', '>=', $hrg[0]);
            $car->where('cars.price', '<=', $hrg[1]);
        }

        if($request->transmisi){
            $car->where('cars.transmisi', $request->transmisi);
        }

        if($request->from_thn){
            $car->where('cars.tahun', '>=', $request->from_thn);
        }

        if($request->to_thn){
            $car->where('cars.tahun', '<=', $request->to_thn);
        }

        if($request->range_min){
            $car->where('cars.price', '>=', $request->range_min);
        }

        if($request->range_max){
            $car->where('cars.price', '<=', $request->range_max);
        }

        if($request->word){
            $car->where('dealers.name', 'like', '%' . $request->word . '%');
            $car->where('dealers.description', 'like', '%' . $request->word . '%');
        }

        $car->orderBy('cars.id', 'ASC');
        $result = $car->get();

        $carpush->orderBy('push.to_date', 'ASC');
        $resultpush = $carpush->get();

        $dealers = DB::table('dealers')
        ->orderBy('name', 'ASC')
        ->get();

        $merk = DB::table('merk_mobil')
        ->orderBy('name', 'ASC')
        ->get();

        $type = DB::table('type_mobil')
        ->orderBy('name', 'ASC')
        ->get();

        $kotas = DB::table('kotamadya')
        ->orderBy('name', 'ASC')
        ->get();

        //Merk Mobil
        $cmerk = DB::table('merk_mobil')
        ->select('name')
        ->where('merk_mobil.id', $request->merk)
        ->first();
        if($cmerk){ $merkmobil = $cmerk->name; } else { $merkmobil = ""; }

        //Type Mobil
        $ctype = DB::table('type_mobil')
        ->select('name')
        ->where('type_mobil.id', $request->type)
        ->first();
        if($ctype){ $typemobil = $ctype->name; } else { $typemobil = ""; }

        //Lokasi Mobil
        $ckotamadya = DB::table('kotamadya')
        ->select('name')
        ->where('kotamadya.kotamadya_id', $request->kotamadya)
        ->first();
        if($ckotamadya){ $kotamadyamobil = 'di '.$ckotamadya->name; } else { $kotamadyamobil = ""; }
        if($request->transmisi){ $trans = $request->transmisi; } else { $trans = ""; }
        if($request->from_thn){ $ftahun = "dari tahun ".$request->from_thn; } else { $ftahun = ""; }
        if($request->to_thn){ $ttahun = "sampai tahun ".$request->to_thn; } else { $ttahun = ""; }

        $set = array(
            'merkmobil'         => $merkmobil,
            'typemobil'         => $typemobil,
            'kotamadyamobil'    => $kotamadyamobil,
            'ftahun'            => $ftahun,
            'ttahun'            => $ttahun,
            'trans'            => $trans,
        );

        return view('pages.front.car.search')->with('cars', $result)->with('carspushs', $resultpush)->with('dealers', $dealers)->with('merks', $merk)->with('types', $type)->with('kotas', $kotas)->with($set);
    }

    public function bidding(Request $request){

        //cek Dealer ID
        $dealer = DB::table('dealers')
        ->select('user_id', 'name')
        ->where('user_id', Auth::user()->id)
        ->first();

        $tdealer = DB::table('cars')
        ->select('dealers.user_id', 'cars.name as mobil', 'merk_mobil.name as merk', 'type_mobil.name as type', 'cars.tahun')
        ->leftJoin('dealers', 'dealers.id', '=', 'cars.dealer_id')
        ->leftJoin('merk_mobil', 'merk_mobil.id', '=', 'cars.merk')
        ->leftJoin('type_mobil', 'type_mobil.id', '=', 'cars.type')
        ->where('cars.id', $request->mobil)
        ->first();

        //dd($dealer);
        $now = date('YmdHis');
        $sessionid = Crypt::encryptString($now);

        $bid = Bidding::create([
            'session_id'        => $sessionid, //Crypt::encryptString($id),
            'f_user_id'         => $dealer->user_id,
            't_user_id'         => $tdealer->user_id,
            'car_id'            => $request->mobil,
            'bidding'           => str_replace('.', '', $request->bidding),
            'description'       => $request->description,
            'st_bidding'        => 0
        ]);

        $setemail = DB::table('users')
        ->select('email', 'dealers.name')
        ->leftJoin('dealers', 'dealers.user_id', '=', 'users.id')
        ->where('user_id', $tdealer->user_id)
        ->first();

        $data = array(
            'userto'       => $setemail->name,
            'mobil'        => $tdealer->mobil,
            'merk'         => $tdealer->merk,
            'type'         => $tdealer->type,
            'tahun'        => $tdealer->tahun,
            'userbid'      => $dealer->name,
            'sessionid'    => $sessionid,
            'hargabid'     => $request->bidding
          );

        $emailto = $setemail->email;
        $dmobil = $tdealer->mobil;

        Mail::send('emails.sendbidding', $data, function ($message) use($emailto, $dmobil) {
            $message->from('no-reply@gratama-finance.co.id', 'Info');
            $message->to($emailto)->subject('Bidding '.$dmobil.'| Gratama Finance');
        });

        /*//cek User Yang Punya Dealer
        $tdealer = DB::table('dealers')
        ->select('id', 'user_id')
        ->where('id', $request->ke)
        ->first();

        $cmobil = DB::table('cars')
        ->select('slug', 'name')
        ->where('id', $request->mobil)
        ->first();

        $bid = Inbox::create([
            'f_user_id'         => Auth::user()->id,
            't_user_id'         => $tdealer->user_id,
            'type'              => 'bidding',
            'subject'           => 'Bidding '.$cmobil->name,
            'slug_subject'      => 'bidding-'.$cmobil->slug.'-'.time(),
            'content'           => 'Bidding Mobil: '.$request->model.', Nego: Rp. '.number_format(str_replace(',', '', $request->bidding))

        ]);*/

        Session::flash('success', 'Bidding berhasil terkirim');
        return redirect()->route('bidding.sentitem');

    }

    public function carshubungikami(Request $request){

        //cek User Yang Punya Dealer
        $tdealer = DB::table('dealers')
        ->select('id', 'user_id')
        ->where('id', $request->ke)
        ->first();

        $cmobil = DB::table('cars')
        ->select('slug', 'name')
        ->where('id', $request->mobil)
        ->first();

        $bid = Inbox::create([
            'f_user_id'         => Auth::user()->id,
            't_user_id'         => $tdealer->user_id,
            'type'              => 'hubungikami',
            'subject'           => 'Hubungi Kami '.$cmobil->name,
            'slug_subject'      => 'hubungi-kami-'.$cmobil->slug.'-'.time(),
            'content'           => $request->pesan

        ]);

        Session::flash('success', 'Bidding berhasil terkirim');
        return redirect()->route('inbox.sentitem');

    }

    public function cardealer($id){

        $dealer = DB::table('dealers')
        ->select('dealers.id', 'dealers.name', 'dealers.images', 'dealers.address', 'dealers.phone', 'users.email', 'users.id as user_id', 'dealers.city')
        ->leftJoin('users', 'users.id', '=', 'dealers.user_id')
        ->where('slug', $id)
        ->first();

        $car_similar = DB::table('cars')
        ->select('cars.id', 'cars.name', 'cars.description', 'cars.slug', 'cars.image', 'cars.price', 'cars.tahun', 'dealers.name as dealer', 'merk_mobil.name as merk', 'type_mobil.name as type', 'dealers.address', 'dealers.city', 'dealers.phone', 'dealers.images as imgdealer')
        ->leftJoin('dealers', 'dealers.id', '=', 'cars.dealer_id')
        ->leftJoin('merk_mobil', 'merk_mobil.id', '=', 'cars.merk')
        ->leftJoin('type_mobil', 'type_mobil.id', '=', 'cars.type')
        ->where('st_car', 1)
        ->where('cars.dealer_id', $dealer->id)
        ->get();

        return view('pages.front.car.profildealer')->with('d', $dealer)->with('similars', $car_similar)->with('idnya', $dealer->id);

    }

    public function senddealerhubungikami(Request $request){

        $tdealer = DB::table('dealers')
        ->select('id', 'user_id', 'slug')
        ->where('user_id', $request->ke)
        ->first();

        if($request->status == "member"){
            $fdealer = DB::table('dealers')
            ->select('name')
            ->where('user_id', Auth::user()->id)
            ->first();

            $bid = Inbox::create([
                'f_user_id'         => Auth::user()->id,
                't_user_id'         => $tdealer->user_id,
                'type'              => 'hubungikami',
                'subject'           => 'Dealer Hubungi Kami [Member] - '.$fdealer->name,
                'slug_subject'      => 'hubungi-kami-dealer-member-'.time(),
                'content'           => $request->pesan

            ]);
        } else {
            $bid = Inbox::create([
                'f_user_id'         => 0,
                't_user_id'         => $tdealer->user_id,
                'nama'              => $request->nama,
                'email'             => $request->email,
                'nomer_hp'          => $request->nomer_hp,
                'type'              => 'hubungikami',
                'subject'           => 'Dealer Hubungi Kami [Pengunjung] - '.$request->nama,
                'slug_subject'      => 'hubungi-kami-dealer-pengunjung-'.time(),
                'content'           => $request->pesan

            ]);
        }

        Session::flash('success', 'Pesan berhasil terkirim');
        return redirect('dealer/profile/'.$tdealer->slug);

    }

    public function categorycar($id){
        $car = DB::table('push')
        ->select('cars.id', 'cars.name', 'cars.slug', 'cars.image', 'cars.price', 'cars.tahun', 'dealers.name as dealer', 'dealers.city', 'merk_mobil.name as merk', 'type_mobil.name as type')
        ->leftJoin('cars', 'cars.id', '=', 'push.car_id')
        ->leftJoin('dealers', 'dealers.id', '=', 'cars.dealer_id')
        ->leftJoin('merk_mobil', 'merk_mobil.id', '=', 'cars.merk')
        ->leftJoin('type_mobil', 'type_mobil.id', '=', 'cars.type')
        ->where('merk_mobil.slug_name', $id)
        ->orderBy('push.to_date', 'DESC')
        ->get();

        $dealers = DB::table('dealers')
        ->orderBy('name', 'ASC')
        ->get();

        $merk = DB::table('merk_mobil')
        ->orderBy('name', 'ASC')
        ->get();

        $type = DB::table('type_mobil')
        ->orderBy('name', 'ASC')
        ->get();


        return view('pages.front.car.search')->with('cars', $car)->with('dealers', $dealers)->with('merks', $merk)->with('types', $type);
    }

    public function Sendsubscribe(Request $request){
        $this->validate($request, [

            'email'             => 'required|email'
        ]);

        $subscribe = Subscribe::create([
            'email'             => $request->email,
            'st_user'           => 1
        ]);

        Session::flash('subscribe', 'Subscribe Berhasil Tersimpan.');

        return redirect()->back();
    }

    public function PostModel(Request $request) {

        $typess = DB::table('type_mobil')
        ->where('merk_id', $request->merk)
        ->orderBy('name', 'ASC')
        ->get();

        echo "<script type='text/javascript'> $('#select-beastA').selectize({
            create: true,
            sortField: {
              field: 'value',
              direction: 'asc'
            },
            dropdownParent: 'body'
          });</script>";

        echo '<select id="select-beastA" name="type" class="demo-default" placeholder="Chose Type">
        <option value="">Model</option>';
          foreach($typess as $typee) {
            echo '<option value='.$typee->id.'>'.$typee->name.'</option>';
          }
        echo '</select>';

        echo "<script type='text/javascript'> $('#select-beastA').selectize({
            create: true,
            sortField: {
              field: 'value',
              direction: 'asc'
            },
            dropdownParent: 'body'
          });</script>";

        /*
        echo '<div class="control-group inline-block" style="width: 49.7%" id="DivModel">
        <select id="select-beastA" name="type" class="demo-default" placeholder="Pilih Model">
          <option value="">Model</option>';
          foreach($typess as $typee) {
            echo '<option value="'.$typee->id.'>'.$typee->name.'</option>';
          }
        echo '</select>
        </div>';*/

    }

    public function PostModelSearch(Request $request) {

        $typess = DB::table('type_mobil')
        ->where('merk_id', $request->merk)
        ->orderBy('name', 'ASC')
        ->get();

        echo '<div class="form-group select">
          <select class="form-control" id="select-beast" name="type">
            <option value="">Pilih Type</option>';
            foreach($typess as $typee) {
              echo '<option value='.$typee->id.'>'.$typee->name.'</option>';
            }
          echo '</select>
        </div>';

    }

    public function terimakasih(){
      return view('terimakasih');
    }

    /*public function emailregistrasi()
    {
        $data = array(
            'name'          => 'Puji Kartono',
            'email'         => 'puji.kartono@artdigi.co.id',
            'no_hp'         => '0812345678'
        );
        return view('emails.notifbpkb')->with($data);
    }*/


    // ============ REG ==============

    public function hometest($id)
    {
        // REDIRECT IF NOT USER
        if(Auth::user()->level != 'user') return redirect(route('home'));

        $decId = $this->decrypt($id, 'home');

        // CHECK IF ONGOING MODULES ON
        $ongoing = TestUserOngoing::leftJoin('test_career_modules', 'test_career_modules.id', 'test_user_ongoings.module_career_id')
                ->where('test_user_ongoings.status', '!=', 2)
                ->where('test_user_ongoings.user_id', Auth::user()->id)
                ->whereNull('test_career_modules.deleted_at')
                ->whereNull('test_user_ongoings.deleted_at')
                ->select('test_user_ongoings.*', 'test_career_modules.career_id as career_id')
                ->first();

        if($ongoing && $ongoing->career_id != $decId){
            Session::flash('info', 'There is another career test ongoing, please finish that first.');
            return redirect()->back();
        }

        $modules = TestModule::join('test_career_modules', 'test_career_modules.module_id', 'test_modules.id')
                    ->where('test_career_modules.career_id', $decId)
                    ->whereNull('test_career_modules.deleted_at')
                    ->whereNull('test_modules.deleted_at')
                    ->select('test_modules.*', 'test_career_modules.id as module_career_id')
                    ->get();

        // ADD ONGOING MODULES WITH NO TARGET
        foreach ($modules as $module) {
            TestUserOngoing::firstOrCreate([
                'user_id' => Auth::user()->id,
                'module_career_id' => $module->module_career_id,
            ],[
                'status' => 0,
            ]);
        }

        $career = CmsCareer::whereId($decId)->first();

        return $this->view_page('hometest_new', ['modules' => $modules, 'career' => $career, 'title' => ['title_en' => 'Home Test', 'title_in' => 'Home Test']]);
    }

    public function submitjob($idjob)
    {
        DB::table('tbl_test_user_target')->where('users_id', Auth::user()->id)->where('id_career', $idjob)->update(['st_target' => 2, 'updated_at' => NOW()]);
        
        //kirim email ke HRD
        $admemail = 'hr@reandabernardi.com';
        $nmmember = Auth::user()->first_name." ".Auth::user()->last_name;

        $data = array(
            'name'          => $nmmember,
            'email'         => Auth::user()->email,
        );

        Mail::send('emails.notifikasihrd', $data, function ($message) use($admemail, $nmmember) {
            $message->from('info@reandabernardi.com', 'Info')->subject('Submit Test '.$nmmember.' | Reanda Bernardi');
            $message->to($admemail);
            //$message->bcc('poeji.exact@gmail.com');
        });

        Session::flash('status', 'Thank you for taking the test. We will review it shortly.');
        return redirect()->route('home');
    }

    public function action($halaman, $idjob)
    {   
        //echo "halaman:".$halaman;
        //echo "<br>";
        //echo "idjob:".$idjob;
        //echo "<br>";

        $twaktus = DB::table('tbl_list_test_job')
        ->leftJoin('tbl_test', 'tbl_test.id_test', '=', 'tbl_list_test_job.id_test')
        ->where('id_career', $idjob)
        ->sum('minutes');
        
        $pwaktu = $twaktus + 15;
        $current = Carbon::now();
        $targetwaktu = Carbon::now()->addMinutes($pwaktu);

        //Insert / Update Waktu Mulai dan Target Selesai
        $cekwaktu = DB::table('tbl_test_user_target')
        ->select('id_target')
        ->where('id_career', $idjob)
        ->where('users_id', Auth::user()->id)
        ->first();
        if(isset($cekwaktu->id_target) && $cekwaktu->id_target != "") {
            //jika sudah ada datanya edit datanya
            //DB::table('tbl_test_user_target')->where('users_id', Auth::user()->id)->where('id_career', $idjob)->update(['start' => $current, 'target' => $targetwaktu]);
        } else {
            //jika belum ada datanya tambahkan datanya
            DB::table('tbl_test_user_target')->insert(array ('users_id' => Auth::user()->id, 'id_career' => $idjob, 'start' => $current) );
        }
        
        //exit();

        if($halaman=="personalinformation") {

            //cek apakah sudah terdaftar
            $cek = DB::table('tbl_test_user')
            ->select('id_test_user')
            ->where('users_id', Auth::user()->id)
            ->where('id_test', 1)
            ->where('id_career', $idjob)
            ->first();

            //insert ke tabel test
            if(!isset($cek->id_test_user)) {
                DB::table('tbl_test_user')->insert(array ('users_id' => Auth::user()->id, 'id_test' => 1, 'id_career' => $idjob) );
            }
            
            return redirect()->route('wizard', ['idjob' => Crypt::encryptString($idjob)]);
            //return redirect()->route('wizard', ['idjob' => Crypt::decryptString($idjob)]);

        } else if($halaman=="english") {

            //cek apakah sudah terdaftar
            $cek = DB::table('tbl_test_user')
            ->select('id_test_user')
            ->where('users_id', Auth::user()->id)
            ->where('id_test', 2)
            ->where('id_career', $idjob)
            ->first();

            //insert ke tabel test
            if(!isset($cek->id_test_user)) {
                DB::table('tbl_test_user')->insert(array ('users_id' => Auth::user()->id,'id_test' => 2, 'id_career' => $idjob) );
            }
            
            return redirect()->route('english.step1', ['idjob' => Crypt::encryptString($idjob)]);

        } else if($halaman=="health") {

            //cek apakah sudah terdaftar
            $cek = DB::table('tbl_test_user')
            ->select('id_test_user')
            ->where('users_id', Auth::user()->id)
            ->where('id_test', 5)
            ->where('id_career', $idjob)
            ->first();

            //insert ke tabel test
            if(!isset($cek->id_test_user)) {
                DB::table('tbl_test_user')->insert(array ('users_id' => Auth::user()->id,'id_test' => 5, 'id_career' => $idjob) );
            }
            
            return redirect()->route('health.step1', ['idjob' => Crypt::encryptString($idjob)]);

        } else if($halaman=="technical") {

            //cek apakah sudah terdaftar
            $cek = DB::table('tbl_test_user')
            ->select('id_test_user')
            ->where('users_id', Auth::user()->id)
            ->where('id_test', 3)
            ->where('id_career', $idjob)
            ->first();

            //insert ke tabel test
            if(!isset($cek->id_test_user)) {
                DB::table('tbl_test_user')->insert(array ('users_id' => Auth::user()->id,'id_test' => 3, 'id_career' => $idjob) );
            }
            
            return redirect()->route('technical.test1', ['idjob' => Crypt::encryptString($idjob)]);

        }

        else if($halaman=="technical_set3") {

            //cek apakah sudah terdaftar
            $cek = DB::table('tbl_test_user')
            ->select('id_test_user')
            ->where('users_id', Auth::user()->id)
            ->where('id_test', 6)
            ->where('id_career', $idjob)
            ->first();

            //insert ke tabel test
            if(!isset($cek->id_test_user)) {
                DB::table('tbl_test_user')->insert(array ('users_id' => Auth::user()->id,'id_test' => 6, 'id_career' => $idjob) );
            }
            
            return redirect()->route('technical.set3', ['idjob' => Crypt::encryptString($idjob)]);

        }

        else if($halaman=="tax_test") {

            //cek apakah sudah terdaftar
            $cek = DB::table('tbl_test_user')
            ->select('id_test_user')
            ->where('users_id', Auth::user()->id)
            ->where('id_test', 7)
            ->where('id_career', $idjob)
            ->first();

            //insert ke tabel test
            if(!isset($cek->id_test_user)) {
                DB::table('tbl_test_user')->insert(array ('users_id' => Auth::user()->id,'id_test' => 7, 'id_career' => $idjob) );
            }
            
            return redirect()->route('tax.step1', ['idjob' => Crypt::encryptString($idjob)]);

        }

        else if($halaman=="technical_set4") {

            //cek apakah sudah terdaftar
            $cek = DB::table('tbl_test_user')
            ->select('id_test_user')
            ->where('users_id', Auth::user()->id)
            ->where('id_test', 8)
            ->where('id_career', $idjob)
            ->first();

            //insert ke tabel test
            if(!isset($cek->id_test_user)) {
                DB::table('tbl_test_user')->insert(array ('users_id' => Auth::user()->id,'id_test' => 8, 'id_career' => $idjob) );
            }
            
            return redirect()->route('technical.set4', ['idjob' => Crypt::encryptString($idjob)]);

        }

        else if($halaman=="personality_test") {

            //cek apakah sudah terdaftar
            $cek = DB::table('tbl_test_user')
            ->select('id_test_user')
            ->where('users_id', Auth::user()->id)
            ->where('id_test', 4)
            ->where('id_career', $idjob)
            ->first();

            //insert ke tabel test
            if(!isset($cek->id_test_user)) {
                DB::table('tbl_test_user')->insert(array ('users_id' => Auth::user()->id,'id_test' => 4, 'id_career' => $idjob) );
            }
            
            return redirect()->route('personality_test', ['idjob' => Crypt::encryptString($idjob)]);

        }
        
        
    }

    public function logoutreg($jobid) {
        //jika waktu expired ubah status user menjadi tidak aktif
        DB::table('tbl_test_user_target')->where('users_id', Auth::user()->id)->where('id_career', Crypt::decryptString($jobid))->update(['st_target' => 5]);

        Auth::logout();
        return redirect('/login')->with('message', 'Waktu anda sudah habis');
      }
}
