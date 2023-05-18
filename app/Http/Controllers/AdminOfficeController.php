<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
Use Session;
use Auth;
use App\User;
use App\CmsDirectory;
use App\CmsCountry;
use App\CmsGlobalOffice;
use Hash;
use Image;


class AdminOfficeController extends Controller
{
    
    public function index(){
        $gdir = DB::table('cms_directory')
        ->leftJoin('cms_country', 'cms_country.directory_id', '=', 'cms_directory.directory_id')
        ->orderBy('cms_directory.directory_id', 'ASC')
        ->get();
        
        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();  
        return view('pages.cms_compro.office.index')->with('files',$gdir)->with('setting', $setting);
    }

    public function detail($id){
        $gdir = DB::table('cms_global_list')
        ->where('country_id', $id)
        ->orderBy('cms_global_list.global_list_id', 'ASC')
        ->get();
        
        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();  
        return view('pages.cms_compro.office.list')->with('files',$gdir)->with('setting', $setting)->with('id', $id);
    }

    public function detail_add($id){
        
        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();    

        return view('pages.cms_compro.office.list_add')->with('setting', $setting)->with('id', $id);
    }

    public function detail_store(Request $request, $id){

        $this->validate($request, [
             'content'            => 'required',
             'category'     => 'required',
            // 'details'          => 'required',
        ]);

            DB::table('cms_global_list')->insert([
                'country_id'      => $id,
                'category'      => $request->category,
                'content'      => $request->content,
                'created_at'      => date('Y-m-d H:i:s')
            ]);
            
            
            Session::flash('success', 'Office Berhasil Ditambahkan.');
            return redirect()->route('office.detail', ['id' => $id]);   //{{ route('office.detail', ['id' => $file->country_id]) }}         
        
    }

    public function detail_edit($id){
       
        $dir = DB::table('cms_global_list')
        ->where('global_list_id', $id)
        ->first();
        
        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();  
        return view('pages.cms_compro.office.list_edit')->with('dir', $dir)->with('setting', $setting)->with('id', $id);
    }

    public function detail_update(Request $request, $id){
        
        $this->validate($request, [
            'content'            => 'required',
             'category'     => 'required',
        ]);

            DB::table('cms_global_list')->where('global_list_id', $id)->update([
                'country_id'      => $request->country_id,
                'category'      => $request->category,
                'content'      => $request->content,
                'updated_at'      => date('Y-m-d H:i:s')
            ]);

            Session::flash('success', 'Sub Service Berhasil Diupdate.'.$request->nama);
            return redirect()->route('office.detail', ['id' => $request->country_id]);
    }

    public function detail_delete( $id){

        $post = DB::table('cms_global_list')
        ->where('global_list_id', $id)
        ->delete();

        Session::flash('success', 'Office Berhasil Dihapus');
        return redirect()->back();
        // return redirect()->back()->with('country', $country)->with('dirs', $dir);
    }

    //=================================================================================================================

    public function add(){
        
        $dir = DB::table('cms_directory')
        ->get();
        $country = DB::table('cms_country')
        ->orderBy('country_id', 'ASC')
        ->get();
        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();       
        return view('pages.cms_compro.office.add')->with('country', $country)->with('dirs', $dir)->with('setting', $setting);
    }
    
    public function store(Request $request){

        $this->validate($request, [
            // 'nama'            => 'required',
            // 'description'     => 'required',
            // 'details'          => 'required',
        ]);

        
            DB::table('cms_country')->insert([
                'directory_id'      => $request->dir,
                'country'      => $request->country,
                'website'      => $request->website,
            ]);
            
            
            Session::flash('success', 'Office Berhasil Ditambahkan.');
            return redirect()->route('office');           
        
    }

    public function edit($id){
       
        $dir = DB::table('cms_directory')
        ->get();
        $country = DB::table('cms_country')
        ->orderBy('country_id', 'ASC')
        ->get();
          
        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();  
        return view('pages.cms_compro.office.edit')->with('country', $country)->with('dirs', $dir)->with('setting', $setting)->with('id', $id);
    }

    public function update(Request $request, $id){
        

        $this->validate($request, [
            // 'nama'            => 'required',
        ]);

            DB::table('cms_country')->where('country_id', $id)->update([
                'directory_id'      => $request->dir,
                'country'      => $request->country,
                'website'      => $request->website,
            ]);

            Session::flash('success', 'Sub Service Berhasil Diupdate.'.$request->nama);
            return redirect()->route('office');     
    }

    public function delete( $id){

        $post = DB::table('cms_country')
        ->where('country_id', $id)
        ->delete();

        Session::flash('success', 'Office Berhasil Dihapus');
        return redirect()->route('office'); 
        // return redirect()->back()->with('country', $country)->with('dirs', $dir);
    }
}
