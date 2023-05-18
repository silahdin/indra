<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

use DB;
Use Session;
use Auth;
use App\User;
use App\CmsImage;
use Hash;
use Image;

class AdminImageController extends Controller{
    public function index(){
        $setting = DB::table('cms_image')
        ->where('id', 1)
        ->first();

        return view('pages.cms_compro.image.edit')->with('setting', $setting);
    }

    public function update(Request $request){

    	// echo "<pre>";
    	// print_r($_POST);
    	// echo "</pre>";
    	// die();

        if($request->get('image-data')){
            $name = time().'_gambar_info.png';

            $image_data = $request->get('image-data');
            $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image_data));
            $img = Image::make($info);
            $img->save('assets/compro/assets/frontend_assets/images_info/'.$name);

	        $setting = CmsImage::find(1);
            $setting->img           = 'assets/compro/assets/frontend_assets/images_info/'.$name;
            $setting->save();

	    	Session::flash('success', 'Gambar Berhasil Diupdate.');
	    	return redirect()->route('image');
        }else{
	    	Session::flash('success', 'Gambar gagal diupdate/Anda tidak mengubah gambar');
	    	return redirect()->route('image');
        }


    }

}
