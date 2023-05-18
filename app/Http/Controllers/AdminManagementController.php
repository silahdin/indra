<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
Use Session;
use Auth;
use App\User;
use App\CmsManagement;
use Hash;
use Image;


class AdminManagementController extends Controller{

    public function index(){
        // return view('pages.admin.inbox.index')->with('inbox', $inbox);
        $post = DB::table('cms_management')
        ->orderBy('id', 'ASC')
        ->get();
        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();  
        return view('pages.cms_compro.management.index')->with('posts', $post)->with('setting', $setting);
    }

    public function add(){

        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();  
        return view('pages.cms_compro.management.add')->with('setting', $setting);
    }

    public function store(Request $request){
        // print_r($_POST);
        // die();   
      
        $this->validate($request, [
            'title_in'    => 'required',
            'title_en'    => 'required',
            'description_in'    => 'required',
            'description_en'    => 'required',
            'content_in'    => 'required',
            'content_en'    => 'required',            
            'rowstate'       => 'required',
        ]);

        
        if( $request->get('image-data') && $request->get('image-data1') ){

            $name = time().'_management.png';
            $image_data = $request->get('image-data');
            $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image_data));
            $img = Image::make($info);
            $img->save('assets/compro/assets/frontend_assets/images/img_management/'.$name);

            $name1 = time().'_management.png';
            $image_data1 = $request->get('image-data1');
            $info1 = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image_data1));
            $img1 = Image::make($info1);
            $img1->save('assets/compro/assets/frontend_assets/images/img_management/'.$name1);

            $post = CmsManagement::create([
                'img_icon'                => 'assets/compro/assets/frontend_assets/images/img_management/'.$name,
                'img_icon_hover'          => 'assets/compro/assets/frontend_assets/images/img_management/'.$name1,
                'title_in'               => $request->title_in,
                'title_en'               => $request->title_en,              
                'description_in'               => $request->description_in,
                'description_en'               => $request->description_en, 
                'content_in'               => $request->content_in,
                'content_en'               => $request->content_en,                                             
                'rowstate'          => $request->rowstate,
                'created_at'        => date('Y-m-d H:i:s')
            ]);

            Session::flash('success', 'management Berhasil Ditambahkan.');
            return redirect()->route('management');

        }else if( $request->get('image-data1') ){
            $name = time().'_management.png';
            $image_data = $request->get('image-data1');
            $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image_data));
            $img = Image::make($info);
            $img->save('assets/compro/assets/frontend_assets/images/img_management/'.$name);

            $post = CmsManagement::create([
                'img_icon'          => 'assets/compro/assets/frontend_assets/images/img_management/default-image.jpg',
                'img_icon_hover'          => 'assets/compro/assets/frontend_assets/images/img_management/'.$name,
                'title_in'               => $request->title_in,
                'title_en'               => $request->title_en,                
                'description_in'               => $request->description_in,
                'description_en'               => $request->description_en, 
                'content_in'               => $request->content_in,
                'content_en'               => $request->content_en,                                                             
                'rowstate'          => $request->rowstate,
                'created_at'        => date('Y-m-d H:i:s')
            ]);

            Session::flash('success', 'management Berhasil Ditambahkan.');
            return redirect()->route('management');

        }else if( $request->get('image-data') ){

            $name = time().'_management.png';
            $image_data = $request->get('image-data1');
            $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image_data));
            $img = Image::make($info);
            $img->save('assets/compro/assets/frontend_assets/images/img_management/'.$name);

            $post = CmsManagement::create([
                'img_icon'          => 'assets/compro/assets/frontend_assets/images/img_management/'.$name,
                'img_icon_hover'          => 'assets/compro/assets/frontend_assets/images/img_management/default-image.jpg',
                'title_in'               => $request->title_in,
                'title_en'               => $request->title_en,         
                'description_in'               => $request->description_in,
                'description_en'               => $request->description_en,   
                'content_in'               => $request->content_in,
                'content_en'               => $request->content_en,                                                           
                'rowstate'          => $request->rowstate,
                'created_at'        => date('Y-m-d H:i:s')
            ]);

            Session::flash('success', 'management Berhasil Ditambahkan.');
            return redirect()->route('management');


        }else{

            $name = 'default-image.jpg';
            $name1 = 'default-image.jpg';

            $post = CmsManagement::create([
                'img_icon'          => 'assets/compro/assets/frontend_assets/images/img_management/'.$name,
                'img_icon_hover'    => 'assets/compro/assets/frontend_assets/images/img_management/'.$name1,
                'title_in'               => $request->title_in,
                'title_en'               => $request->title_en,        
                'description_in'               => $request->description_in,
                'description_en'               => $request->description_en,  
                'content_in'               => $request->content_in,
                'content_en'               => $request->content_en,                                                            
                'rowstate'          => $request->rowstate,
                'created_at'        => date('Y-m-d H:i:s')
            ]);

            Session::flash('success', 'management Berhasil Ditambahkan.');
            return redirect()->route('management');         

        }
        
    }

    public function edit($id){

        $post = DB::table('cms_management')
        ->where('id', $id)
        ->first();
        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();  
        return view('pages.cms_compro.management.edit')->with('post', $post)->with('setting', $setting);
    }

    public function update(Request $request, $id){
        // print_r($_POST);
        // die();      
        
        $this->validate($request, [
            'title_in'    => 'required',
            'title_en'    => 'required',
            'description_in'    => 'required',
            'description_en'    => 'required',
            'content_in'    => 'required',
            'content_en'    => 'required',            
            'rowstate'       => 'required',
        ]);

        if( $request->get('image-data') && $request->get('image-data1') ){

            $name = time().'_management.png';
            $name1 = time().'_management.png';

            $image_data = $request->get('image-data');
            $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image_data));
            $img = Image::make($info);
            $img->save('assets/compro/assets/frontend_assets/images/img_management/'.$name);

            $image_data1 = $request->get('image-data1');
            $info1 = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image_data1));
            $img1 = Image::make($info1);
            $img1->save('assets/compro/assets/frontend_assets/images/img_management/'.$name1);            

            DB::table('cms_management')->where('id', $id)->update([
                'img_icon'              => 'assets/compro/assets/frontend_assets/images/img_management/'.$name,
                'img_icon_hover'         => 'assets/compro/assets/frontend_assets/images/img_management/'.$name1,
                'title_in'               => $request->title_in,
                'title_en'               => $request->title_en,            
                'description_in'         => $request->description_in,
                'description_en'         => $request->description_en,    
                'content_in'               => $request->content_in,
                'content_en'               => $request->content_en,                                                          
                'rowstate'          => $request->rowstate,
                'updated_at'        => date('Y-m-d H:i:s')
            ]);

            Session::flash('success', 'management Berhasil di update Ditambahkan.');
            return redirect()->route('management');

        }else if( $request->get('image-data') ){

            $name = time().'_management.png';

            $image_data = $request->get('image-data');
            $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image_data));
            $img = Image::make($info);
            $img->save('assets/compro/assets/frontend_assets/images/img_management/'.$name);        

            DB::table('cms_management')->where('id', $id)->update([
                'img_icon'              => 'assets/compro/assets/frontend_assets/images/img_management/'.$name,
                'title_in'               => $request->title_in,
                'title_en'               => $request->title_en,            
                'description_in'         => $request->description_in,
                'description_en'         => $request->description_en,    
                'content_in'               => $request->content_in,
                'content_en'               => $request->content_en,                                                          
                'rowstate'          => $request->rowstate,
                'updated_at'        => date('Y-m-d H:i:s')
            ]);

            Session::flash('success', 'management Berhasil di update Ditambahkan.');
            return redirect()->route('management');
            
        }else if( $request->get('image-data1') ){

            $name = time().'_management.png';

            $image_data = $request->get('image-data1');
            $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image_data));
            $img = Image::make($info);
            $img->save('assets/compro/assets/frontend_assets/images/img_management/'.$name);        

            DB::table('cms_management')->where('id', $id)->update([
                'img_icon_hover'              => 'assets/compro/assets/frontend_assets/images/img_management/'.$name,
                'title_in'               => $request->title_in,
                'title_en'               => $request->title_en,            
                'description_in'         => $request->description_in,
                'description_en'         => $request->description_en,  
                'content_in'               => $request->content_in,
                'content_en'               => $request->content_en,                                                            
                'rowstate'          => $request->rowstate,
                'updated_at'        => date('Y-m-d H:i:s')
            ]);

            Session::flash('success', 'management Berhasil di update Ditambahkan.');
            return redirect()->route('management');
            
        }else{
            DB::table('cms_management')->where('id', $id)->update([       
                'title_in'              => $request->title_in,
                'title_en'               => $request->title_en,            
                'description_in'         => $request->description_in,
                'description_en'         => $request->description_en,   
                'content_in'               => $request->content_in,
                'content_en'               => $request->content_en,                                                           
                'rowstate'          => $request->rowstate,
                'updated_at'        => date('Y-m-d H:i:s')
            ]);
            Session::flash('success', 'management Berhasil di update Ditambahkan.');
            return redirect()->route('management');            
        }

        Session::flash('success', 'Something Wrong.');
        return redirect()->route('management');
    }

    public function delete($id){
        $post = CmsManagement::find($id);
        $post->delete();

        Session::flash('success', 'management Berhasil Dihapus');
        return redirect()->back();
    }

}
