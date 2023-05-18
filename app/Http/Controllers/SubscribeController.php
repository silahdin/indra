<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

use DB;
Use Session;
use App\Subscribe;

class SubscribeController extends Controller
{
    public function index()
    {
        
            $subs = DB::table('subscribes')
            ->orderBy('subscribe_id', 'DESC')
            ->get();
        
        return view('pages.admin.subscribe.index')->with('subs', $subs);
    }

    public function edit($id){

        $subscribe = DB::table('subscribes')
        ->where('subscribe_id', Crypt::decryptString($id))
        ->first();
        
    	return view('pages.admin.subscribe.edit')->with('subscribe', $subscribe);
    }

    public function update(Request $request, $id){

        $this->validate($request, [
      
            'email'                 => 'required',
            'st_subscribe'          => 'required'
        ]);
        
        $subscribe = Subscribe::find(Crypt::decryptString($id));

        $subscribe->email                   = $request->email;
        $subscribe->st_subscribe            = $request->st_subscribe;
    	$subscribe->save();

    	Session::flash('success', 'Data Subscribe Berhasil Diupdate.');
    	return redirect()->route('subscribes');
    }

    public function delete($id){
    	$subscribe = Subscribe::find(Crypt::decryptString($id));
    	$subscribe->delete();

    	Session::flash('success', 'Data Subscribe Berhasil Dihapus');
    	return redirect()->back();
    }
}
