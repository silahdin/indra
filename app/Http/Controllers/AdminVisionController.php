<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

use DB;
Use Session;
use Auth;
use App\User;
use App\CmsVision;
use Hash;

class AdminVisionController extends Controller{
    public function index(){
        $post = DB::table('cms_vision')
        ->where('id', 1)
        ->first();
        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();  
        return view('pages.cms_compro.vision.edit')->with('post', $post)->with('setting', $setting);
    }

    public function update(Request $request){
        $this->validate($request, [
            'vision_in'              => 'required',
            'vision_en'              => 'required',
            'mission_in'                => 'required',
            'mission_en'                 => 'required'
        ]);
    	// echo "<pre>";
    	// print_r($_POST);
    	// echo "</pre>";
    	// die();

        $setting = CmsVision::find(1);
        $setting->vision_in           = $request->vision_in;
        $setting->vision_en           = $request->vision_en;
        $setting->mission_in         = $request->mission_in;
        $setting->mission_en         = $request->mission_en;
        $setting->save();

    	Session::flash('success', 'Visi Misi Berhasil Diupdate.');
    	return redirect()->route('vision');

       


    }

}
