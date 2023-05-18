<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use DB;
Use Session;
use Auth;
use App\User;
use App\CmsLeader;
use Hash;
use Image;


class AdminLeadersController extends Controller
{
    //
    public function index(){
        $leaders = DB::table('cms_leaders')
        ->orderBy('urutan', 'ASC')
        ->get();
        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();  
        return view('pages.cms_compro.leaders.index')->with('leaders', $leaders)->with('setting', $setting);
    }

    public function add(){
        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();       
        return view('pages.cms_compro.leaders.add')->with('setting', $setting);
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
            'urutan'          => 'required',
            'summary_preview' => 'required',
            'full_summary'    => 'required',
            'edu_cert'        => 'required',
            'expertise'       => 'required',
            'industries'      => 'required',
            'pro_societies'   => 'required',
        ]);

        // echo "<pre>";
        // print_r($_POST);
        // echo "</pre>";
        // die(); 
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
        if($request->get('image-data')){
            $name = time().'_leader.png';
            $image_data = $request->get('image-data');
            $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image_data));
            $img = Image::make($info);
            $img->save('assets/compro/assets/frontend_assets/images/leader/'.$name);
            // $post = CmsCareer::create([
            DB::table('cms_leaders')->insert([
                'nama'            => $request->nama,
                'jabatan'         => $request->jabatan,
                'linkedin'        => $linkedin,
                'email'           => $email,
                'urutan'          => $request->urutan,
                'summary_preview' => $request->summary_preview,
                'full_summary'    => $request->full_summary,
                'edu_cert'        => $request->edu_cert,
                'industries'      => $request->industries,
                'expertise'       => $request->expertise,
                'pro_societies'   => $request->pro_societies,
                'img'             => 'assets/compro/assets/frontend_assets/images/leader/'.$name,
                'created_at'      => date('Y-m-d H:i:s')
            ]);

            Session::flash('success', 'Leader Berhasil Ditambahkan.');
            return redirect()->route('leader');          
        }else{
            // die('gak ada');
            $no_img = 'no_image.png';

            DB::table('cms_leaders')->insert([
                'nama'            => $request->nama,
                'jabatan'         => $request->jabatan,
                'linkedin'        => $linkedin,
                'email'           => $email,
                'urutan'          => $request->urutan,
                'summary_preview' => $request->summary_preview,
                'full_summary'    => $request->full_summary,
                'expertise'       => $request->expertise,
                'edu_cert'        => $request->edu_cert,
                'industries'      => $request->industries,
                'pro_societies'   => $request->pro_societies,
                'img'             => 'assets/compro/assets/frontend_assets/images/leader/'.$no_img,
                'created_at'      => date('Y-m-d H:i:s')
            ]);            

            Session::flash('success', 'Leader Berhasil Ditambahkan.');
            return redirect()->route('leader');          
        }
    }

    public function edit($id){
        $post = DB::table('cms_leaders')
        ->where('leader_id', $id)
        ->first();
        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();  
        return view('pages.cms_compro.leaders.edit')->with('post', $post)->with('setting', $setting);
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
            'jabatan'         => 'required',
            'urutan'          => 'required',
            'summary_preview' => 'required',
            'full_summary'    => 'required',
            'edu_cert'        => 'required',
            'expertise'       => 'required',
            'industries'      => 'required',
            'pro_societies'   => 'required',
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

        if($request->get('image-data')){
            $name = time().'_leader.png';
            $image_data = $request->get('image-data');
            $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image_data));
            $img = Image::make($info);
            $img->save('assets/compro/assets/frontend_assets/images/leader/'.$name);
            // $post = CmsCareer::create([
            DB::table('cms_leaders')->where('leader_id', $id)->update([
                'nama'            => $request->nama,
                'nama_ch'            => $request->nama_ch,
                'jabatan'         => $request->jabatan,
                'jabatan_ch'         => $request->jabatan_ch,
                'linkedin'        => $linkedin,
                'email'           => $email,
                'urutan'          => $request->urutan,
                'summary_preview' => $request->summary_preview,
                'summary_preview_ch' => $request->summary_preview_ch,
                'full_summary'    => $request->full_summary,
                'full_summary_ch'    => $request->full_summary_ch,
                'edu_cert'        => $request->edu_cert,
                'edu_cert_ch'        => $request->edu_cert_ch,
                'industries'      => $request->industries,
                'industries_ch'      => $request->industries_ch,
                'expertise'       => $request->expertise,
                'expertise_ch'       => $request->expertise_ch,
                'pro_societies'   => $request->pro_societies,
                'pro_societies_ch'   => $request->pro_societies_ch,
                'img'             => 'assets/compro/assets/frontend_assets/images/leader/'.$name,
                'updated_at'      => date('Y-m-d H:i:s')
            ]);

            Session::flash('success', 'Leader Berhasil Diupdate.');
            return redirect()->route('leader');          
        }else{
            // die('gak ada');
            $no_img = 'no_image.png';

            DB::table('cms_leaders')->where('leader_id', $id)->update([
                'nama'            => $request->nama,
                'nama_ch'            => $request->nama_ch,
                'jabatan'         => $request->jabatan,
                'jabatan_ch'         => $request->jabatan_ch,
                'email'           => $email,
                'linkedin'        => $linkedin,
                'urutan'          => $request->urutan,
                'summary_preview' => $request->summary_preview,
                'summary_preview_ch' => $request->summary_preview_ch,
                'full_summary'    => $request->full_summary,
                'full_summary_ch'    => $request->full_summary_ch,
                'expertise'       => $request->expertise,
                'expertise_ch'       => $request->expertise_ch,
                'edu_cert'        => $request->edu_cert,
                'edu_cert_ch'        => $request->edu_cert_ch,
                'industries'      => $request->industries,
                'industries_ch'      => $request->industries_ch,
                'pro_societies'   => $request->pro_societies,
                'pro_societies_ch'   => $request->pro_societies_ch,
                'updated_at'      => date('Y-m-d H:i:s')
            ]);            

            Session::flash('success', 'Leader Berhasil Diupdate.');
            return redirect()->route('leader');          
        }
    }

    public function delete($id){

        $post = CmsLeader::find($id);
        $post->delete();

        Session::flash('success', 'Leader Berhasil Dihapus');
        return redirect()->back();
    }

}
