<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
Use Session;
use Auth;
use App\User;
use App\CmsServicesList;
use App\CmsSubService;
use App\CmsServiceContact;
use Hash;
use Image;

class AdminSubServicesController extends Controller
{
    
    public function index($sid){
        $contacts = DB::table('cms_service_contact')
        ->get();
        $services = DB::table('cms_sub_services')
        ->where('service_id', $sid)
        ->orderBy('name', 'ASC')
        ->get();
        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();  
        return view('pages.cms_compro.service.subService.index')->with('sid',$sid)->with('contacts', $contacts)->with('services', $services)->with('setting', $setting);
    }

    public function add($sid){
        $contacts = DB::table('cms_service_contact')
        ->orderBy('name', 'ASC')
        ->get();
        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();       
        return view('pages.cms_compro.service.subService.add')->with('sid',$sid)->with('contacts', $contacts)->with('setting', $setting);
    }
    
    public function store(Request $request, $sid){
        
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
            // 'description'     => 'required',
            // 'details'          => 'required',
        ]);

        if($request->get('image-data')){
            $name = time().'_subservice.png';
            $image_data = $request->get('image-data');
            $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image_data));
            $img = Image::make($info);
            $img->save('assets/compro/assets/frontend_assets/images/service/subService/'.$name);
            // $post = CmsCareer::create([
            $id = DB::table('cms_sub_services')->insertGetId([
                'service_id'      => $sid,
                'name'            => $request->nama,
                'name_ch'            => $request->nama_ch,
                'slug'     => $request->slug,
                'description'     => $request->description,
                'description_ch'     => $request->description_ch,
                'situation_part'  => $request->situasi,
                'situation_part_ch'  => $request->situasi_ch,
                'help_part'       => $request->bantuan,
                'help_part_ch'       => $request->bantuan_ch,
                'contact_one'     => $request->contact_one,
                'contact_two'     => $request->contact_two,
                'image'           => 'assets/compro/assets/frontend_assets/images/service/subService/'.$name,
                'created_at'      => date('Y-m-d H:i:s')
            ]);

            // UPLOAD ATTACHMENT
            foreach (@$request->attachment ?? [] as $file) {
                $folder = 'uploads/attachment/services-sub/' . $id;
                $filename = $file->getClientOriginalName();

                $file->move($folder, $filename);

                DB::table('cms_page_attachments')->insert([
                    'model' => 'services-sub',
                    'model_id' => $id,
                    'file_name' => $filename,
                    'file_url' => $folder . '/' . $filename,
                ]);
            }   

            Session::flash('success', 'Sub Service Berhasil Ditambahkan.');
            return redirect()->route('service');          
        }else{
            // die('gak ada');
            $no_img = 'no_image.png';

            $id = DB::table('cms_sub_services')->insertGetId([
                'service_id'      => $sid,
                'name'            => $request->nama,
                'slug'            => $request->slug,
                'name_ch'            => $request->nama_ch,
                'description'     => $request->description,
                'description_ch'     => $request->description_ch,
                'situation_part'  => $request->situasi,
                'situation_part'  => $request->situasi_ch,
                'help_part'       => $request->bantuan,
                'help_part'       => $request->bantuan_ch,
                'contact_one'     => $request->contact_one,
                'contact_two'     => $request->contact_two,
                'image'             => 'assets/compro/assets/frontend_assets/images/service/subService/'.$no_img,
                'created_at'      => date('Y-m-d H:i:s')
            ]);   

            // UPLOAD ATTACHMENT
            foreach (@$request->attachment ?? [] as $file) {
                $folder = 'uploads/attachment/services-sub/' . $id;
                $filename = $file->getClientOriginalName();

                $file->move($folder, $filename);

                DB::table('cms_page_attachments')->insert([
                    'model' => 'services-sub',
                    'model_id' => $id,
                    'file_name' => $filename,
                    'file_url' => $folder . '/' . $filename,
                ]);
            }       

            Session::flash('success', 'Sub Service Berhasil Ditambahkan.');
            return redirect()->route('service');
            // $this->index($sid);  
           
        }
    }

    public function edit($sid, $id){
        $contacts = DB::table('cms_service_contact')
        ->orderBy('name', 'ASC')
        ->get();
        $post = DB::table('cms_sub_services')
        ->where('sub_services_id', $id)
        ->first();
        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();  
        $attachment = DB::table('cms_page_attachments')
        ->where('model', 'services-sub')
        ->where('model_id', $id)
        ->get(); 
        return view('pages.cms_compro.service.subService.edit')->with('contacts', $contacts)->with('post', $post)->with('setting', $setting)->with('attachment', $attachment);
    }

    public function update(Request $request, $sid, $id){
        
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
            $name = time().'_subService.jpg';
            $image_data = $request->get('image-data');
            $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image_data));
            $img = Image::make($info);
            $img->save('/home2/reandabe/public_html/dev/assets/compro/assets/frontend_assets/images/service/subService/'.$name);
            // $post = CmsCareer::create([
            DB::table('cms_sub_services')->where('sub_services_id', $id)->update([
                'name'            => $request->nama,
                'name_ch'            => $request->nama_ch,
                'description'     => $request->description,
                'slug'     => $request->slug,
                'description_ch'     => $request->description_ch,
                'situation_part'  => $request->situasi,
                'situation_part_ch'  => $request->situasi_ch,
                'help_part'       => $request->bantuan,
                'help_part_ch'       => $request->bantuan_ch,
                'contact_one'     => $request->contact_one,
                'contact_two'     => $request->contact_two,
                'image'           => 'assets/compro/assets/frontend_assets/images/service/subService/'.$name,
                'updated_at'      => date('Y-m-d H:i:s')
            ]);

            // UPLOAD ATTACHMENT
            foreach (@$request->attachment ?? [] as $file) {
                $folder = 'uploads/attachment/services-sub/' . $id;
                $filename = $file->getClientOriginalName();

                $file->move($folder, $filename);

                DB::table('cms_page_attachments')->insert([
                    'model' => 'services-sub',
                    'model_id' => $id,
                    'file_name' => $filename,
                    'file_url' => $folder . '/' . $filename,
                ]);
            }

            Session::flash('success', 'Sub Service Berhasil Diupdate.'.$request->nama);
            return redirect()->route('service');          
        }else{
            // die('gak ada');

            DB::table('cms_sub_services')->where('sub_services_id', $id)->update([
                'name'            => $request->nama,
                'name_ch'            => $request->nama_ch,
                'description'     => $request->description,
                'slug'     => $request->slug,
                'description_ch'     => $request->description_ch,
                'situation_part'  => $request->situasi,
                'situation_part_ch'  => $request->situasi_ch,
                'help_part'       => $request->bantuan,
                'help_part_ch'       => $request->bantuan_ch,
                'contact_one'     => $request->contact_one,
                'contact_two'     => $request->contact_two,
                'updated_at'      => date('Y-m-d H:i:s')
            ]); 

            // UPLOAD ATTACHMENT
            foreach (@$request->attachment ?? [] as $file) {
                $folder = 'uploads/attachment/services-sub/' . $id;
                $filename = $file->getClientOriginalName();

                $file->move($folder, $filename);

                DB::table('cms_page_attachments')->insert([
                    'model' => 'services-sub',
                    'model_id' => $id,
                    'file_name' => $filename,
                    'file_url' => $folder . '/' . $filename,
                ]);
            }           

            Session::flash('success', 'Sub Service Berhasil Diupdate.'.$request->nama);
            return redirect()->route('service');          
        }
    }

    public function delete( $sid, $id){

        $post = DB::table('cms_sub_services')
        ->where('sub_services_id', $id)
        ->delete();
        // $post->delete();
        $contacts = DB::table('cms_service_contact')
        ->get();
        $services = DB::table('cms_sub_services')
        ->where('service_id', $sid)
        ->orderBy('name', 'ASC')
        ->get();

        Session::flash('success', 'Sub Service Berhasil Dihapus'. $sid);
        return redirect()->back()->with('contacts', $contacts)->with('services', $services);
    }
}
