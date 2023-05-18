<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
Use Session;
use Auth;
use App\User;
use App\CmsSlider;
use Hash;

class AdminSliderController extends Controller{

    public function index(){
        $post = DB::table('cms_slider')
        ->orderBy('id', 'DESC')
        ->get();
        
        return view('pages.cms_compro.slider.index')->with('posts', $post);
    }

    public function add(){
        $cat = DB::table('cms_categories')
        ->where('rowstate', 1)        
        ->get();

        return view('pages.cms_compro.slider.add')->with('cat',$cat);
    }

    public function store(Request $request){

        $this->validate($request, [
            'background'     => 'required',
            'rowstate'       => 'required'
        ]);


        // echo "<pre>";
        // print_r($_POST);
        // echo "</pre>";
        // die();
        // die('ada');


        $featured_new = NULL;
        $featured_new_left = NULL; 
        $featured_new_middle = NULL; 
        $featured_new_line = NULL; 
        $featured_new_right = NULL;

       if( $request->hasFile('img_left')){ 
            $featuredLeft = $request->img_left;
            $featured_new_left = time()."_".$featuredLeft->getClientOriginalName();
            $featuredLeft->move('assets/compro/assets/frontend_assets/slider/img/', $featured_new_left);
            $featured_new_left = 'assets/compro/assets/frontend_assets/slider/img/'.$featured_new_left;              
        }

       if( $request->hasFile('img_middle')){     
            $featuredMiddle = $request->img_middle;
            $featured_new_middle = time()."_".$featuredMiddle->getClientOriginalName();
            $featuredMiddle->move('assets/compro/assets/frontend_assets/slider/img/', $featured_new_middle);
            $featured_new_middle = 'assets/compro/assets/frontend_assets/slider/img/'.$featured_new_middle;                       
        }

       if( $request->hasFile('img_line')){     
            $featuredLine = $request->img_line;
            $featured_new_line = time()."_".$featuredLine->getClientOriginalName();
            $featuredLine->move('assets/compro/assets/frontend_assets/slider/img/', $featured_new_line);
            $featured_new_line = 'assets/compro/assets/frontend_assets/slider/img/'.$featured_new_line;                            
        }

       if( $request->hasFile('img_right')){     
            $featuredRight = $request->img_right;
            $featured_new_right = time()."_".$featuredRight->getClientOriginalName();
            $featuredRight->move('assets/compro/assets/frontend_assets/slider/img/', $featured_new_right);
            $featured_new_right = 'assets/compro/assets/frontend_assets/slider/img/'.$featured_new_right;

        }

        if( $request->hasFile('background') ){
            $featured = $request->background;
            $featured_new = time()."_".$featured->getClientOriginalName();
            $featured->move('assets/compro/assets/frontend_assets/slider/img/', $featured_new);
            $featured_new = 'assets/compro/assets/frontend_assets/slider/img/'.$featured_new;   

            $post = CmsSlider::create([
                'background'          => $featured_new,
                'img_left'          => $featured_new_left,                
                'img_middle'          => $featured_new_middle,                
                'img_line'          => $featured_new_line,                         
                'img_right'          => $featured_new_right,
                'rowstate'          => $request->rowstate,
                'updated_at'        => date('Y-m-d H:i:s')
            ]);

            Session::flash('success', 'Slider Berhasil Ditambahkan.');
            return redirect()->route('slider');            
        }        
    }

    public function edit($id){

        $post = DB::table('cms_slider')
        ->where('id', $id)
        ->first();
        
        // die('whyy');

        return view('pages.cms_compro.slider.edit')->with('post', $post);
    }

    public function update(Request $request, $id){

    	// echo "<pre>";
     //    print_r($_POST);
     //    echo "</pre>";
     //    die();

        $this->validate($request, [
            'rowstate'       => 'required'
        ]);




        $featured_new = '';
        $featured_new_left = ''; 
        $featured_new_middle = ''; 
        $featured_new_line = ''; 
        $featured_new_right ='';

        if( $request->hasFile('background') ){
            $featured = $request->background;
            $featured_new = time()."_".$featured->getClientOriginalName();
            $featured->move('assets/compro/assets/frontend_assets/slider/img/', $featured_new);
            $featured_new = 'assets/compro/assets/frontend_assets/slider/img/'.$featured_new;

            DB::table('cms_slider')->where('id', $id)->update([
                'background'          => $featured_new,
                'rowstate'          => $request->rowstate,
                'updated_at'        => date('Y-m-d H:i:s')  
            ]);                           
        }

       if( $request->hasFile('img_left')){ 
            $featuredLeft = $request->img_left;
            $featured_new_left = time()."_".$featuredLeft->getClientOriginalName();
            $featuredLeft->move('assets/compro/assets/frontend_assets/slider/img/', $featured_new_left);
            $featured_new_left = 'assets/compro/assets/frontend_assets/slider/img/'.$featured_new_left;

            DB::table('cms_slider')->where('id', $id)->update([
                'img_left'          => $featured_new_left,
                'rowstate'          => $request->rowstate,
                'updated_at'        => date('Y-m-d H:i:s')            
            ]);                 
        }

       if( $request->hasFile('img_middle')){     
            $featuredMiddle = $request->img_middle;
            $featured_new_middle = time()."_".$featuredMiddle->getClientOriginalName();
            $featuredMiddle->move('assets/compro/assets/frontend_assets/slider/img/', $featured_new_middle);
            $featured_new_middle = 'assets/compro/assets/frontend_assets/slider/img/'.$featured_new_middle;

            DB::table('cms_slider')->where('id', $id)->update([
                'img_middle'          => $featured_new_middle,
                'rowstate'          => $request->rowstate,
                'updated_at'        => date('Y-m-d H:i:s')  
            ]);                           
        }

       if( $request->hasFile('img_line')){     
            $featuredLine = $request->img_line;
            $featured_new_line = time()."_".$featuredLine->getClientOriginalName();
            $featuredLine->move('assets/compro/assets/frontend_assets/slider/img/', $featured_new_line);
            $featured_new_line = 'assets/compro/assets/frontend_assets/slider/img/'.$featured_new_line;

            DB::table('cms_slider')->where('id', $id)->update([
                'img_line'          => $featured_new_line,
                'rowstate'          => $request->rowstate,
                'updated_at'        => date('Y-m-d H:i:s') 
            ]);                                        
        }

       if( $request->hasFile('img_right')){     
            $featuredRight = $request->img_right;
            $featured_new_right = time()."_".$featuredRight->getClientOriginalName();
            $featuredRight->move('assets/compro/assets/frontend_assets/slider/img/', $featured_new_right);
            $featured_new_right = 'assets/compro/assets/frontend_assets/slider/img/'.$featured_new_right;

            DB::table('cms_slider')->where('id', $id)->update([
                'img_right'          => $featured_new_right,
                'rowstate'          => $request->rowstate,
                'updated_at'        => date('Y-m-d H:i:s')
            ]);            
        }

        DB::table('cms_slider')->where('id', $id)->update([
            'rowstate'          => $request->rowstate,
            'updated_at'        => date('Y-m-d H:i:s')  
        ]);             

        Session::flash('success', 'Slider Berhasil Ditambahkan.');
        return redirect()->route('slider');            

        
    }


    public function preview($id){
        $post = CmsSlider::find($id);
        $post->delete();

        // Session::flash('success', 'Slider Berhasil Dihapus');
        // return redirect()->back();
    }

    public function delete($id){
        $post = CmsSlider::find($id);
        $post->delete();

        Session::flash('success', 'Slider Berhasil Dihapus');
        return redirect()->back();
    }
}
