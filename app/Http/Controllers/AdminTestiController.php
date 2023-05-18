<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
Use Session;
use Auth;
use App\User;
use App\CmsTesti;
use Hash;
use Image;

class AdminTestiController extends Controller{

    public function index(){
        // return view('pages.admin.inbox.index')->with('inbox', $inbox);
        $post = DB::table('cms_testi')
        ->orderBy('id', 'ASC')
        ->get();
        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();  
        return view('pages.cms_compro.testi.index')->with('posts', $post)->with('setting', $setting);
    }

    public function add(){
        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();       
        return view('pages.cms_compro.testi.add')->with('setting', $setting);
    }

    public function store(Request $request){

        $this->validate($request, [
            'title_in'          => 'required',
            'title_en'          => 'required',
            'name'       => 'required',
            'text_in'          => 'required',
            'text_en'            => 'required',
            'position_in'             => 'required',
            'position_en'             => 'required',
            'rowstate'       => 'required'
        ]);

        if($request->get('image-data')){
            $name = time().'_testi.png';

            $image_data = $request->get('image-data');
            $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image_data));
            $img = Image::make($info);
            $img->save('assets/compro/assets/frontend_assets/images/img_testi/'.$name);

            $post = CmsTesti::create([
                'img'          => 'assets/compro/assets/frontend_assets/images/img_testi/'.$name,
                'title_in'          => $request->title_in,
                'title_en'          => $request->title_en,
                'name'        => $request->name,
                'text_in'        => $request->text_in,
                'text_en'     => $request->text_en,
                'position_in'        => $request->position_in,
                'position_en'     => $request->position_en,                
                'rowstate'          => $request->rowstate,
                'created_at'        => date('Y-m-d')
            ]);

            Session::flash('success', 'Testimoni Berhasil Ditambahkan.');
            return redirect()->route('testi');
        }else{
            $post = CmsTesti::create([
                'img'          => 'assets/compro/assets/frontend_assets/images/img_testi/default.png',
                'title_in'          => $request->title_in,
                'title_en'          => $request->title_en,
                'name'        => $request->name,
                'text_in'        => $request->text_in,
                'text_en'     => $request->text_en,
                'position_in'        => $request->position_in,
                'position_en'     => $request->position_en,                 
                'rowstate'          => $request->rowstate,
                'created_at'        => date('Y-m-d')
            ]);

            Session::flash('success', 'Testimoni Berhasil Ditambahkan.');
            return redirect()->route('testi');
        }
        
        Session::flash('success', 'Something wrong.');
        return redirect()->route('testi');
    }

    public function edit($id){
        $post = DB::table('cms_testi')
        ->where('id', $id)
        ->first();
        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();  
        return view('pages.cms_compro.testi.edit')->with('post', $post)->with('setting', $setting);
    }

    public function update(Request $request, $id){

        $this->validate($request, [
            'title_in'          => 'required',
            'title_en'          => 'required',
            'name'       => 'required',
            'text_in'          => 'required',
            'text_en'            => 'required',
            'position_in'             => 'required',
            'position_en'             => 'required',
            'rowstate'       => 'required'
        ]);

        if($request->get('image-data')){
            $name = time().'_testi.png';

            $image_data = $request->get('image-data');
            $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image_data));
            $img = Image::make($info);
            $img->save('assets/compro/assets/frontend_assets/images/img_testi/'.$name);

            DB::table('cms_testi')->where('id', $id)->update([                
                'img'          => 'assets/compro/assets/frontend_assets/images/img_testi/'.$name,
                'title_in'          => $request->title_in,
                'title_en'          => $request->title_en,
                'name'        => $request->name,
                'text_in'        => $request->text_in,
                'text_en'     => $request->text_en,
                'position_in'        => $request->position_in,
                'position_en'     => $request->position_en,                 
                'rowstate'          => $request->rowstate,
                'updated_at'        => date('Y-m-d')
            ]);

            Session::flash('success', 'Testimoni Berhasil Ditambahkan.');
            return redirect()->route('article');
        }else{

            DB::table('cms_testi')->where('id', $id)->update([
                'title_in'          => $request->title_in,
                'title_en'          => $request->title_en,
                'name'        => $request->name,
                'text_in'        => $request->text_in,
                'text_en'     => $request->text_en,
                'position_in'        => $request->position_in,
                'position_en'     => $request->position_en,                 
                'rowstate'          => $request->rowstate,
                'updated_at'        => date('Y-m-d')
            ]);

            Session::flash('success', 'Testimoni Berhasil Ditambahkan.');
            return redirect()->route('testi');            
        }
        Session::flash('success', 'Testimoni Berhasil Diupdate.');
        return redirect()->route('testi');
    }

    public function delete($id){
        $post = CmsTesti::find($id);
        $post->delete();

        Session::flash('success', 'Testimoni Berhasil Dihapus');
        return redirect()->back();
    }
}
