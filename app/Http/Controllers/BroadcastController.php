<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;

use DB;
use Auth;
use Carbon;
use App\Broadcast;
use App\BroadcastTo;
use Session;

class BroadcastController extends Controller
{

  public function index(){

      $broadcast = DB::table('broadcast')
      ->select('id_broadcast', 'subject', 'created_at')
      ->orderBy('id_broadcast', 'DESC')
      ->get();

      return view('pages.admin.broadcast.index')->with('broadcasts', $broadcast);
  }

  public function detail($id){

      $broadcast = DB::table('broadcast')
      ->where('broadcast.id_broadcast', Crypt::decryptString($id))
      ->first();

      return view('pages.admin.broadcast.detail')->with('broadcast', $broadcast);


  }

  public function store(Request $request){
    //dd($request->all());

    //insert to broadcast
    $broadcast = Broadcast::create([
        'subject'      => $request->subject,
        'content'      => $request->content
    ]);

    $lastInsertedId = $broadcast->id_broadcast;

    if($request->semua == "ya"){ //kirim semua =================================

      $usrs = DB::table('users')
      ->select('email', 'dealers.name', 'users.id')
      ->leftJoin('dealers', 'dealers.user_id', '=', 'users.id')
      ->where('st_user', 1)
      ->get();

      foreach ($usrs as $usr) {
          //kirim email ===========================================================================================

          //insert to broadcast To
          $broadcastto = BroadcastTo::create([
              'id_broadcast'  => $lastInsertedId,
              'user_id'       => $usr->id
          ]);

          $data = array(
              'userto'       => $usr->name,
              'content'      => $request->content
            );

          $emailto  = $usr->email;
          $subjek   = $request->subject;

          Mail::send('emails.broadcast', $data, function ($message) use($emailto, $subjek) {
              $message->from('no-reply@gratama-finance.co.id', 'No Reply');
              $message->to($emailto)->subject($subjek.' | Gratama Finance');
          });
      }

    } else { //tidak kirim semua =================================
      $count = count($request->tujuan);
      for ($i=0; $i < $count; $i++) {
        $usr = DB::table('users')
        ->select('email', 'dealers.name')
        ->leftJoin('dealers', 'dealers.user_id', '=', 'users.id')
        ->where('users.id', $request->tujuan[$i])
        ->first();

        //insert to broadcast To
        $broadcastto = BroadcastTo::create([
            'id_broadcast'  => $lastInsertedId,
            'user_id'       => $request->tujuan[$i]
        ]);

        //kirim email ===========================================================================================
        $data = array(
            'userto'       => $usr->name,
            'content'      => $request->content
          );

        $emailto  = $usr->email;
        $subjek   = $request->subject;

        Mail::send('emails.broadcast', $data, function ($message) use($emailto, $subjek) {
            $message->from('no-reply@gratama-finance.co.id', 'No Reply');
            $message->to($emailto)->subject($subjek.' | Gratama Finance');
        });
        //kirim email ===========================================================================================
      }
    }

    Session::flash('success', 'Broadcast Berhasil Terkirim.');

    return redirect()->route('broadcasts');

  }

  public function sentitem(){
    $tujuan = DB::table('dealers')
    ->select('dealers.name', 'users.id')
    ->leftJoin('users', 'users.id', '=', 'dealers.user_id')
    ->where('users.st_user', 1)
    ->get();

    return view('pages.admin.broadcast.sentitem')->with('dealers', $tujuan);
  }

  public function delete($id){
    $broadcast = Broadcast::find(Crypt::decryptString($id));
    $broadcast->delete();

    Session::flash('success', 'Broadcast Berhasil Dihapus');
    return redirect()->back();
  }

}
