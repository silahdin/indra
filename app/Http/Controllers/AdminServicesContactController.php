<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
Use Session;
use Auth;
use App\User;
use App\CmsServiceContact;
use Hash;
use Image;

class AdminServicesContactController extends Controller
{
    public function index(){
        $contacts = DB::table('cms_service_contact')
        ->orderBy('name', 'ASC')
        ->get();
        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();  
        return view('pages.cms_compro.service.contact.index')->with('contacts', $contacts)->with('setting', $setting);
    }

    public function add(){
        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();       
        return view('pages.cms_compro.service.contact.add')->with('setting', $setting);
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
            'jabatan'         => 'required',
            'email'          => 'required',
            'phone' => 'required',
        ]);

        // echo "<pre>";
        // print_r($_POST);
        // echo "</pre>";
        // die(); 
        if($request->email != ""){
            $email = $request->email;
        }else{
            $email = '#';
        }
        if($request->linkedin != ""){
            $linkedin = $request->linkedin;
        }else{
            $linkedin = '#';
        }
        if($request->get('image-data')){
            $name = time().'_contact.png';
            $image_data = $request->get('image-data');
            $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image_data));
            $img = Image::make($info);
            $img->save('assets/compro/assets/frontend_assets/images/service/contact/'.$name);
            // $post = CmsCareer::create([
            DB::table('cms_service_contact')->insert([
                'name'            => $request->nama,
                'title'         => $request->jabatan,
                'linkedin'        => $linkedin,
                'email'           => $email,
                'phone'          => $request->phone,
                'image'             => 'assets/compro/assets/frontend_assets/images/service/contact/'.$name,
                'created_at'      => date('Y-m-d H:i:s')
            ]);

            Session::flash('success', 'Contact Berhasil Ditambahkan.');
            return redirect()->route('serviceContact');          
        }else{
            // die('gak ada');
            $no_img = 'no_image.png';

            DB::table('cms_service_contact')->insert([
                'name'            => $request->nama,
                'title'         => $request->jabatan,
                'linkedin'        => $linkedin,
                'email'           => $email,
                'phone'          => $request->phone,
                'image'             => 'assets/compro/assets/frontend_assets/images/service/contact/'.$no_img,
                'created_at'      => date('Y-m-d H:i:s')
            ]);            

            Session::flash('success', 'Leader Berhasil Ditambahkan.');
            return redirect()->route('serviceContact');          
        }
    }

    public function edit($id){
        $post = DB::table('cms_service_contact')
        ->where('contact_id', $id)
        ->first();
        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();  
        return view('pages.cms_compro.service.contact.edit')->with('post', $post)->with('setting', $setting);
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
            'nama'           => 'required',
            'jabatan'        => 'required',
            'email'          => 'required',
            'phone' => 'required',
        ]);

        if($request->email != ""){
            $email = $request->email;
        }else{
            $email = '#';
        }
        if($request->linkedin != ""){
            $linkedin = $request->linkedin;
        }else{
            $linkedin = '#';
        }

        if($request->get('image-data')){
            $name = time().'_contact.png';
            $image_data = $request->get('image-data');
            $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image_data));
            $img = Image::make($info);
            $img->save('assets/compro/assets/frontend_assets/images/service/contact/'.$name);
            // $post = CmsCareer::create([
            DB::table('cms_service_contact')->where('contact_id', $id)->update([
                'name'            => $request->nama,
                'title'         => $request->jabatan,
                'linkedin'        => $linkedin,
                'email'           => $email,
                'phone'          => $request->phone,
                'image'             => 'assets/compro/assets/frontend_assets/images/service/contact/'.$name,
                'updated_at'      => date('Y-m-d H:i:s')
            ]);

            Session::flash('success', 'Contact Berhasil Diupdate.');
            return redirect()->route('serviceContact');          
        }else{
            // die('gak ada');
            $no_img = 'no_image.png';

            DB::table('cms_service_contact')->where('contact_id', $id)->update([
                'name'           => $request->nama,
                'title'          => $request->jabatan,
                'linkedin'       => $linkedin,
                'email'          => $email,
                'phone'          => $request->phone,
                'updated_at'     => date('Y-m-d H:i:s')
            ]);            

            Session::flash('success', 'Contact Berhasil Diupdate.');
            return redirect()->route('serviceContact');          
        }
    }

    public function delete($id){

        $post = CmsServiceContact::find($id);
        $post->delete();

        Session::flash('success', 'Contact Berhasil Dihapus');
        return redirect()->back();
    }
}
