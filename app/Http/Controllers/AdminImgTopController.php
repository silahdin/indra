<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

use DB;
Use Session;
use Auth;
use App\User;
use App\CmsImgTop;
use Hash;
use Image;

class AdminImgTopController extends Controller{

    public function index(){
        $post = DB::table('cms_img_top')
        ->where('id', 1)
        ->first();
        
        return view('pages.cms_compro.img_top.edit')->with('setting', $post);
 
    }

    public function update(Request $request){


    	// echo "<pre>";
    	// print_r($_POST);
    	// echo "</pre>";
    	// die();


        if($request->get('img_publication')){
            $name = time().'_img_publication.png';

            $image_data = $request->get('img_publication');
            $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image_data));
            $img = Image::make($info);
            $img->save('assets/compro/assets/frontend_assets/img_top/'.$name);

	        $setting = CmsImgTop::find(1);
            $setting->img_publication           = 'assets/compro/assets/frontend_assets/img_top/'.$name;
            $setting->save();

        }

        if($request->get('img_about')){
            $name = time().'_img_about.png';

            $image_data = $request->get('img_about');
            $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image_data));
            $img = Image::make($info);
            $img->save('assets/compro/assets/frontend_assets/img_top/'.$name);

	        $setting = CmsImgTop::find(1);
            $setting->img_about           = 'assets/compro/assets/frontend_assets/img_top/'.$name;
            $setting->save();

        }

        if($request->get('img_vision')){
            $name = time().'_img_vision.png';

            $image_data = $request->get('img_vision');
            $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image_data));
            $img = Image::make($info);
            $img->save('assets/compro/assets/frontend_assets/img_top/'.$name);

	        $setting = CmsImgTop::find(1);
            $setting->img_vision          = 'assets/compro/assets/frontend_assets/img_top/'.$name;
            $setting->save();

        }

        if($request->get('img_team')){
            $name = time().'_img_team.png';

            $image_data = $request->get('img_team');
            $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image_data));
            $img = Image::make($info);
            $img->save('assets/compro/assets/frontend_assets/img_top/'.$name);

	        $setting = CmsImgTop::find(1);
            $setting->img_team           = 'assets/compro/assets/frontend_assets/img_top/'.$name;
            $setting->save();

        }

        if($request->get('img_career')){
            $name = time().'_img_career.png';

            $image_data = $request->get('img_career');
            $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image_data));
            $img = Image::make($info);
            $img->save('assets/compro/assets/frontend_assets/img_top/'.$name);

	        $setting = CmsImgTop::find(1);
            $setting->img_career           = 'assets/compro/assets/frontend_assets/img_top/'.$name;
            $setting->save();

        }

        if($request->get('img_corporate')){
            $name = time().'_img_corporate.png';

            $image_data = $request->get('img_corporate');
            $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image_data));
            $img = Image::make($info);
            $img->save('assets/compro/assets/frontend_assets/img_top/'.$name);

	        $setting = CmsImgTop::find(1);
            $setting->img_corporate           = 'assets/compro/assets/frontend_assets/img_top/'.$name;
            $setting->save();

        }

        if($request->get('img_invest')){
            $name = time().'_img_invest.png';

            $image_data = $request->get('img_invest');
            $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image_data));
            $img = Image::make($info);
            $img->save('assets/compro/assets/frontend_assets/img_top/'.$name);

	        $setting = CmsImgTop::find(1);
            $setting->img_invest           = 'assets/compro/assets/frontend_assets/img_top/'.$name;
            $setting->save();

        }                                                

    	Session::flash('success', 'Gambar Berhasil Diupdate.');
    	return redirect()->route('image_top');



       


    }

}
