<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
Use Session;
use Auth;
use App\User;
use App\CmsProduct;
use Hash;


class AdminProdukController extends Controller{

    public function index(){
        // return view('pages.admin.inbox.index')->with('inbox', $inbox);
        $post = DB::table('cms_product')
        // ->where('rowstate', 1)
        ->orderBy('id', 'ASC')
        ->get();
        
        return view('pages.cms_compro.produk.index')->with('posts', $post);
    }

    public function add(){
        return view('pages.cms_compro.produk.add');
    }

    public function store(Request $request){

        // echo "<pre>";
        // print_r($_POST);
        // echo "</pre>";

        // if($request->hasFile('img_icon')){
        // 	echo "wow";
        //     $featured = $request->img_icon;        	
        //     echo "string = ".$featured_new_name;
        // }
        // die();  

        $this->validate($request, [
            'title_in'				=> 'required',
            'title_en'				=> 'required',
            'description_in'		=> 'required',
            'description_en'		=> 'required',
            'content_in'			=> 'required',
            'rowstate'              => 'required',
            'content_en'			=> 'required'
        ]);

        if($request->hasFile('img_icon')){
            $featured = $request->img_icon;
            $featured_new_name = time()."_".$featured->getClientOriginalName();
            $featured->move('assets/compro/assets/frontend_assets/icons', $featured_new_name);

            $dealer = CmsProduct::create([
                'img_icon'				=> 'assets/compro/assets/frontend_assets/icons/'.$featured_new_name,
                'title_in'				=> $request->title_in,
                'title_en'				=> $request->title_en,
                'description_in'		=> $request->description_in,
                'description_en'		=> $request->description_en,
                'content_in'			=> $request->content_in,
                'content_en'			=> $request->content_en,
                'rowstate'              => $request->rowstate                
            ]);

	        Session::flash('success', 'Produk Berhasil Ditambahkan.');
	        return redirect()->route('produk');
            
        }else{
            Session::flash('error', 'Produk Gagal Ditambahkan. Gambar Ikon harus diupload');
            return redirect()->route('produk');
        }

        

    }

    public function edit($id){
        $post = DB::table('cms_product')
        ->where('id', $id)
        ->first();
        
        return view('pages.cms_compro.produk.edit')->with('post', $post);
    }


    public function update(Request $request, $id){
    	// echo "<pre>";
     //    print_r($_POST);
    	// echo "</pre>";
        // die();

        $this->validate($request, [
            'title_in'				=> 'required',
            'title_en'				=> 'required',
            'description_in'		=> 'required',
            'description_en'		=> 'required',
            'content_in'			=> 'required',
            'rowstate'              => 'required',
            'content_en'			=> 'required'
        ]);

        if($request->hasFile('img_icon')){

        	// die('ada');
            $featured = $request->img_icon;
            $featured_new_name = time()."_".$featured->getClientOriginalName();
            $featured->move('assets/compro/assets/frontend_assets/icons', $featured_new_name);
                    
	        DB::table('cms_product')->where('id', $id)->update([
                'img_icon'				=> 'assets/compro/assets/frontend_assets/icons/'.$featured_new_name,
                'title_in'				=> $request->title_in,
                'title_en'				=> $request->title_en,
                'description_in'		=> $request->description_in,
                'description_en'		=> $request->description_en,
                'content_in'			=> $request->content_in,
                'content_en'			=> $request->content_en,
                'rowstate'               => $request->rowstate                
	            ]);
	    }else{
	    	// die('gak ada');
	        DB::table('cms_product')->where('id', $id)->update([
                'title_in'				=> $request->title_in,
                'title_en'				=> $request->title_en,
                'description_in'		=> $request->description_in,
                'description_en'		=> $request->description_en,
                'content_in'			=> $request->content_in,
                'content_en'			=> $request->content_en,
                'rowstate'              => $request->rowstate                
	            ]);
	    }

        Session::flash('success', 'Produk Berhasil Diupdate.');
        return redirect()->route('produk');
    }

    public function delete($id){
        $post = CmsProduct::find($id);
        $post->delete();

        Session::flash('success', 'Produk Berhasil Dihapus');
        return redirect()->back();
    }
}
