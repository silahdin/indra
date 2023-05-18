<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
Use Session;
use Auth;
use App\User;
use App\CmsArticle;
use Hash;
use Image;


class AdminArticleController extends Controller{

    public function index(){
        $post = DB::table('cms_article')
        ->select('cms_article.*', 'cms_categories.id' ,'cms_categories.name_in', 'cms_categories.name_en' )
        ->leftJoin('cms_categories', 'cms_categories.id', '=', 'cms_article.categories_id')
        ->orderBy('cms_article.article_id', 'DESC')
        ->get(); 
        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();  
        //     echo "<pre>";
        // print_r($post);
        // echo "</pre>";
        // die(); 
        
        return view('pages.cms_compro.artikel.index')->with('posts', $post)->with('setting', $setting);
    }

    public function add(){
        $cat = DB::table('cms_categories')
        ->where('rowstate', 1)        
        ->get();
        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();  
        return view('pages.cms_compro.artikel.add')->with('cat',$cat)->with('setting', $setting);
    }

    public function store(Request $request){

        // dd($request->all());
        // die();

        // echo "<pre>";
        // print_r($img);
        // echo "</pre>";

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
            'title_in'             => 'required',
            'title_en'             => 'required',
            'content_in'           => 'required',
            'content_en'           => 'required',
            'categories_id'        => 'required',
            'rowstate'       => 'required'
        ]);

        // echo slugify($request->title_in);

        // echo "<pre>";
        // print_r($_POST);
        // echo "</pre>";
        // // die();

        if ( isset($request->url) ) {
            $slug = $request->url;
        }else{
            $slug = slugify($request->title_in);
        }

        // if ($request->get('image-data')) {
        //     die('ada');
        // }else{
        //     die('tidak ada');
        // }

        if($request->get('image-data')){
            $name = time().'_article.png';

            $image_data = $request->get('image-data');
            $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image_data));
            $img = Image::make($info);
            $img->save('assets/compro/assets/frontend_assets/images/img_news/'.$name);

            $post = CmsArticle::create([
                'img_head'          => 'assets/compro/assets/frontend_assets/images/img_news/'.$name,
                'url'               => $slug,
                'title_in'          => $request->title_in,
                'title_en'          => $request->title_en,
                'content_in'        => $request->content_in,
                'content_en'        => $request->content_en,
                'categories_id'     => $request->categories_id,
                'rowstate'          => $request->rowstate,
                'user_id'           => 1,
                'created_at'        => date('Y-m-d')
            ]);

            Session::flash('success', 'Berita/Artikel Berhasil Ditambahkan.');
            return redirect()->route('article');
        }else{
            // die('gak ada');
            $no_img = 'no_image.png';

            $post = CmsArticle::create([
                'img_head'          => 'assets/compro/assets/frontend_assets/images/img_news/'.$no_img,
                'url'               => $slug,
                'title_in'          => $request->title_in,
                'title_en'          => $request->title_en,
                'content_in'        => $request->content_in,
                'content_en'        => $request->content_en,
                'categories_id'     => $request->categories_id,
                'rowstate'          => $request->rowstate,
                'user_id'           => 1,
                'updated_at'        => date('Y-m-d')
            ]);

            Session::flash('success', 'Berita/Artikel Berhasil Ditambahkan.');
            return redirect()->route('article');            
        }

    }

    public function edit($id){
        $post = DB::table('cms_article')
        ->where('article_id', $id)
        ->first();

        $cat = DB::table('cms_categories')
        ->where('rowstate', 1)        
        ->get();        
        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();  
        return view('pages.cms_compro.artikel.edit')->with('post', $post)->with('cat', $cat)->with('setting', $setting);
    }

    public function update(Request $request, $id){

    	// echo "<pre>";
     //    print_r($_POST);
     //    echo "</pre>";
     //    die();

        $this->validate($request, [
            'title_in'             => 'required',
            'title_en'             => 'required',
            'content_in'           => 'required',
            'content_en'           => 'required',
            'categories_id'        => 'required',
            'url'                  => 'required',
            'rowstate'             => 'required',
        ]);
        
        if($request->get('image-data')){
            $name = time().'_article.png';

            $image_data = $request->get('image-data');
            $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image_data));
            $img = Image::make($info);
            $img->save('assets/compro/assets/frontend_assets/images/img_news/'.$name);

            DB::table('cms_article')->where('article_id', $id)->update([
                'img_head'          => 'assets/compro/assets/frontend_assets/images/img_news/'.$name,
                'url'               => $request->url,
                'title_in'          => $request->title_in,
                'title_en'          => $request->title_en,
                'content_in'        => $request->content_in,
                'content_en'        => $request->content_en,
                'categories_id'     => $request->categories_id,
                'rowstate'          => $request->rowstate,
                'user_id'           => 1,
                'updated_at'        => date('Y-m-d')
            ]);

            Session::flash('success', 'Success Update');
            return redirect()->route('article');
        }else{

            DB::table('cms_article')->where('article_id', $id)->update([
                'url'               => $request->url,
                'title_in'          => $request->title_in,
                'title_en'          => $request->title_en,
                'content_in'        => $request->content_in,
                'content_en'        => $request->content_en,
                'categories_id'     => $request->categories_id,
                'rowstate'          => $request->rowstate,
                'user_id'           => 1,
                'updated_at'        => date('Y-m-d')
            ]);

            Session::flash('success', 'Berita/Artikel Berhasil Diubah.');
            return redirect()->route('article');            
        }
        
    }

    public function delete($id){
        $post = CmsArticle::find($id);
        $post->delete();

        Session::flash('success', 'Berita/Artikel Berhasil Dihapus');
        return redirect()->back();
    }
}
