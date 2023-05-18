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


class AdminLandingSliderController extends Controller{

    public function index(){
        // return view('pages.admin.inbox.index')->with('inbox', $inbox);
        $post = DB::table('new_cms_landing_sliders')
        ->orderBy('id', 'ASC')
        ->get();
        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();  

        return view('pages.cms_compro.landing_slider.index')->with('posts', $post)->with('setting', $setting);
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
        return view('pages.cms_compro.landing_slider.add')->with('setting', $setting);
    }

    public function store(Request $request){ 

        if($request->hasFile('file')){
            
            // $image_data = $request->get('image-data');
            // $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image_data));
            // $img = Image::make($info);
            // $img->save('assets/compro/assets/frontend_assets/images/landing_slider/'.$name);
            
            $file = $request->file('file');

            $name = time().'_landingSlider.'.$file->getClientOriginalExtension();
            $destinationPath = 'assets/compro/assets/frontend_assets/images/landing_slider';
            $file->move($destinationPath, $name);


            DB::table('new_cms_landing_sliders')->insert([
                'image_url'               => $destinationPath.'/'.$name,
                'title'            => $request->title,
                'sub_title'            => $request->sub_title,
                'brief'            => $request->brief,
                'link_text'            => $request->link_text,
                'link_url'            => $request->link_url,
                'link_open'            => $request->link_open,
                'status'            => $request->status,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ]);

            Session::flash('success', 'Slider Berhasil Ditambahkan.');
            return redirect()->route('landing.slider');          
        }else{

            DB::table('new_cms_landing_sliders')->insert([
                'title'            => $request->title,
                'sub_title'            => $request->sub_title,
                'brief'            => $request->brief,
                'link_text'            => $request->link_text,
                'link_url'            => $request->link_url,
                'link_open'            => $request->link_open,
                'status'            => $request->status,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ]);            

            Session::flash('success', 'Slider Successfully Updated.');
            return redirect()->route('landing.slider');          
        }            
    }

    public function edit($id){
        $post = DB::table('new_cms_landing_sliders')
        ->where('id', $id)
        ->first();
        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();  
        return view('pages.cms_compro.landing_slider.edit')->with('post', $post)->with('setting', $setting);
    }


    public function update(Request $request, $id){
      
        if($request->hasFile('file')){
            
            // $image_data = $request->get('image-data');
            // $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image_data));
            // $img = Image::make($info);
            // $img->save('assets/compro/assets/frontend_assets/images/landing_slider/'.$name);
            
            $file = $request->file('file');

            $name = time().'_landingSlider.'.$file->getClientOriginalExtension();
            $destinationPath = 'assets/compro/assets/frontend_assets/images/landing_slider';
            $file->move($destinationPath, $name);


            DB::table('new_cms_landing_sliders')->where('id', $id)->update([
                'image_url'               => $destinationPath.'/'.$name,
                'title'            => $request->title,
                'sub_title'            => $request->sub_title,
                'brief'            => $request->brief,
                'link_text'            => $request->link_text,
                'link_url'            => $request->link_url,
                'link_open'            => $request->link_open,
                'status'            => $request->status,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ]);

            Session::flash('success', 'Slider Berhasil Ditambahkan.');
            return redirect()->route('landing.slider');          
        }else{

            DB::table('new_cms_landing_sliders')->where('id', $id)->update([
                'title'            => $request->title,
                'sub_title'            => $request->sub_title,
                'brief'            => $request->brief,
                'link_text'            => $request->link_text,
                'link_url'            => $request->link_url,
                'link_open'            => $request->link_open,
                'status'            => $request->status,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ]);            

            Session::flash('success', 'Slider Successfully Updated.');
            return redirect()->route('landing.slider');          
        }   

    }

    public function delete($id){
        $post = DB::table('new_cms_landing_sliders')->where('id', $id)->delete();

        Session::flash('success', 'Slider Successfully Deleted');
        return redirect()->back();
    }


    public function imageIndex(){
        $post = DB::table('new_cms_landing_images')->first();

        // if(!$post)

        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();

        return view('pages.cms_compro.landing_slider.image')->with('post', $post)->with('setting', $setting);
    }

    public function imagePost(Request $request){
        $post = DB::table('new_cms_landing_images')->first();

        if($request->hasFile('file')){

            // $name = time().'_landingImage.png';
            // $image_data = $request->get('image-data');
            // $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image_data));
            // $img = Image::make($info);
            // $img->save('assets/compro/assets/frontend_assets/images/landing_image/'.$name);

            $file = $request->file('file');

            $name = time().'_landingImage.'.$file->getClientOriginalExtension();
            $destinationPath = 'assets/compro/assets/frontend_assets/images/landing_image';
            $file->move($destinationPath, $name);

            if($post){
                DB::table('new_cms_landing_images')->where('id', $post->id)->update(['image_url' => $destinationPath.'/'.$name]);    
            }else{
                DB::table('new_cms_landing_images')->insert([
                    'image_url' => $destinationPath.'/'.$name,
                    'created_at'    => Carbon::now(),
                    'updated_at'    => Carbon::now(),
                ]);
            }

        }

        return redirect()->route('landing.image');
    }
}
