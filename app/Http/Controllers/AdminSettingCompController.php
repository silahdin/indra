<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

use DB;
Use Session;
use Auth;
use App\User;
use App\CmsSettingComp;
use Hash;

class AdminSettingCompController extends Controller{

    public function index(){
        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();
        
        return view('pages.cms_compro.setting.edit')->with('setting', $setting);
 
    }

    public function update(Request $request){

        function rupiahToNumber($string){
        	$new = substr($string, 4);
			return preg_replace("/([^0-9])/i", "", $new);			
		}
		
        $this->validate($request, [
            'title_in'              => 'required',
            'title_en'              => 'required',
            'sitename'              => 'required',
            'no_tlp'                => 'required',
            'email'                 => 'required',
            'alamat'                => 'required',
            // 'keywords'              => 'required',
			'fee_register'          => 'required',
			'ocv'          			=> 'required',
            // 'description'           => 'required',
            'site_name_en'          => 'required',
            'site_name_id'          => 'required',
            'meta_title_en'          => 'required',
            'meta_title_id'          => 'required',
            'meta_description_en'          => 'required',
            'meta_description_id'          => 'required',
            'meta_keyword_en'          => 'required',
            'meta_keyword_id'          => 'required',
        ]);
    	// echo "<pre>";
    	// print_r($_POST);
    	// echo "</pre>";
    	// die();
        if($request->hasFile('logo_src')){
            // die('ada');
            $featured = $request->logo_src;
            $featured_new_name = time()."_".$featured->getClientOriginalName();
            $featured->move('assets/compro/assets/frontend_assets/images', $featured_new_name);

	        $setting = CmsSettingComp::find(1);
            $setting->logo_src          = 'assets/compro/assets/frontend_assets/images/'.$featured_new_name;
	        $setting->title_in                 = $request->title_in;
			$setting->title_en              = $request->title_en;
			$setting->sitename              = $request->sitename;
	        $setting->no_tlp           = $request->no_tlp;
	        $setting->email                 = $request->email;
	        $setting->alamat                = $request->alamat;
	        // $setting->keywords           = $request->keywords;
			// $setting->description               = $request->description;
			$setting->ocv               		= $request->ocv;
	        $setting->fee_register               = rupiahToNumber($request->fee_register);
	        $setting->site_name_en              = $request->site_name_en;
	        $setting->site_name_id              = $request->site_name_id;
	        $setting->meta_title_en              = $request->meta_title_en;
	        $setting->meta_title_id              = $request->meta_title_id;
	        $setting->meta_description_en              = $request->meta_description_en;
	        $setting->meta_description_id              = $request->meta_description_id;
	        $setting->meta_keyword_en              = $request->meta_keyword_en;
	        $setting->meta_keyword_id              = $request->meta_keyword_id;

	        $setting->save();

	    	Session::flash('success', 'Setting Berhasil Diupdate.');
	    	return redirect()->route('setting_comp');
        }else{
        	// die('gk da');
	        $setting = CmsSettingComp::find(1);
	        $setting->title_in                 = $request->title_in;
			$setting->title_en              = $request->title_en;
			$setting->sitename              = $request->sitename;			
	        $setting->no_tlp           = $request->no_tlp;
	        $setting->email                 = $request->email;
	        $setting->alamat                = $request->alamat;
	        // $setting->keywords           = $request->keywords;
	        // $setting->description               = $request->description;
	        $setting->fee_register               = rupiahToNumber($request->fee_register);
			$setting->ocv               		= $request->ocv;
			$setting->site_name_en              = $request->site_name_en;
	        $setting->site_name_id              = $request->site_name_id;
	        $setting->meta_title_en              = $request->meta_title_en;
	        $setting->meta_title_id              = $request->meta_title_id;
	        $setting->meta_description_en              = $request->meta_description_en;
	        $setting->meta_description_id              = $request->meta_description_id;
	        $setting->meta_keyword_en              = $request->meta_keyword_en;
	        $setting->meta_keyword_id              = $request->meta_keyword_id;
			
	        $setting->save();

	    	Session::flash('success', 'Setting Berhasil Diupdate.');
	    	return redirect()->route('setting_comp');

        }



	}
	

	public function ocv(){
		$setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();
        
        return view('pages.cms_compro.setting.ocv')->with('setting', $setting);
 
    }

    public function ocvupdate(Request $request){
		
        $this->validate($request, [
			'ocv'          			=> 'required',
        ]);
	        $setting = CmsSettingComp::find(1);
			$setting->ocv               		= $request->ocv;
			$setting->ocv_ch               		= $request->ocv_ch;
			
	        $setting->save();

	    	Session::flash('success', 'Setting Berhasil Diupdate.');
	    	return redirect()->route('setting_ocv');

	}
	
	public function cm(){
		$setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();
        
        return view('pages.cms_compro.setting.cm')->with('setting', $setting);
 
    }

    public function cmupdate(Request $request){
		//dd($request->all());
        $this->validate($request, [
			'name_cm'          				=> 'required',
			'title_cm'          			=> 'required',
			'subtitle_cm'          			=> 'required',
		]);
			
	        $setting = CmsSettingComp::find(1);
			$setting->name_cm			= $request->name_cm;
			$setting->title_cm			= $request->title_cm;
			$setting->title_ch			= $request->title_ch;
			$setting->subtitle_cm		= $request->subtitle_cm;
			$setting->subtitle_ch		= $request->subtitle_ch;
			$setting->charimanmsg		= $request->charimanmsg;
			$setting->charimanmsg_ch		= $request->charimanmsg_ch;

			if($request->hasFile('images_cm')){
                $featured = $request->images_cm;
                $featured_new_name = time()."_".$featured->getClientOriginalName();
                $featured->move('assets/compro/assets/frontend_assets/images/etc', $featured_new_name);
                $setting->images_cm = 'assets/compro/assets/frontend_assets/images/etc/'.$featured_new_name;
            }
			
	        $setting->save();

	    	Session::flash('success', 'Setting Berhasil Diupdate.');
	    	return redirect()->route('setting_cm');

	}
	

}
