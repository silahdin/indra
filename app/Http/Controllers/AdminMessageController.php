<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
Use Session;
use Auth;
use App\User;
use App\CmsMessages;
use Hash;
use Image;


class AdminMessageController extends Controller{

    public function index(){
        // return view('pages.admin.inbox.index')->with('inbox', $inbox);
        $post = DB::table('cms_messages')
        ->orderBy('id', 'DESC')
        ->get();
        
        return view('pages.cms_compro.messages.index')->with('posts', $post);
    }

    public function delete($id){
        $post = CmsMessages::find($id);
        $post->delete();

        Session::flash('success', 'Berhasil Dihapus');
        return redirect()->back();
    }
}
