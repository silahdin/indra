<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
Use Session;
use Auth;
use App\User;
use App\CmsPages;
use Hash;


class AdminHalamanController extends Controller{

    public function index(){
// $users = DB::table('really_long_table_name AS t')
           // ->select('t.id AS uid')        
        $post = DB::table('cms_pages')
        // ->select('cms_pages.*, cms_position.id AS id_pos  ')
        // ->select('cms_position.id AS id_pos ')
        ->leftJoin('cms_position', 'cms_position.position_id', '=', 'cms_pages.position')
        ->orderBy('cms_pages.id', 'DESC')
        ->get(); 

        // echo "<pre>";
        // print_r($post);
        // echo "</pre>";
        // die();
        
        return view('pages.cms_compro.halaman.index')->with('posts', $post);
    }

    public function add(){
        $cat = DB::table('cms_position')
        ->get();

        return view('pages.cms_compro.halaman.add')->with('cat',$cat);
    }

    public function store(Request $request){

        function slugify($text){
          // replace non letter or digits by -
          $text = preg_replace('~[^\pL\d]+~u', '-', $text);

          // transliterate
          $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

          // remove unwanted characters
          $text = preg_replace('~[^-\w]+~', '', $text);

          // trim
          $text = trim($text, '-');

          // remove duplicate -
          $text = preg_replace('~-+~', '-', $text);

          // lowercase
          $text = strtolower($text);

          if (empty($text)) {
            return 'n-a';
          }

          return $text;
        }

        $this->validate($request, [
            'name_in'     => 'required',
            'name_en'     => 'required',
            'title_in'             => 'required',
            'title_en'             => 'required',
            'content_in'           => 'required',
            'content_en'           => 'required',
            'position'        => 'required',
            'rowstate'       => 'required'
        ]);

        echo slugify($request->title_in);

        // echo "<pre>";
        // print_r($_POST);
        // echo "</pre>";
        // die();

        if ( isset($request->url) ) {
            $slug = $request->url;
        }else{
            $slug = slugify($request->title_in);
        }

        $post = CmsPages::create([
            'url'               => $slug,
            'name_in'        => $request->name_in,
            'name_en'        => $request->name_en,
            'title_in'          => $request->title_in,
            'title_en'          => $request->title_en,
            'content_in'        => $request->content_in,
            'content_en'        => $request->content_en,
            'position'     => $request->position,
            'rowstate'          => $request->rowstate,
            'user_id'           => 1,
            'created_at'        => date('Y-m-d')
        ]);

        Session::flash('success', 'Halaman Berhasil Ditambahkan.');
        return redirect()->route('hal');            

    }

    public function edit($id){
        $post = DB::table('cms_pages')
        ->where('id', $id)
        ->first();

        $cat = DB::table('cms_position')        
        ->get();        

        return view('pages.cms_compro.halaman.edit')->with('post', $post)->with('cat', $cat);
    }

    public function update(Request $request, $id){

    	// echo "<pre>";
     //    print_r($_POST);
     //    echo "</pre>";
     //    die();

        $this->validate($request, [
            'name_in'     => 'required',
            'name_en'     => 'required',
            'title_in'             => 'required',
            'title_en'             => 'required',
            'content_in'           => 'required',
            'content_en'           => 'required',
            'position'        => 'required',
            'url'        => 'required',
            'rowstate'       => 'required'
        ]);

        DB::table('cms_pages')->where('id', $id)->update([
            'url'               => $request->url,
            'name_in'        => $request->name_in,
            'name_en'        => $request->name_en,
            'title_in'          => $request->title_in,
            'title_en'          => $request->title_en,
            'content_in'        => $request->content_in,
            'content_en'        => $request->content_en,
            'position'     => $request->position,
            'rowstate'          => $request->rowstate,
            'user_id'           => 1,
            'updated_at'        => date('Y-m-d')
        ]);

        Session::flash('success', 'Halaman Berhasil Diubah.');
        return redirect()->route('hal');
        
    }

    public function delete($id){
        $post = CmsPages::find($id);
        $post->delete();

        Session::flash('success', 'Halaman Berhasil Dihapus');
        return redirect()->back();
    }
}
