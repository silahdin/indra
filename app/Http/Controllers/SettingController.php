<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
Use Session;
use App\Setting;

class SettingController extends Controller
{
    public function index(){
        $setting = DB::table('setting')
        ->where('id', 1)
        ->first();

        return view('pages.admin.setting.edit')->with('setting', $setting);
    }

    public function update(Request $request){

        $this->validate($request, [
            'title'                 => 'required',
            'no_tlp'                => 'required',
            'email'                 => 'required',
            'email_notif'           => 'required',
            'alamat'                => 'required',
            'keywords'              => 'required',
            'description'           => 'required',
            'aboutus'               => 'required'
        ]);

        $setting = Setting::find(1);
        $setting->title                 = $request->title;
        $setting->keywords              = $request->keywords;
        $setting->description           = $request->description;
        $setting->aboutus               = $request->aboutus;
        $setting->no_tlp                = $request->no_tlp;
        $setting->alamat                = $request->alamat;
        $setting->email                 = $request->email;
        $setting->email_notif           = $request->email_notif;

        $setting->save();

    	Session::flash('success', 'Setting Berhasil Diupdate.');
    	return redirect()->route('setting');

    }
}
