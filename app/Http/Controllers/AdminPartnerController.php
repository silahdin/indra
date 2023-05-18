<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
Use Session;
use Auth;
use App\User;
use App\CmsPartner;
use Hash;
use Image;


class AdminPartnerController extends Controller{

    public function index(){
        // return view('pages.admin.inbox.index')->with('inbox', $inbox);
        $post = DB::table('cms_partner')
        ->orderBy('id', 'ASC')
        ->get();
        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();  
        return view('pages.cms_compro.partner.index')->with('posts', $post)->with('setting', $setting);
    }

    public function add(){
        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();          
        return view('pages.cms_compro.partner.add')->with('setting', $setting);
    }

    public function store(Request $request){
        // print_r($_POST);
        // die();   
      
        
        $this->validate($request, [
            'image-data'    => 'required',
            // 'url'       => 'required',
            'rowstate'       => 'required',
        ]);

        if($request->get('image-data')){
            $name = time().'_client.png';

            $image_data = $request->get('image-data');
            $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image_data));
            $img = Image::make($info);
            $img->save('assets/compro/assets/frontend_assets/images/our_clients/'.$name);

            $post = CmsPartner::create([
                'logo'          => 'assets/compro/assets/frontend_assets/images/our_clients/'.$name,
                // 'url'               => $request->url,
                'rowstate'          => $request->rowstate,
                'created_at'        => date('Y-m-d H:i:s')
            ]);

            Session::flash('success', 'Client Berhasil Ditambahkan.');
            return redirect()->route('partner');
        }else{
            Session::flash('success', 'Client Gagal Ditambahkan.');
            return redirect()->route('partner');            
        }
    }

    public function edit($id){

        $post = DB::table('cms_partner')
        ->where('id', $id)
        ->first();
        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();          
        
        return view('pages.cms_compro.partner.edit')->with('post', $post)->with('setting', $setting);
    }

    public function update(Request $request, $id){
        // print_r($_POST);
        // die();      
        
        $this->validate($request, [
            // 'url'       => 'required',
            'rowstate'       => 'required',
        ]);

        if($request->get('image-data')){
            $name = time().'_client.png';

            $image_data = $request->get('image-data');
            $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image_data));
            $img = Image::make($info);
            $img->save('assets/compro/assets/frontend_assets/images/our_clients/'.$name);

            DB::table('cms_partner')->where('id', $id)->update([
                'logo'          => 'assets/compro/assets/frontend_assets/images/our_clients/'.$name,
                // 'url'               => $request->url,
                'rowstate'          => $request->rowstate,
                'updated_at'        => date('Y-m-d H:i:s')
            ]);

            Session::flash('success', 'Client Berhasil di update Ditambahkan.');
            return redirect()->route('partner');
        }else{
            DB::table('cms_partner')->where('id', $id)->update([               
                //  'url'               => $request->url,
                'rowstate'          => $request->rowstate,
                'updated_at'        => date('Y-m-d H:i:s')
            ]);
            Session::flash('success', 'Client Berhasil di update Ditambahkan.');
            return redirect()->route('partner');            
        }

        Session::flash('success', 'Something Wrong.');
        return redirect()->route('partner');
    }

    public function delete($id){
        $post = CmsPartner::find($id);
        $post->delete();

        Session::flash('success', 'Client Berhasil Dihapus');
        return redirect()->back();
    }


    public function page(){

        $post = DB::table('cms_homepage')
        ->where('id', 1)
        ->first();

        return view('pages.cms_compro.partner.page')->with('post', $post);
    }


    public function editpage(Request $request){
        // print_r($_POST);
        // die();      
        
        $this->validate($request, [
            'title_in'    => 'required',
            'title_en'    => 'required',
            'titleh2_in'    => 'required',
            'titleh2_en'    => 'required',
            'texth2_in'    => 'required',
            'texth2_en'    => 'required',
            'partner_in'    => 'required',
            'partner_en'    => 'required',

            'sub_in'    => 'required',
            'sub_en'    => 'required',
            'textsub_in'    => 'required',
            'textsub_en'    => 'required',
        ]);

        DB::table('cms_homepage')->where('id', 1)->update([
            'title_in'               => $request->title_in,
            'title_en'               => $request->title_en,
            'titleh2_in'               => $request->titleh2_in,                                             
            'titleh2_en'               => $request->titleh2_en,
            'texth2_in'               => $request->texth2_in,                  
            'texth2_en'               => $request->texth2_en,
            'partner_in'               => $request->partner_in,
            'partner_en'               => $request->partner_en,

            'sub_in'               => $request->sub_in,                  
            'sub_en'               => $request->sub_en,
            'textsub_in'               => $request->textsub_in,
            'textsub_en'               => $request->textsub_en,            
        ]);

        Session::flash('success', 'Success.');
        return redirect()->route('beranda.page');
    }

}
