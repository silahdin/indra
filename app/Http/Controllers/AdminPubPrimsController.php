<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
Use Session;
use Auth;
use App\User;
use Hash;
use Image;


class AdminPubPrimsController extends Controller{

    public function index(){
        $post = DB::table('cms_pubprims')
        ->orderBy('id', 'ASC')
        ->get();

        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();  
        return view('pages.cms_compro.pubPrims.index')->with('posts', $post)->with('setting', $setting);
    }

    public function add(){
        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();

        return view('pages.cms_compro.pubPrims.add')->with('setting', $setting);
    }

    public function store(Request $request){
        // print_r($_POST);

        // echo $request->file('doc')->getClientOriginalName();
        // $nameDoc = $_FILES['doc']['name'];

        // if( $request->file('doc') ){
        //     echo 'a';
        // }else{
        //     echo 'b';
        // }        
        // die();   
      
        $this->validate($request, [
            'title_en'    => 'required',
            'title_in'    => 'required',
            'text_in'    => 'required',
            'text_en'    => 'required',
            'rowstate'       => 'required',
        ]);

        $pathDoc = 'assets/compro/assets/frontend_assets/doc/pub_prims/';
        $nameDoc = time().'_pubPrims_'.$request->file('doc')->getClientOriginalName();
        $request->file('doc')->move($pathDoc,$nameDoc);

        if($request->get('image-data')){
            $name = time().'_pubPrims.png';

            $image_data = $request->get('image-data');
            $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image_data));
            $img = Image::make($info);
            $img->save('assets/compro/assets/frontend_assets/images/pub_prims/'.$name);

            DB::table('cms_pubprims')->insert([
                'img'          => 'assets/compro/assets/frontend_assets/images/pub_prims/'.$name,
                'doc'               => 'assets/compro/assets/frontend_assets/doc/pub_prims/'.$nameDoc,
                'title_in'               => $request->title_in,
                'title_en'               => $request->title_en,
                'text_in'               => $request->text_in,
                'text_en'               => $request->text_en,                
                // 'url'               => $request->url,           
                'rowstate'          => $request->rowstate,
                'created_at'        => date('Y-m-d H:i:s')
            ]);            

            Session::flash('success', 'Dokumen Berhasil Ditambahkan.');
            return redirect()->route('pubPrims');
        }else{
            $no_img = 'no_image.png';
            DB::table('cms_pubprims')->insert([
                'img'          => 'assets/compro/assets/frontend_assets/images/pub_prims/'.$no_img,
                'doc'               => 'assets/compro/assets/frontend_assets/doc/pub_prims/'.$nameDoc,
                'title_in'               => $request->title_in,
                'title_en'               => $request->title_en,
                'text_in'               => $request->text_in,
                'text_en'               => $request->text_en,
                'rowstate'          => $request->rowstate,
                'created_at'        => date('Y-m-d H:i:s')
            ]);

            Session::flash('success', 'Dokumen Berhasil Ditambahkan.');
            return redirect()->route('pubPrims');            
        }
    }

    public function edit($id){

        $post = DB::table('cms_pubprims')
        ->where('id', $id)
        ->first();

        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();

        return view('pages.cms_compro.pubPrims.edit')->with('post', $post)->with('setting', $setting);
    }

    public function update(Request $request, $id){
        // print_r($_POST);

        // $pathDoc = 'assets/compro/assets/frontend_assets/doc/pub_prims/';
        // $nameDoc = time().'_pubPrims_'.$request->file('doc')->getClientOriginalName();
        // $request->file('doc')->move($pathDoc,$nameDoc);



        // die();      

        $this->validate($request, [
            'title_en'    => 'required',
            'title_in'    => 'required',
            'text_in'    => 'required',
            'text_en'    => 'required',
            'rowstate'       => 'required',
        ]);


        if( $request->file('doc') ){

            $pathDoc = 'assets/compro/assets/frontend_assets/doc/pub_prims/';
            $nameDoc = time().'_pubPrims_'.$request->file('doc')->getClientOriginalName();
            $request->file('doc')->move($pathDoc,$nameDoc);

            if($request->get('image-data')){
                $name = time().'_pubPrims.png';

                $image_data = $request->get('image-data');
                $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image_data));
                $img = Image::make($info);
                $img->save('assets/compro/assets/frontend_assets/images/pub_prims/'.$name);

                DB::table('cms_pubprims')->where('id', $id)->update([
                    'img'          => 'assets/compro/assets/frontend_assets/images/pub_prims/'.$name,
                    'doc'               => 'assets/compro/assets/frontend_assets/doc/pub_prims/'.$nameDoc,
                    'title_in'               => $request->title_in,
                    'title_en'               => $request->title_en,
                    'text_in'               => $request->text_in,
                    'text_en'               => $request->text_en,                
                    'rowstate'          => $request->rowstate,
                    'updated_at'        => date('Y-m-d H:i:s')
                ]);

                Session::flash('success', 'Dokumen Berhasil di update Ditambahkan.');
                return redirect()->route('pubPrims');
            }else{
                DB::table('cms_pubprims')->where('id', $id)->update([                
                    'doc'               => 'assets/compro/assets/frontend_assets/doc/pub_prims/'.$nameDoc,
                    'title_in'               => $request->title_in,
                    'title_en'               => $request->title_en,
                    'text_in'               => $request->text_in,
                    'text_en'               => $request->text_en,
                    'rowstate'          => $request->rowstate,
                    'updated_at'        => date('Y-m-d H:i:s')
                ]);
                Session::flash('success', 'Dokumen Berhasil di update Ditambahkan.');
                return redirect()->route('pubPrims');            
            }

        }else{

            if($request->get('image-data')){
                $name = time().'_pubPrims.png';

                $image_data = $request->get('image-data');
                $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image_data));
                $img = Image::make($info);
                $img->save('assets/compro/assets/frontend_assets/images/pub_prims/'.$name);

                DB::table('cms_pubprims')->where('id', $id)->update([
                    'img'          => 'assets/compro/assets/frontend_assets/images/pub_prims/'.$name,
                    'title_in'               => $request->title_in,
                    'title_en'               => $request->title_en,
                    'text_in'               => $request->text_in,
                    'text_en'               => $request->text_en,                
                    'rowstate'          => $request->rowstate,
                    'updated_at'        => date('Y-m-d H:i:s')
                ]);

                Session::flash('success', 'Dokumen Berhasil di update Ditambahkan.');
                return redirect()->route('pubPrims');
            }else{
                DB::table('cms_pubprims')->where('id', $id)->update([                
                    //'img'          => 'assets/compro/assets/frontend_assets/images/pub_prims/'.$no_img,
                    'title_in'               => $request->title_in,
                    'title_en'               => $request->title_en,
                    'text_in'               => $request->text_in,
                    'text_en'               => $request->text_en,
                    'rowstate'          => $request->rowstate,
                    'updated_at'        => date('Y-m-d H:i:s')
                ]);
                Session::flash('success', 'Dokumen Berhasil di update Ditambahkan.');
                return redirect()->route('pubPrims');            
            }
        }    

        Session::flash('success', 'Something Wrong.');
        return redirect()->route('pubPrims');
    }

    public function delete($id){
        DB::table('cms_pubprims')->where('id', $id)->delete();
        Session::flash('success', 'Dokumen Berhasil Dihapus');
        return redirect()->back();
    }
}
