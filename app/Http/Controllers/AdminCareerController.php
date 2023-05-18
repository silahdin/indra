<?php

namespace App\Http\Controllers;

use App\CmsCareer;
use App\Filters\CmsCareerFilters;
use App\User;
use Auth;
use DB;
use Hash;
use Illuminate\Http\Request;
use Image;
use Illuminate\Support\Facades\Session;


class AdminCareerController extends Controller{

    public function index(){
        // return view('pages.admin.inbox.index')->with('inbox', $inbox);
        $post = DB::table('cms_career')
        ->orderBy('id', 'ASC')
        ->get();
        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();  
        $text = DB::table('new_cms_career_text')
        ->first();
        return view('pages.cms_compro.karir.index')->with('posts', $post)->with('setting', $setting)->with('text', $text);
    }

    public function data(CmsCareerFilters $filters)
    {
        return CmsCareer::filter($filters)->get();
    }

    public function add(){
        // $post = DB::table('cms_province')
        // ->get();    
        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();       
        return view('pages.cms_compro.karir.add')->with('setting', $setting);
    }

    public function store(Request $request){

        function slugify($text){
            // replace non letter or digits by -
            $text = preg_replace('~[^\pL\d]+~u', '-', $text);

            // transliterate
            $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
  
            // remove unwanted characters
            $text = preg_replace('~[^-\w]+~', '', $text);

            // trim
            $text = trim($text, '-');
  
            // remove duplicate -
            $text = preg_replace('~-+~', '-', $text);
  
            // lowercase
            $text = strtolower($text);
  
            if (empty($text)) {
              return 'n-a';
            }
            return $text;
          }

        function convert_tgl_to_db($tgl){
            //UBAH TANGGAL INPUTAN BIAR BISA MASUK KE DATABASE
            $tgl_1 = substr($tgl, 0,2);
            $tgl_2 = substr($tgl, 3,2);
            $tgl_3 = substr($tgl, 6,4);
            $total = $tgl_3.'-'.$tgl_2.'-'.$tgl_1;
            return $total;
        }

        $this->validate($request, [
            'position_en'             => 'required',
            'position_ch'             => 'required',
            'jobdesk_en'          => 'required',
            'jobdesk_ch'          => 'required',
            'detRole_en'          => 'required',
            'detRole_ch'          => 'required',
            'detRespon_en'          => 'required',
            'detRespon_ch'          => 'required',
            'detSkill_en'          => 'required',
            'detSkill_ch'          => 'required',
            'location_en'       => 'required',
            'location_ch'       => 'required',
            'date_start'          => 'required',
            'date_end'            => 'required',
            'rowstate'       => 'required'
        ]);

        if ( isset($request->url) ) {
            $slug = $request->url;
        }else{
            $slug = slugify($request->position_en);
        }
        // echo dateDB($request->date_end);
        // echo "<pre>";
        // print_r($_POST);
        // echo "</pre>";
        // die(); 

        if($request->get('image-data')){
            $name = time().'_career.png';
            $image_data = $request->get('image-data');
            $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image_data));
            $img = Image::make($info);
            $img->save('assets/compro/assets/frontend_assets/images/career/'.$name);
            // $post = CmsCareer::create([
            DB::table('cms_career')->insert([
                'url'                 => $slug,
                'img'               => 'assets/compro/assets/frontend_assets/images/career/'.$name,
                'position_en'            => $request->position_en,
                'position_ch'            => $request->position_ch,
                'jobdesk_en'          => $request->jobdesk_en,
                'jobdesk_ch'        => $request->jobdesk_ch,
                'detRole_en'        => $request->detRole_en,
                'detRole_ch'        => $request->detRole_ch,
                'detRespon_en'      => $request->detRespon_en,
                'detRespon_ch'      => $request->detRespon_ch,
                'detSkill_en'       => $request->detSkill_en,
                'detSkill_ch'       => $request->detSkill_ch,
                'location_en'          => $request->location_en,
                'location_ch'          => $request->location_ch,
                'date_start'        => convert_tgl_to_db($request->date_start),
                'date_end'          => convert_tgl_to_db($request->date_end),
                'rowstate'          => $request->rowstate,
                'created_at'        => date('Y-m-d H:i:s'),

                'detRole_in'        => $request->detRole_en,
                'detRespon_in'      => $request->detRespon_en,
                'detSkill_in'       => $request->detSkill_en,
                'position'            => $request->position_en,
                'jobdesk_in'        => $request->jobdesk_en,
                'location'          => $request->location_en,
            ]);

            Session::flash('success', 'Karir Berhasil Ditambahkan.');
            return redirect()->route('career');          
        }else{
            // die('gak ada');
            $no_img = 'no_image.png';

            DB::table('cms_career')->insert([
                'url'                 => $slug,
                'img'                 => 'assets/compro/assets/frontend_assets/images/career/'.$no_img,
                'position_en'            => $request->position_en,
                'position_ch'            => $request->position_ch,
                'jobdesk_en'          => $request->jobdesk_en,
                'jobdesk_ch'        => $request->jobdesk_ch,
                'detRole_en'        => $request->detRole_en,
                'detRole_ch'        => $request->detRole_ch,
                'detRespon_en'      => $request->detRespon_en,
                'detRespon_ch'      => $request->detRespon_ch,
                'detSkill_en'       => $request->detSkill_en,
                'detSkill_ch'       => $request->detSkill_ch,                 
                'location_en'          => $request->location_en,
                'location_ch'          => $request->location_ch,
                'date_start'        => convert_tgl_to_db($request->date_start),
                'date_end'          => convert_tgl_to_db($request->date_end),
                'rowstate'          => $request->rowstate,
                'created_at'        => date('Y-m-d H:i:s'),

                'detRole_in'        => $request->detRole_en,
                'detRespon_in'      => $request->detRespon_en,
                'detSkill_in'       => $request->detSkill_en,
                'position'            => $request->position_en,
                'jobdesk_in'        => $request->jobdesk_en,
                'location'          => $request->location_en,
            ]);            

            Session::flash('success', 'Career Successfully Updated.');
            return redirect()->route('career');          
        }
    }

    public function edit($id){
        $post = DB::table('cms_career')
        ->where('id', $id)
        ->first();
        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();  
        return view('pages.cms_compro.karir.edit')->with('post', $post)->with('setting', $setting);
    }

    public function editText(){
        $post = DB::table('new_cms_career_text')->first();

        // if(!$post)

        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();

        return view('pages.cms_compro.karir.text')->with('post', $post)->with('setting', $setting);
    }

    public function editTextPost(Request $request){
        $post = DB::table('new_cms_career_text')->first();

        if($post){
            DB::table('new_cms_career_text')->where('id', $post->id)->update(['text' => $request->careerText]);    
        }else{
            DB::table('new_cms_career_text')->insert(['text' => $request->careerText]);
        }

        return redirect()->route('career.text');
    }

    public function update(Request $request, $id){
       /* print_r($_POST);*/

        function convert_tgl_to_db($tgl){
            //UBAH TANGGAL INPUTAN BIAR BISA MASUK KE DATABASE
            $tgl_1 = substr($tgl, 0,2);
            $tgl_2 = substr($tgl, 3,2);
            $tgl_3 = substr($tgl, 6,4);
            $total = $tgl_3.'-'.$tgl_2.'-'.$tgl_1;
            return $total;
        }

        $this->validate($request, [
            'position_en'             => 'required',
            'position_ch'             => 'required',
            'jobdesk_en'          => 'required',
            'jobdesk_ch'          => 'required',
            'detRole_en'          => 'required',
            'detRole_ch'          => 'required',
            'detRespon_en'          => 'required',
            'detRespon_ch'          => 'required',
            'detSkill_en'          => 'required',
            'detSkill_ch'          => 'required',
            'location_en'       => 'required',
            'location_ch'       => 'required',
            'date_start'          => 'required',
            'date_end'            => 'required',
            'rowstate'       => 'required'
        ]);
        
    	// echo "<pre>";
     //    print_r($_POST);
     //    echo "</pre>";
     //    die();      
        
        if($request->get('image-data')){
            $name = time().'_career.png';

            $image_data = $request->get('image-data');
            $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image_data));
            $img = Image::make($info);
            $img->save('assets/compro/assets/frontend_assets/images/career/'.$name);

            DB::table('cms_career')->where('id', $id)->update([
                'img'          => 'assets/compro/assets/frontend_assets/images/career/'.$name,
                'url'               => $request->url,
                'position_en'            => $request->position_en,
                'position_ch'            => $request->position_ch,
                'jobdesk_en'          => $request->jobdesk_en,
                'jobdesk_ch'        => $request->jobdesk_ch,
                'jobdesk_en'        => $request->jobdesk_en,
                'detRole_ch'        => $request->detRole_ch,
                'detRole_en'        => $request->detRole_en,
                'detRespon_ch'      => $request->detRespon_en,
                'detRespon_en'      => $request->detRespon_ch,
                'detSkill_ch'       => $request->detSkill_en,
                'detSkill_en'       => $request->detSkill_ch,                 
                'location_en'          => $request->location_en,
                'location_ch'          => $request->location_ch,
                'date_start'        => convert_tgl_to_db($request->date_start),
                'date_end'          => convert_tgl_to_db($request->date_end),
                'rowstate'          => $request->rowstate,
                'updated_at'        => date('Y-m-d H:i:s'),

                'detRole_in'        => $request->detRole_en,
                'detRespon_in'      => $request->detRespon_en,
                'detSkill_in'       => $request->detSkill_en,
                'position'            => $request->position_en,
                'jobdesk_in'        => $request->jobdesk_en,
                'location'          => $request->location_en,
                // ''        => date('Y-m-d')
            ]);
    
            Session::flash('success', 'Karir Berhasil Diupdate.');
            return redirect()->route('career');        
        }else{

            DB::table('cms_career')->where('id', $id)->update([
                'url'               => $request->url,
                'position_en'            => $request->position_en,
                'position_ch'            => $request->position_ch,
                'jobdesk_en'          => $request->jobdesk_en,
                'jobdesk_ch'        => $request->jobdesk_ch,
                'jobdesk_en'        => $request->jobdesk_en,
                'detRole_ch'        => $request->detRole_ch,
                'detRole_en'        => $request->detRole_en,
                'detRespon_ch'      => $request->detRespon_ch,
                'detRespon_en'      => $request->detRespon_en,
                'detSkill_ch'       => $request->detSkill_ch,
                'detSkill_en'       => $request->detSkill_en,                 
                'location_en'          => $request->location_en,
                'location_ch'          => $request->location_ch,
                'date_start'        => convert_tgl_to_db($request->date_start),
                'date_end'          => convert_tgl_to_db($request->date_end),
                'rowstate'          => $request->rowstate,
                'updated_at'        => date('Y-m-d H:i:s'),

                'detRole_in'        => $request->detRole_en,
                'detRespon_in'      => $request->detRespon_en,
                'detSkill_in'       => $request->detSkill_en,
                'position'            => $request->position_en,
                'jobdesk_in'        => $request->jobdesk_en,
                'location'          => $request->location_en,

                ]);
    
            Session::flash('success', 'Karir Berhasil Diupdate.');
            return redirect()->route('career');        
        }     

    }

    public function delete($id){
        $post = CmsCareer::find($id);
        $post->delete();

        Session::flash('success', 'Karir Berhasil Dihapus');
        return redirect()->back();
    }
}
