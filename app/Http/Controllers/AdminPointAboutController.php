<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
Use Session;
use Auth;
use App\User;
use App\CmsPointAbout;
use Hash;
use Image;


class AdminPointAboutController extends Controller{

    public function index(){
        // return view('pages.admin.inbox.index')->with('inbox', $inbox);
        $post = DB::table('cms_point_about')
        ->orderBy('id', 'ASC')
        ->get();
        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();  
        return view('pages.cms_compro.point_about.index')->with('posts', $post)->with('setting', $setting);
    }

    public function add(){
        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();  
        return view('pages.cms_compro.point_about.add')->with('setting', $setting);
    }

    public function store(Request $request){
        // print_r($_POST);
        // die();   
      
        $this->validate($request, [
            'title_in'             => 'required',
            'title_en'             => 'required',
            'content_in'           => 'required',
            'content_en'           => 'required',
            'rowstate'       => 'required',
        ]);


        $post = CmsPointAbout::create([
            'title_in'               => $request->title_in,
            'title_en'               => $request->title_in,
            'content_in'               => $request->content_in,
            'content_en'               => $request->content_en,  
            'rowstate'          => $request->rowstate,
            'created_at'        => date('Y-m-d H:i:s')
        ]);

        Session::flash('success', 'Berhasil Ditambahkan.');
        return redirect()->route('point_about');
    }

    public function edit($id){
        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();  
        $post = DB::table('cms_point_about')
        ->where('id', $id)
        ->first();
        
        return view('pages.cms_compro.point_about.edit')->with('post', $post)->with('setting', $setting);
    }

    public function update(Request $request, $id){
        // print_r($_POST);
        // die();      
        
        $this->validate($request, [ 
            'title_in'             => 'required',
            'title_en'             => 'required',
            'content_in'           => 'required',
            'content_en'           => 'required',
            'rowstate'       => 'required',
        ]);

        DB::table('cms_point_about')->where('id', $id)->update([
            'title_in'          => $request->title_in,
            'title_en'          => $request->title_en,
            'content_in'        => $request->content_in,
            'content_en'        => $request->content_en,              
            'rowstate'          => $request->rowstate,
            'created_at'        => date('Y-m-d H:i:s')
        ]);

        Session::flash('success', 'Berhasil di update Ditambahkan.');
        return redirect()->route('point_about');

    }

    public function delete($id){
        $post = CmsPointAbout::find($id);
        $post->delete();

        Session::flash('success', 'Berhasil Dihapus');
        return redirect()->back();
    }
}
