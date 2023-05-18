<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
Use Session;
use Auth;
use App\User;
use App\CmsSubService;
use App\CmsServicePartner;
use Hash;
use Image;


class AdminServicesPartnerController extends Controller
{
    
    public function index(){
        $partner = DB::table('cms_services_partner')
        // ->leftJoin('cms_sub_services', 'cms_sub_services.sub_services_id', '=', 'cms_services_partner.sub_service_id')
        ->orderBy('name', 'ASC')
        ->get();
        $sub = DB::table('cms_sub_services')
        ->orderBy('name', 'ASC')
        ->get();
        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();  
        return view('pages.cms_compro.service.partner.index')->with('subs', $sub)->with('partners', $partner)->with('setting', $setting);
    }

    public function add(){
        $contacts = DB::table('cms_sub_services')
        ->orderBy('name', 'ASC')
        ->get();
        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();       
        return view('pages.cms_compro.service.partner.add')->with('subServices', $contacts)->with('setting', $setting);
    }
    
    public function store(Request $request){
        
        function convert_tgl_to_db($tgl){
            //UBAH TANGGAL INPUTAN BIAR BISA MASUK KE DATABASE
            $tgl_1 = substr($tgl, 0,2);
            $tgl_2 = substr($tgl, 3,2);
            $tgl_3 = substr($tgl, 6,4);
            $total = $tgl_3.'-'.$tgl_2.'-'.$tgl_1;
            return $total;
        }

        $this->validate($request, [
            'nama'            => 'required',
        ]);

        // echo "<pre>";
        // print_r($_POST);
        // echo "</pre>";
        // die(); 
        // if($request->email != ""){
        //     $email = $request->email;
        // }else{
        //     $email = '-';
        // }if
        if($request->get('image-data')){
            $name = time().'_partner.png';
            $image_data = $request->get('image-data');
            $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image_data));
            $img = Image::make($info);
            $img->save('assets/compro/assets/frontend_assets/images/service/partner/'.$name);
            // $post = CmsCareer::create([
            DB::table('cms_services_partner')->insert([
                'name'            => $request->nama,
                'description'     => $request->description,
                'sub_service_id'  => $request->subService,
                'image'           => 'assets/compro/assets/frontend_assets/images/service/partner/'.$name,
                'created_at'      => date('Y-m-d H:i:s')
            ]);

            Session::flash('success', 'Partner Berhasil Ditambahkan.');
            return redirect()->route('servicePartner');          
        }else{
            // die('gak ada');
            $no_img = 'no_image.png';

            DB::table('cms_services_partner')->insert([
                'name'            => $request->nama,
                'description'     => $request->description,
                'sub_service_id'  => $request->subService,
                'image'             => 'assets/compro/assets/frontend_assets/images/service/partner/'.$no_img,
                'created_at'      => date('Y-m-d H:i:s')
            ]);            

            Session::flash('success', 'Partner Berhasil Ditambahkan.');
            return redirect()->route('servicePartner');          
        }
    }

    public function edit($id){
        $subServices = DB::table('cms_sub_services')
        ->orderBy('name', 'ASC')
        ->get();
        $post = DB::table('cms_services_partner')
        ->where('partner_id', $id)
        ->first();
        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();  
        return view('pages.cms_compro.service.partner.edit')->with('subServices', $subServices)->with('post', $post)->with('setting', $setting);
    }

    public function update(Request $request, $id){
        
        function convert_tgl_to_db($tgl){
            //UBAH TANGGAL INPUTAN BIAR BISA MASUK KE DATABASE
            $tgl_1 = substr($tgl, 0,2);
            $tgl_2 = substr($tgl, 3,2);
            $tgl_3 = substr($tgl, 6,4);
            $total = $tgl_3.'-'.$tgl_2.'-'.$tgl_1;
            return $total;
        }

        $this->validate($request, [
            'nama'            => 'required',
        ]);


        if($request->get('image-data')){
            $name = time().'_partner.png';
            $image_data = $request->get('image-data');
            $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image_data));
            $img = Image::make($info);
            $img->save('assets/compro/assets/frontend_assets/images/service/partner/'.$name);
            // $post = CmsCareer::create([
            DB::table('cms_services_partner')->where('partner_id', $id)->update([
                'name'            => $request->nama,
                'description'     => $request->description,
                'sub_service_id'  => $request->subService,
                'image'           => 'assets/compro/assets/frontend_assets/images/service/partner/'.$name,
                'updated_at'      => date('Y-m-d H:i:s')
            ]);

            Session::flash('success', 'partner Berhasil Diupdate.');
            return redirect()->route('servicePartner');          
        }else{
            // die('gak ada');

            DB::table('cms_services_partner')->where('partner_id', $id)->update([
                'name'            => $request->nama,
                'description'     => $request->description,
                'sub_service_id'  => $request->subService,
                'updated_at'      => date('Y-m-d H:i:s')
            ]);            

            Session::flash('success', 'Partner Berhasil Diupdate.');
            return redirect()->route('servicePartner');          
        }
    }

    public function delete($id){

        $post = CmsServicePartner::find($id);
        $post->delete();

        Session::flash('success', 'Partner Berhasil Dihapus');
        return redirect()->back();
    }
}
