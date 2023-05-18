<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;

use DB;
Use Session;
use Auth;

use App\Bidding;
use App\ReplyBidding;

class BiddingController extends Controller
{
    public function index()
    {
        if(Auth::user()->level == "Administrator"){
            $bidding = DB::table('bidding')
            ->select('bidding.*', 'cars.name as mobil', 'dealers.name as deler', 'cars.price')
            ->leftJoin('cars', 'cars.id', '=', 'bidding.car_id')
            ->leftJoin('users', 'users.id', '=', 'bidding.f_user_id')
            ->leftJoin('dealers', 'dealers.user_id', '=', 'users.id')
            ->orderBy('bidding.bidding_id', 'ASC')
            ->get();
        } else {
            $bidding = DB::table('bidding')
            ->select('bidding.*', 'cars.name as mobil', 'dealers.name as deler', 'cars.price')
            ->leftJoin('cars', 'cars.id', '=', 'bidding.car_id')
            ->leftJoin('users', 'users.id', '=', 'bidding.f_user_id')
            ->leftJoin('dealers', 'dealers.user_id', '=', 'users.id')
            ->where('bidding.t_user_id', Auth::user()->id)
            ->orderBy('bidding.bidding_id', 'ASC')
            ->get();
        }

        return view('pages.admin.bidding.index')->with('biddings', $bidding);
    }

    public function sentitem()
    {
        $bidding = DB::table('bidding')
        ->select('bidding.*', 'cars.name as mobil', 'dealers.name as deler', 'cars.price')
        ->leftJoin('cars', 'cars.id', '=', 'bidding.car_id')
        ->leftJoin('dealers', 'dealers.id', '=', 'cars.dealer_id')
        ->where('f_user_id', Auth::user()->id)
        ->orderBy('bidding.bidding_id', 'ASC')
        ->get();

        return view('pages.admin.bidding.sentitem')->with('biddings', $bidding);
    }

    public function detail($id){

        $bidding = DB::table('bidding')
        ->select('bidding.*', 'cars.name as mobil', 'dealers.name as deler', 'bidding.session_id', 'cars.image', 'cars.price', 'users.id as userid')
        ->leftJoin('users', 'users.id', '=', 'bidding.f_user_id')
        ->leftJoin('dealers', 'dealers.user_id', '=', 'bidding.f_user_id')
        ->leftJoin('cars', 'cars.id', '=', 'bidding.car_id')
        ->where('bidding.session_id', $id)
        ->first();

        //dd($bidding);

        $reply = DB::table('reply_bidding')
        ->select('users.name', 'dealers.images', 'reply', 'reply_bidding.created_at', 'reply_bidding.updated_at', 'reply_bidding.file')
        ->leftJoin('users', 'users.id', '=', 'reply_bidding.user_id')
        ->leftJoin('dealers', 'dealers.user_id', '=', 'users.id')
        ->where('reply_bidding.session_id', $id)
        ->get();

        if(Auth::user()->id == $bidding->t_user_id){
            DB::table('bidding')->where('session_id',$id)->update(['read' => 1]);
        }

        return view('pages.admin.bidding.detail')->with('inbox', $bidding)->with('replys', $reply);

    }

    public function reply(Request $request){

        $this->validate($request, [
            'reply'          => 'required'
        ]);

        if($request->hasFile('file')){
            $featured = $request->file;
            $featured_new_name = time()."_".$featured->getClientOriginalName();
            $featured->move('uploads/bidding', $featured_new_name);

            $inbox = ReplyBidding::create([
                'session_id'      => $request->session_id,
                'user_id'         => Auth::user()->id,
                'reply'           => $request->reply,
                'file'            => 'uploads/bidding/'.$featured_new_name,
            ]);

        } else {

            $inbox = ReplyBidding::create([
                'session_id'      => $request->session_id,
                'user_id'         => Auth::user()->id,
                'reply'           => $request->reply
            ]);

        }

        $setbid = DB::table('bidding')
        ->select('car_id', 'f_user_id', 't_user_id')
        ->where('session_id', $request->session_id)
        ->first();

        if($setbid->f_user_id == Auth::user()->id){
          $userid = $setbid->t_user_id;
        } else {
          $userid = $setbid->f_user_id;
        }

        $tdealer = DB::table('cars')
        ->select('dealers.user_id', 'cars.name as mobil', 'merk_mobil.name as merk', 'type_mobil.name as type', 'cars.tahun')
        ->leftJoin('dealers', 'dealers.id', '=', 'cars.dealer_id')
        ->leftJoin('merk_mobil', 'merk_mobil.id', '=', 'cars.merk')
        ->leftJoin('type_mobil', 'type_mobil.id', '=', 'cars.type')
        ->where('cars.id', $setbid->car_id)
        ->first();

        $setemail = DB::table('users')
        ->select('email', 'dealers.name')
        ->leftJoin('dealers', 'dealers.user_id', '=', 'users.id')
        ->where('user_id', $userid)
        ->first();

        if($request->setuju){
            DB::table('bidding')->where('session_id', $request->session_id)->update([
                'st_bidding' => 1
                ]);

            DB::table('cars')->where('id', $setbid->car_id)->update([
                'st_car' => 2
                ]);


        }

        $data = array(
            'userto'       => $setemail->name,
            'mobil'        => $tdealer->mobil,
            'merk'         => $tdealer->merk,
            'type'         => $tdealer->type,
            'tahun'        => $tdealer->tahun,
            'userbid'      => $setemail->name,
            'comment'      => $request->reply
          );

        $emailto = $setemail->email;
        $dmobil = $tdealer->mobil;

        Mail::send('emails.sendreplybidding', $data, function ($message) use($emailto, $dmobil) {
            $message->from('no-reply@gratama-finance.co.id', 'No Reply');
            $message->to($emailto)->subject('Bidding '.$dmobil.' | Gratama Finance');
        });

        Session::flash('success', 'Reply Berhasil Dikirim.');

        return redirect()->route('bidding.detail', ['id' => $request->session_id]);
    }
}
