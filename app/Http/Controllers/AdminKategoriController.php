<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
Use Session;
use Auth;
use App\User;
use App\CmsCategories;
use Hash;


class AdminKategoriController extends Controller{

    public function index(){
        // return view('pages.admin.inbox.index')->with('inbox', $inbox);
        $post = DB::table('cms_categories')
        // ->orderBy('id', 'ASC')
        ->get();
        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();  
        return view('pages.cms_compro.kategori.index')->with('posts', $post)->with('setting', $setting);
    }

    public function add(){
        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();          
        return view('pages.cms_compro.kategori.add')->with('setting', $setting);
    }

    public function store(Request $request){

    	// echo "<pre>";
     //    print_r($_POST);
     //    echo "</pre>";
     //    die(); 

        $this->validate($request, [
            'name_in'             => 'required',
            'name_en'          => 'required',
            'rowstate'       => 'required'
        ]);

        $post = CmsCategories::create([
            'name_in'             => $request->name_in,
            'name_en'          => $request->name_en,
            'rowstate'               => $request->rowstate
        ]);

        Session::flash('success', 'Kategori Berhasil Ditambahkan.');

        return redirect()->route('kategori');
    }

    public function edit($id){
        $post = DB::table('cms_categories')
        ->where('id', $id)
        ->first();
        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();  
        return view('pages.cms_compro.kategori.edit')->with('post', $post)->with('setting', $setting);
    }

    public function update(Request $request, $id){

    	// echo "<pre>";
     //    print_r($_POST);
     //    echo "</pre>";
     //    die();      
        $this->validate($request, [
            'name_in'             => 'required',
            'name_en'          => 'required',
            'rowstate'       => 'required'
        ]);
        
        DB::table('cms_categories')->where('id', $id)->update([
            'name_in'             => $request->name_in,
            'name_en'          => $request->name_en,
            'rowstate'               => $request->rowstate
            ]);

        Session::flash('success', 'Kategori Berhasil Diupdate.');
        return redirect()->route('kategori');
    }

    public function delete($id){
        $post = CmsCategories::find($id);
        $post->delete();

        Session::flash('success', 'Kategori Berhasil Dihapus');
        return redirect()->back();
    }
}
