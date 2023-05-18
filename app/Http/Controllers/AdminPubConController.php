<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
Use Session;
use Auth;
use App\User;
use Hash;
use Image;


class AdminPubConController extends Controller{

    public function index(){
        // return view('pages.admin.inbox.index')->with('inbox', $inbox);
        $post = DB::table('cms_pubcon')
        ->orderBy('id', 'ASC')
        ->get();

        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();  
        return view('pages.cms_compro.pubCon.index')->with('posts', $post)->with('setting', $setting);
    }

    public function add(){
        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();

        return view('pages.cms_compro.pubCon.add')->with('setting', $setting);
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

        $pathDoc = 'assets/compro/assets/frontend_assets/doc/pub_con/';
        $nameDoc = time().'_pubCon_'.$request->file('doc')->getClientOriginalName();
        $request->file('doc')->move($pathDoc,$nameDoc);


        if($request->get('image-data')){
            $name = time().'_pubCon.png';

            $image_data = $request->get('image-data');
            $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image_data));
            $img = Image::make($info);
            $img->save('assets/compro/assets/frontend_assets/images/pub_con/'.$name);

            DB::table('cms_pubcon')->insert([
                'img'          => 'assets/compro/assets/frontend_assets/images/pub_con/'.$name,
                'doc'               => 'assets/compro/assets/frontend_assets/doc/pub_con/'.$nameDoc,
                'title_in'               => $request->title_in,
                'title_en'               => $request->title_en,
                'text_in'               => $request->text_in,
                'text_en'               => $request->text_en,                
                // 'url'               => $request->url,           
                'rowstate'          => $request->rowstate,
                'created_at'        => date('Y-m-d H:i:s')
            ]);            

            Session::flash('success', 'Dokumen Berhasil Ditambahkan.');
            return redirect()->route('pubCon');
        }else{
            $no_img = 'no_image.png';
            DB::table('cms_pubcon')->insert([
                'img'          => 'assets/compro/assets/frontend_assets/images/pub_con/'.$no_img,
                'doc'               => 'assets/compro/assets/frontend_assets/doc/pub_con/'.$nameDoc,
                'title_in'               => $request->title_in,
                'title_en'               => $request->title_en,
                'text_in'               => $request->text_in,
                'text_en'               => $request->text_en,
                'rowstate'          => $request->rowstate,
                'created_at'        => date('Y-m-d H:i:s')
            ]);               

            Session::flash('success', 'Dokumen Berhasil Ditambahkan.');
            return redirect()->route('pubCon');            
        }
    }

    public function edit($id){

        $post = DB::table('cms_pubcon')
        ->where('id', $id)
        ->first();

        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();

        return view('pages.cms_compro.pubCon.edit')->with('post', $post)->with('setting', $setting);
    }

    public function update(Request $request, $id){
        // print_r($_POST);

        // $pathDoc = 'assets/compro/assets/frontend_assets/doc/pub_con/';
        // $nameDoc = time().'_pubCon_'.$request->file('doc')->getClientOriginalName();
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
            // echo 'a';

            $pathDoc = 'assets/compro/assets/frontend_assets/doc/pub_con/';
            $nameDoc = time().'_pubCon_'.$request->file('doc')->getClientOriginalName();
            $request->file('doc')->move($pathDoc,$nameDoc);

            if($request->get('image-data')){
                $name = time().'_pubCon.png';

                $image_data = $request->get('image-data');
                $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image_data));
                $img = Image::make($info);
                $img->save('assets/compro/assets/frontend_assets/images/pub_con/'.$name);

                DB::table('cms_pubcon')->where('id', $id)->update([
                    'img'          => 'assets/compro/assets/frontend_assets/images/pub_con/'.$name,
                    'doc'               => 'assets/compro/assets/frontend_assets/doc/pub_con/'.$nameDoc,
                    'title_in'               => $request->title_in,
                    'title_en'               => $request->title_en,
                    'text_in'               => $request->text_in,
                    'text_en'               => $request->text_en,                
                    'rowstate'          => $request->rowstate,
                    'updated_at'        => date('Y-m-d H:i:s')
                ]);

                Session::flash('success', 'Dokumen Berhasil di update Ditambahkan.');
                return redirect()->route('pubCon');
            }else{
                DB::table('cms_pubcon')->where('id', $id)->update([                
                    //'img'          => 'assets/compro/assets/frontend_assets/images/pub_con/'.$no_img,
                    'doc'               => 'assets/compro/assets/frontend_assets/doc/pub_con/'.$nameDoc,
                    'title_in'               => $request->title_in,
                    'title_en'               => $request->title_en,
                    'text_in'               => $request->text_in,
                    'text_en'               => $request->text_en,
                    'rowstate'          => $request->rowstate,
                    'updated_at'        => date('Y-m-d H:i:s')
                ]);
                Session::flash('success', 'Dokumen Berhasil di update Ditambahkan.');
                return redirect()->route('pubCon');            
            }

        }else{

            if($request->get('image-data')){
                $name = time().'_pubCon.png';

                $image_data = $request->get('image-data');
                $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image_data));
                $img = Image::make($info);
                $img->save('assets/compro/assets/frontend_assets/images/pub_con/'.$name);

                DB::table('cms_pubcon')->where('id', $id)->update([
                    'img'          => 'assets/compro/assets/frontend_assets/images/pub_con/'.$name,
                    'title_in'               => $request->title_in,
                    'title_en'               => $request->title_en,
                    'text_in'               => $request->text_in,
                    'text_en'               => $request->text_en,                
                    'rowstate'          => $request->rowstate,
                    'updated_at'        => date('Y-m-d H:i:s')
                ]);

                Session::flash('success', 'Dokumen Berhasil di update Ditambahkan.');
                return redirect()->route('pubCon');
            }else{
                DB::table('cms_pubcon')->where('id', $id)->update([                
                    //'img'          => 'assets/compro/assets/frontend_assets/images/pub_con/'.$no_img,
                    'title_in'               => $request->title_in,
                    'title_en'               => $request->title_en,
                    'text_in'               => $request->text_in,
                    'text_en'               => $request->text_en,
                    'rowstate'          => $request->rowstate,
                    'updated_at'        => date('Y-m-d H:i:s')
                ]);
                Session::flash('success', 'Dokumen Berhasil di update Ditambahkan.');
                return redirect()->route('pubCon');            
            }
        }        
        Session::flash('success', 'Something Wrong.');
        return redirect()->route('pubCon');
    }

    public function delete($id){
        DB::table('cms_pubcon')->where('id', $id)->delete();
        Session::flash('success', 'Dokumen Berhasil Dihapus');
        return redirect()->back();
    }
}
