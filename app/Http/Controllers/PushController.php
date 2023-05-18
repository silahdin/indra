<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;

use DB;
use App\Push;
use Session;
use Auth;

class PushController extends Controller
{
    public function index()
    {
        if(Auth::user()->level == "Administrator") {
            $push = DB::table('push')
            ->select('push.*', 'cars.name as mobil', 'dealers.name as deler')
            ->leftJoin('cars', 'cars.id', '=', 'push.car_id')
            ->leftJoin('dealers', 'dealers.user_id', '=', 'push.user_id')
            ->where('push.possition', 'home')
            ->orderBy('push_id', 'DESC')
            ->get();
        } else {
            $push = DB::table('push')
            ->select('push.*', 'cars.name as mobil', 'dealers.name as deler')
            ->leftJoin('cars', 'cars.id', '=', 'push.car_id')
            ->leftJoin('dealers', 'dealers.user_id', '=', 'push.user_id')
            ->where('push.user_id', Auth::user()->id)
            ->where('push.possition', 'home')
            ->orderBy('push_id', 'DESC')
            ->get();
        }

        return view('pages.admin.push.index')->with('pushs', $push);
    }

    public function pencarian()
    {
        if(Auth::user()->level == "Administrator") {
            $push = DB::table('push')
            ->select('push.*', 'cars.name as mobil', 'dealers.name as deler')
            ->leftJoin('cars', 'cars.id', '=', 'push.car_id')
            ->leftJoin('dealers', 'dealers.user_id', '=', 'push.user_id')
            ->where('push.possition', 'pencarian')
            ->orderBy('push_id', 'DESC')
            ->get();
        } else {
            $push = DB::table('push')
            ->select('push.*', 'cars.name as mobil', 'dealers.name as deler')
            ->leftJoin('cars', 'cars.id', '=', 'push.car_id')
            ->leftJoin('dealers', 'dealers.user_id', '=', 'push.user_id')
            ->where('push.user_id', Auth::user()->id)
            ->where('push.possition', 'pencarian')
            ->orderBy('push_id', 'DESC')
            ->get();
        }

        return view('pages.admin.push.index')->with('pushs', $push);
    }

    public function add()
    {
      if(Auth::user()->level == "Administrator") {
        $car = DB::table('cars')
        ->select('cars.id', 'cars.name')
        ->leftJoin('dealers', 'dealers.id', '=', 'cars.dealer_id')
        ->leftJoin('push', 'push.car_id', '=', 'cars.id')
        ->orderBy('cars.name', 'ASC')
        ->get();
      } else {
        $car = DB::table('cars')
        ->select('cars.id', 'cars.name')
        ->leftJoin('dealers', 'dealers.id', '=', 'cars.dealer_id')
        ->leftJoin('push', 'push.car_id', '=', 'cars.id')
        ->where('dealers.user_id', Auth::user()->id)
        ->whereNOTIn('cars.id',function($query){
           $query->select('p.car_id')->from('push as p')->where('p.user_id', '=', Auth::user()->id)->where('push.possition', '=', 'home');
        })
        ->orderBy('cars.name', 'ASC')
        ->get();
      }

      $dealer = DB::table('dealers')
      ->orderBy('name', 'ASC')
      ->get();

      $sps = array(
          'ps'    => 'home'
      );

    return view('pages.admin.push.add')->with('dealers', $dealer)->with('cars', $car)->with($sps);
    }

    public function addpencarian()
    {
      if(Auth::user()->level == "Administrator") {
        $car = DB::table('cars')
        ->select('cars.id', 'cars.name')
        ->leftJoin('dealers', 'dealers.id', '=', 'cars.dealer_id')
        ->leftJoin('push', 'push.car_id', '=', 'cars.id')
        ->orderBy('cars.name', 'ASC')
        ->get();
      } else {
        $car = DB::table('cars')
        ->select('cars.id', 'cars.name')
        ->leftJoin('dealers', 'dealers.id', '=', 'cars.dealer_id')
        ->leftJoin('push', 'push.car_id', '=', 'cars.id')
        ->where('dealers.user_id', Auth::user()->id)
        ->whereNOTIn('cars.id',function($query){
           $query->select('p.car_id')->from('push as p')->where('p.user_id', '=', Auth::user()->id)->where('push.possition', '=', 'pencarian');
        })
        ->orderBy('cars.name', 'ASC')
        ->get();
      }

      $dealer = DB::table('dealers')
      ->orderBy('name', 'ASC')
      ->get();

      $sps = array(
          'ps'    => 'pencarian'
      );

    return view('pages.admin.push.add')->with('dealers', $dealer)->with('cars', $car)->with($sps);
    }

    public function store(Request $request){

        $this->validate($request, [
            'car_id'              => 'required',
            'user_id'             => 'required',
            'possition'           => 'required',
            'to_date'             => 'required'
        ]);

            $push = Push::create([
                'car_id'          => $request->car_id,
                'user_id'         => $request->user_id,
                'possition'       => $request->possition,
                'to_date'         => $request->to_date
            ]);
            
        $lastid = $push->push_id;

        
        $tdealer = DB::table('cars')
        ->select('dealers.user_id', 'dealers.name as deler', 'cars.name as mobil', 'merk_mobil.name as merk', 'type_mobil.name as type', 'cars.tahun')
        ->leftJoin('dealers', 'dealers.id', '=', 'cars.dealer_id')
        ->leftJoin('merk_mobil', 'merk_mobil.id', '=', 'cars.merk')
        ->leftJoin('type_mobil', 'type_mobil.id', '=', 'cars.type')
        ->where('cars.id', $request->car_id)
        ->first();
        
        $posisi = ucfirst($request->possition);
        
        $data = array(
            'mobil'        => $tdealer->mobil,
            'merk'         => $tdealer->merk,
            'type'         => $tdealer->type,
            'tahun'        => $tdealer->tahun,
            'userbid'      => $tdealer->deler,
            'posisi'       => $tdealer->deler,
            'lastid'       => $lastid
          );
        
        $setemail = DB::table('setting')
        ->select('email_notif')
        ->first();

        $emailto = $setemail->email_notif;
        $dmobil = $tdealer->mobil;

        Mail::send('emails.pushreg', $data, function ($message) use($emailto, $dmobil, $posisi) {
            $message->from('no-reply@gratama-finance.co.id', 'Info');
            $message->to($emailto)->subject('Push '.$posisi.' '.$dmobil.'| Gratama Finance');
        });
        
        Session::flash('success', 'Page Berhasil Ditambahkan.');

        if($request->possition=="home"){
          return redirect()->route('pushs');
        } else {
          return redirect()->route('push.pencarian');
        }

    }

    public function edit($id){

        $push = DB::table('push')
        ->where('push_id', Crypt::decryptString($id))
        ->first();

        $car = DB::table('cars')
        ->orderBy('name', 'ASC')
        ->get();

        $dealer = DB::table('dealers')
        ->orderBy('name', 'ASC')
        ->get();

    	return view('pages.admin.push.edit')->with('push', $push)->with('dealers', $dealer)->with('cars', $car);
    }

    public function update(Request $request, $id){

        //dd($request->all());

        $this->validate($request, [
            'car_id'          => 'required',
            'possition'       => 'required',
            'user_id'         => 'required',
            'to_date'         => 'required'
        ]);

        if($request->to_date >= date('Y-m-d')){
            $st = 1;
        } else {
            $st = 0;
        }

        $push = Push::find(Crypt::decryptString($id));

        $push->car_id            = $request->car_id;
        $push->user_id           = $request->user_id;
        $push->possition         = $request->possition;
        $push->to_date           = $request->to_date;
        $push->st_push           = $request->st_push;
        $push->save();

    	Session::flash('success', 'Mobil Berhasil Diupdate.');
    	
    	if($request->st_push == 1){
    	    $tdealer = DB::table('cars')
        ->select('dealers.user_id', 'dealers.name as deler', 'cars.name as mobil', 'merk_mobil.name as merk', 'type_mobil.name as type', 'cars.tahun', 'users.email')
        ->leftJoin('dealers', 'dealers.id', '=', 'cars.dealer_id')
        ->leftJoin('merk_mobil', 'merk_mobil.id', '=', 'cars.merk')
        ->leftJoin('type_mobil', 'type_mobil.id', '=', 'cars.type')
        ->leftJoin('users', 'users.id', '=', 'dealers.user_id')
        ->where('cars.id', $request->car_id)
        ->first();
        
        $data = array(
            'mobil'        => $tdealer->mobil,
            'merk'         => $tdealer->merk,
            'type'         => $tdealer->type,
            'tahun'        => $tdealer->tahun,
            'userbid'      => $tdealer->deler,
            'posisi'       => ucfirst($request->possition),
            'lastid'       => Crypt::decryptString($id)
          );

        $emailto = $tdealer->email;
        $dmobil = $tdealer->mobil;
        $posisi = ucfirst($request->possition);

        Mail::send('emails.pushapp', $data, function ($message) use($emailto, $dmobil, $posisi) {
            $message->from('no-reply@gratama-finance.co.id', 'Info');
            $message->to($emailto)->subject('Approve - Push '.$posisi.' '.$dmobil.'| Gratama Finance');
        });
    	}
    	
        
      if($request->possition=="home"){
        return redirect()->route('pushs');
      } else {
        return redirect()->route('push.pencarian');
      }
    }
    
    public function editpencarian($id){

        $push = DB::table('push')
        ->where('push_id', Crypt::decryptString($id))
        ->first();

        $car = DB::table('cars')
        ->orderBy('name', 'ASC')
        ->get();

        $dealer = DB::table('dealers')
        ->orderBy('name', 'ASC')
        ->get();

    	return view('pages.admin.push.edit')->with('push', $push)->with('dealers', $dealer)->with('cars', $car);
    }

    public function updatepencarian(Request $request, $id){

        //dd($request->all());

        $this->validate($request, [
            'car_id'          => 'required',
            'possition'       => 'required',
            'user_id'         => 'required',
            'to_date'         => 'required'
        ]);

        /*if($request->to_date >= date('Y-m-d')){
            $st = 1;
        } else {
            $st = 0;
        }*/

        $push = Push::find(Crypt::decryptString($id));

        $push->car_id            = $request->car_id;
        $push->user_id           = $request->user_id;
        $push->possition         = $request->possition;
        $push->to_date           = $request->to_date;
        $push->st_push           = $request->st_push;
        $push->save();

    	Session::flash('success', 'Mobil Berhasil Diupdate.');
      if($request->possition=="home"){
        return redirect()->route('pushs');
      } else {
        return redirect()->route('push.pencarian');
      }
    }

    public function delete($id){
    	$push = Push::find(Crypt::decryptString($id));

    	$push->delete();

    	Session::flash('success', 'Mobil Berhasil Dihapus');
    	return redirect()->back();
    }
}
