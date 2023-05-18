<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

use DB;
Use Session;
use Auth;
use App\User;
use App\CmsContact;
use Hash;

class AdminContactController extends Controller{
    
    public function index(){
        $post = DB::table('cms_contact')
        ->where('id', 1)
        ->first();
        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();  
        return view('pages.cms_compro.contact.edit')->with('post', $post)->with('setting', $setting);
    }

    public function update(Request $request){

        $this->validate($request, [
            'title_in'    => 'required',
            'title_en'    => 'required',
            'text_in'    => 'required',
            'text_in'    => 'required',            
            'address_in'              => 'required',
            'address_en'              => 'required',
            'telp'                 => 'required',
            'email'                 => 'required',
        ]);
    	// echo "<pre>";
    	// print_r($_POST);
    	// echo "</pre>";
    	// die();

        $setting = CmsContact::find(1);
            $setting->title_in           = $request->title_in;
            $setting->title_en           = $request->title_en;
            $setting->text_in           = $request->text_in;
            $setting->text_en           = $request->text_en;
            $setting->address_in           = $request->address_in;
            $setting->address_en           = $request->address_en;                        
            $setting->telp         = $request->telp;
            $setting->email         = $request->email;
            $setting->save();

    	Session::flash('success', 'Kontak Berhasil Diupdate.');
    	return redirect()->route('contact');
    }

}
