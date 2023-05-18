<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
Use Session;
use Auth;
use App\User;
use App\CmsServicesList;
use App\CmsServiceContact;
use Hash;
use Image;

class AdminServicesController extends Controller
{
    public function index(){
        $services = DB::table('cms_servicelist')
        ->orderBy('name', 'ASC')
        ->get();
        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();  
        return view('pages.cms_compro.service.service.index')->with('services', $services)->with('setting', $setting);
    }

    public function add(){
        $contacts = DB::table('cms_service_contact')
        ->orderBy('name', 'ASC')
        ->get();
        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();
        return view('pages.cms_compro.service.service.add')->with('contacts', $contacts)->with('setting', $setting);
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
            'details'          => 'required',
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
            $name = time().'_service.png';
            $image_data = $request->get('image-data');
            $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image_data));
            $img = Image::make($info);
            $img->save('assets/compro/assets/frontend_assets/images/service/service/'.$name);
            // $post = CmsCareer::create([
            $id = DB::table('cms_servicelist')->insertGetId([
                'name'            => $request->nama,
                'name_ch'            => $request->nama_ch,
                'slug'            => $request->slug,
                'description'     => $request->description,
                'description_ch'     => $request->description_ch,
                'details'         => $request->details,
                'details_ch'         => $request->details_ch,
                'contact_person'  => $request->contact_person,
                'contact_person1'  => $request->contact_person1,
                'image'             => 'assets/compro/assets/frontend_assets/images/service/service/'.$name,
                'created_at'      => date('Y-m-d H:i:s')
            ]);

            // UPLOAD ATTACHMENT
            foreach (@$request->attachment ?? [] as $file) {
                $folder = 'uploads/attachment/services-list/' . $id;
                $filename = $file->getClientOriginalName();

                $file->move($folder, $filename);

                DB::table('cms_page_attachments')->insert([
                    'model' => 'services-list',
                    'model_id' => $id,
                    'file_name' => $filename,
                    'file_url' => $folder . '/' . $filename,
                ]);
            } 

            Session::flash('success', 'Service Berhasil Ditambahkan.');
            return redirect()->route('service');          
        }else{
            // die('gak ada');
            $no_img = 'no_image.png';

            $id = DB::table('cms_servicelist')->insertGetId([
                'name'            => $request->nama,
                'name_ch'            => $request->nama_ch,
                'slug'            => $request->slug,
                'description'     => $request->description,
                'description_ch'     => $request->description_ch,
                'details'         => $request->details,
                'details_ch'         => $request->details_ch,
                'contact_person'  => $request->contact_person,
                'contact_person1'  => $request->contact_person1,
                'image'             => 'assets/compro/assets/frontend_assets/images/service/service/'.$no_img,
                'created_at'      => date('Y-m-d H:i:s')
            ]);

            // UPLOAD ATTACHMENT
            foreach (@$request->attachment ?? [] as $file) {
                $folder = 'uploads/attachment/services-list/' . $id;
                $filename = $file->getClientOriginalName();

                $file->move($folder, $filename);

                DB::table('cms_page_attachments')->insert([
                    'model' => 'services-list',
                    'model_id' => $id,
                    'file_name' => $filename,
                    'file_url' => $folder . '/' . $filename,
                ]);
            }             

            Session::flash('success', 'Service Berhasil Ditambahkan.');
            return redirect()->route('service');          
        }
    }

    public function edit($id){
        $contacts = DB::table('cms_service_contact')
        ->orderBy('name', 'ASC')
        ->get();
        $post = DB::table('cms_servicelist')
        ->where('service_id', $id)
        ->first();
        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();
        $attachment = DB::table('cms_page_attachments')
        ->where('model', 'services-list')
        ->where('model_id', $id)
        ->get();  
        return view('pages.cms_compro.service.service.edit')->with('contacts', $contacts)->with('post', $post)->with('attachment', $attachment)->with('setting', $setting);
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
            'nama_ch'            => 'required',
            'description'          => 'required',
            'description_ch'          => 'required',
            'details'          => 'required',
            'details_ch'          => 'required',
        ]);

        if($request->email != ""){
            $email = $request->email;
        }else{
            $email = '-';
        }
        if($request->linkedin != ""){
            $linkedin = $request->linkedin;
        }else{
            $linkedin = '-';
        }

        // return 'OK';

        if($request->get('image-data')){
            $name = time().'_service.png';
            $image_data = $request->get('image-data');
            $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image_data));
            $img = Image::make($info);
            $img->save('assets/compro/assets/frontend_assets/images/service/service/'.$name);
            // $post = CmsCareer::create([
            DB::table('cms_servicelist')->where('service_id', $id)->update([
                'name'            => $request->nama,
                'name_ch'            => $request->nama_ch,
                'slug'            => $request->slug,
                'description'     => $request->description,
                'description_ch'     => $request->description_ch,
                'details'         => $request->details,
                'details_ch'         => $request->details_ch,
                'contact_person'  => $request->contact_person,
                'contact_person1'  => $request->contact_person1,
                'image'           => 'assets/compro/assets/frontend_assets/images/service/service/'.$name,
                'updated_at'      => date('Y-m-d H:i:s')
            ]);

            // UPLOAD ATTACHMENT
            foreach (@$request->attachment ?? [] as $file) {
                $folder = 'uploads/attachment/services-list/' . $id;
                $filename = $file->getClientOriginalName();

                $file->move($folder, $filename);

                DB::table('cms_page_attachments')->insert([
                    'model' => 'services-list',
                    'model_id' => $id,
                    'file_name' => $filename,
                    'file_url' => $folder . '/' . $filename,
                ]);
            }

            Session::flash('success', 'Service Berhasil Diupdate.');
            return redirect()->route('service');          
        }else{
            // die('gak ada');

            DB::table('cms_servicelist')->where('service_id', $id)->update([
                'name'            => $request->nama,
                'name_ch'            => $request->nama_ch,
                'slug'            => $request->slug,
                'description'     => $request->description,
                'description_ch'     => $request->description_ch,
                'details'         => $request->details,
                'details_ch'         => $request->details_ch,
                'contact_person'  => $request->contact_person,
                'contact_person1'  => $request->contact_person1,
                'updated_at'      => date('Y-m-d H:i:s')
            ]); 

            // UPLOAD ATTACHMENT
            foreach (@$request->attachment ?? [] as $file) {
                $folder = 'uploads/attachment/services-list/' . $id;
                $filename = $file->getClientOriginalName();

                $file->move($folder, $filename);

                DB::table('cms_page_attachments')->insert([
                    'model' => 'services-list',
                    'model_id' => $id,
                    'file_name' => $filename,
                    'file_url' => $folder . '/' . $filename,
                ]);
            }           

            Session::flash('success', 'Service Berhasil Diupdate.');
            return redirect()->route('service');          
        }
    }

    public function delete($id){

        $post = CmsServicesList::find($id);
        $post->delete();

        Session::flash('success', 'Service Berhasil Dihapus');
        return redirect()->back();
    }


    public function deleteAttachment($id)
    {
        try{
            $file = DB::table('cms_page_attachments')->where('id', $id)->first(); 
            $filepath = 'uploads/attachment/' . $file->model . '/' . $file->model_id . '/' . $file->file_name;

            if(\File::exists(public_path($filepath))){
                \File::delete(public_path($filepath));
            }

            DB::table('cms_page_attachments')->where('id', $id)->delete();
        }catch(\Exception $e){
            return response()->json(['success' => false, 'msg' => 'Failed!']);
        }

        return response()->json(['success' => true, 'msg' => 'Success!']);
    }
}
