<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
Use Session;
use Auth;
use App\User;
use App\CmsProjects;
use Hash;
use Image;


class AdminProjectsController extends Controller{

    public function index(){
        // return view('pages.admin.inbox.index')->with('inbox', $inbox);
        $post = DB::table('cms_projects')
        ->orderBy('id', 'ASC')
        ->get();
        
        return view('pages.cms_compro.projects.index')->with('posts', $post);
    }

    public function add(){
        $post = DB::table('cms_province')
        ->get();        
        return view('pages.cms_compro.projects.add')->with('kotas',$post);
    }

    public function store(Request $request){
        // print_r($_POST);
        // die();   
      
        $this->validate($request, [
            'image-data'    => 'required',
            'text_in'    => 'required',
            'text_en'    => 'required',            
            'url'       => 'required',
            'rowstate'       => 'required',
        ]);


        if($request->get('image-data')){
            $name = time().'_project.png';

            $image_data = $request->get('image-data');
            $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image_data));
            $img = Image::make($info);
            $img->save('assets/compro/assets/frontend_assets/img_projects/'.$name);

            $post = CmsProjects::create([
                'img'          => 'assets/compro/assets/frontend_assets/img_projects/'.$name,
                'text_in'               => $request->text_in,
                'text_en'               => $request->text_en,                
                'url'               => $request->url,                
                'rowstate'          => $request->rowstate,
                'created_at'        => date('Y-m-d H:i:s')
            ]);

            Session::flash('success', 'Project Berhasil Ditambahkan.');
            return redirect()->route('projects');
        }else{

            Session::flash('success', 'Project Gagal Ditambahkan.');
            return redirect()->route('projects');            
        }
    }

    public function edit($id){

        $post = DB::table('cms_projects')
        ->where('id', $id)
        ->first();
        
        return view('pages.cms_compro.projects.edit')->with('post', $post);
    }

    public function update(Request $request, $id){
        // print_r($_POST);
        // die();      
        
        $this->validate($request, [
            'text_in'    => 'required',
            'text_en'    => 'required',            
            'url'       => 'required',
            'rowstate'       => 'required',
        ]);

        if($request->get('image-data')){
            $name = time().'_partner.png';

            $image_data = $request->get('image-data');
            $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image_data));
            $img = Image::make($info);
            $img->save('assets/compro/assets/frontend_assets/img_projects/'.$name);

            DB::table('cms_projects')->where('id', $id)->update([
                'img'          => 'assets/compro/assets/frontend_assets/img_projects/'.$name,
                'text_in'               => $request->text_in,
                'text_en'               => $request->text_en,                
                'url'               => $request->url,                
                'rowstate'          => $request->rowstate,
                'created_at'        => date('Y-m-d H:i:s')
            ]);

            Session::flash('success', 'Project Berhasil di update Ditambahkan.');
            return redirect()->route('projects');
        }else{
            DB::table('cms_projects')->where('id', $id)->update([                
                'text_in'               => $request->text_in,
                'text_en'               => $request->text_en,                
                'url'               => $request->url,                
                'rowstate'          => $request->rowstate,
                'created_at'        => date('Y-m-d H:i:s')
            ]);
            Session::flash('success', 'Project Berhasil di update Ditambahkan.');
            return redirect()->route('projects');            
        }

        Session::flash('success', 'Something Wrong.');
        return redirect()->route('projects');
    }

    public function delete($id){
        $post = CmsProjects::find($id);
        $post->delete();

        Session::flash('success', 'Project Berhasil Dihapus');
        return redirect()->back();
    }
}
