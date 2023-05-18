<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Carbon\Carbon;
use DB;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Image;


class AdminFollowController extends Controller{

    public function index(){
        // return view('pages.admin.inbox.index')->with('inbox', $inbox);
        $post = DB::table('new_cms_follows')
        ->orderBy('id', 'ASC')
        ->get();

        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();  

        return view('pages.cms_compro.follow.index')->with('posts', $post)->with('setting', $setting);
    }

    public function data(CmsCareerFilters $filters)
    {
        return CmsCareer::filter($filters)->get();
    }

    public function add(){
        // $post = DB::table('cms_province')
        // ->get();    
        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();       
        return view('pages.cms_compro.follow.add')->with('setting', $setting);
    }

    public function store(Request $request){

        if($request->get('image-data')){
            $name = time().'_follow.png';
            $image_data = $request->get('image-data');
            $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image_data));
            $img = Image::make($info);
            $img->save('assets/compro/assets/frontend_assets/images/follow/'.$name);
            // $post = CmsCareer::create([
            DB::table('new_cms_follows')->insert([
                'icon'               => 'assets/compro/assets/frontend_assets/images/follow/'.$name,
                'textline'            => $request->textline,
                'link'            => $request->link,
                'link_open'            => $request->link_open,
                'status'            => $request->status,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ]);

            Session::flash('success', 'Follows Berhasil Ditambahkan.');
            return redirect()->route('follow');          
        }else{
            // die('gak ada');
            $no_img = 'missing.png';

            DB::table('new_cms_follows')->insert([
                // 'icon'                 => 'assets/compro/assets/frontend_assets/images/'.$no_img,
                'textline'            => $request->textline,
                'link'            => $request->link,
                'link_open'            => $request->link_open,
                'status'            => $request->status,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ]);            

            Session::flash('success', 'Follows Successfully Updated.');
            return redirect()->route('follow');          
        }         
    }

    public function edit($id){
        $post = DB::table('new_cms_follows')
        ->where('id', $id)
        ->first();
        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();  
        return view('pages.cms_compro.follow.edit')->with('post', $post)->with('setting', $setting);
    }


    public function update(Request $request, $id){
      
        if($request->get('image-data')){
            $name = time().'_follow.png';
            $image_data = $request->get('image-data');
            $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image_data));
            $img = Image::make($info);
            $img->save('assets/compro/assets/frontend_assets/images/follow/'.$name);
            // $post = CmsCareer::create([
            DB::table('new_cms_follows')->where('id', $id)->update([
                'icon'               => 'assets/compro/assets/frontend_assets/images/follow/'.$name,
                'textline'            => $request->textline,
                'link'            => $request->link,
                'link_open'            => $request->link_open,
                'status'            => $request->status,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ]);

            Session::flash('success', 'Follows Berhasil Ditambahkan.');
            return redirect()->route('follow');          
        }else{
            // die('gak ada');
            $no_img = 'missing.png';

            DB::table('new_cms_follows')->where('id', $id)->update([
                // 'icon'                 => 'assets/compro/assets/frontend_assets/images/'.$no_img,
                'textline'            => $request->textline,
                'link'            => $request->link,
                'link_open'            => $request->link_open,
                'status'            => $request->status,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ]);            

            Session::flash('success', 'Follows Successfully Updated.');
            return redirect()->route('follow');          
        }         

    }

    public function delete($id){
        $post = DB::table('new_cms_follows')->where('id', $id)->delete();

        Session::flash('success', 'Follows Successfully Deleted');
        return redirect()->back();
    }
}
