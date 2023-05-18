<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

use DB;
Use Session;
use Auth;
use App\User;
use App\CmsAbout;
use Hash;
use Image;

class AdminAboutController extends Controller{

    public function index(){
        $post = DB::table('cms_about')
        ->where('id', 1)
        ->first();
        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();  
        return view('pages.cms_compro.about.edit')->with('post', $post)->with('setting', $setting);
 
    }

    public function update(Request $request){

        $this->validate($request, [
            'title_in'              => 'required',
            'title_en'              => 'required',
            // 'text_in'              => 'required',
            // 'text_en'              => 'required',            
            'content_in'                => 'required',
            'content_en'                 => 'required',
            'title_service_in'                 => 'required',
            'title_service_en'                 => 'required',
            'content_service_in'                 => 'required',
            'content_service_en'                 => 'required',
        ]);

            $setting = CmsAbout::find(1);

            $setting->title_in           = $request->title_in;
            $setting->title_en           = $request->title_en;
            // $setting->text_in           = $request->text_in;
            // $setting->text_en           = $request->text_en;
            $setting->content_in         = $request->content_in;
            $setting->content_en         = $request->content_en;

            $setting->title_service_in         = $request->title_service_in;
            $setting->title_service_en         = $request->title_service_en;
            $setting->content_service_in         = $request->content_service_in;
            $setting->content_service_en         = $request->content_service_en;             
            $setting->save();

            Session::flash('success', 'Berhasil Diupdate.');
            return redirect()->route('about');
// }

    	Session::flash('success', 'Tentang Perusahaan Berhasil Diupdate.');
    	return redirect()->route('about');

       


    }

}
