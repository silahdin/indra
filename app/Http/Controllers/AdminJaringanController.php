<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
Use Session;
use Auth;
use App\User;
use App\CmsBranch;
use Hash;


class AdminJaringanController extends Controller{

    public function index(){
        // return view('pages.admin.inbox.index')->with('inbox', $inbox);
        $post = DB::table('cms_branch')
        ->orderBy('id_branch', 'ASC')
        ->get();
        
        return view('pages.cms_compro.jaringan.index')->with('posts', $post);
    }

    public function add(){
        $post = DB::table('cms_province')
        ->get();        
        return view('pages.cms_compro.jaringan.add')->with('kotas',$post);
    }

    public function store(Request $request){


        // print_r($_POST);

        // die();        
        
        $this->validate($request, [
            'title'             => 'required',
            'latitude'          => 'required',
            'longitude'            => 'required',
            'description'       => 'required',
            'address_one'          => 'required',
            'address_two'            => 'required',
            'url'       => 'required',
        ]);


        $post = CmsBranch::create([
            'title'             => $request->title,
            'latitude'          => $request->latitude,
            'longitude'         => $request->longitude,
            'description'       => $request->description,
            'address_one'       => $request->address_one,
            'address_two'       => $request->address_two,
            'url'               => $request->url
        ]);
        

        Session::flash('success', 'Cabang Berhasil Ditambahkan.');
        

        return redirect()->route('jaringan');
    }

    public function edit($id){
        $kotas = DB::table('cms_province')
        ->get();

        $post = DB::table('cms_branch')
        ->where('id_branch', $id)
        ->first();
        
        return view('pages.cms_compro.jaringan.edit')->with('kotas', $kotas)->with('post', $post);
    }

    public function update(Request $request, $id){
        // print_r($_POST);
        // die();      
        $this->validate($request, [
            'title'             => 'required',
            'latitude'          => 'required',
            'longitude'         => 'required',
            'description'       => 'required',
            'address_one'       => 'required',
            'address_two'       => 'required',
            'url'               => 'required',
        ]);
        
        DB::table('cms_branch')->where('id_branch', $id)->update([
            'title'             => $request->title,
            'latitude'          => $request->latitude,
            'longitude'         => $request->longitude,
            'description'       => $request->description,
            'address_one'       => $request->address_one,
            'address_two'       => $request->address_two,
            'url'               => $request->url
            ]);

        Session::flash('success', 'Cabang Berhasil Diupdate.');
        return redirect()->route('jaringan');
    }

    public function delete($id){
        $post = CmsBranch::find($id);
        $post->delete();

        Session::flash('success', 'Cabang Berhasil Dihapus');
        return redirect()->back();
    }
}
