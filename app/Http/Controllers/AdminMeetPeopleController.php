<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Carbon\Carbon;
use DB;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Image;
use Illuminate\Support\Facades\Crypt;


class AdminMeetPeopleController extends Controller{

    public function index(){
        // return view('pages.admin.inbox.index')->with('inbox', $inbox);
        $post = DB::table('new_cms_meet_peoples')
        ->orderBy('id', 'ASC')
        ->get();

        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();

        return view('pages.cms_compro.meet_people.index')->with('posts', $post)->with('setting', $setting);
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
        return view('pages.cms_compro.meet_people.add')->with('setting', $setting);
    }

    public function store(Request $request){

        if($request->hasFile('file')){
            
            $file = $request->file('file');

            $name = time().'_meetPeople.'.$file->getClientOriginalExtension();
            $destinationPath = 'assets/compro/assets/frontend_assets/images/meet_people';
            $file->move($destinationPath, $name);


            DB::table('new_cms_meet_peoples')->insert([
                'image_url'               => $destinationPath.'/'.$name,
                'name'            => $request->name,
                'position'            => $request->position,
                'words'            => $request->words,
                'status'            => $request->status,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ]);

            Session::flash('success', 'Our People Berhasil Ditambahkan.');
            return redirect()->route('meet.people');          
        }else{

            DB::table('new_cms_meet_peoples')->insert([
                'name'            => $request->name,
                'position'            => $request->position,
                'words'            => $request->words,
                'status'            => $request->status,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ]);            

            Session::flash('success', 'Our People Successfully Updated.');
            return redirect()->route('meet.people');          
        }         
    }

    public function edit($id){
        $post = DB::table('new_cms_meet_peoples')
        ->where('id', $id)
        ->first();
        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();  
        return view('pages.cms_compro.meet_people.edit')->with('post', $post)->with('setting', $setting);
    }


    public function update(Request $request, $id){
      
        if($request->hasFile('file')){
            
            $file = $request->file('file');

            $name = time().'_meetPeople.'.$file->getClientOriginalExtension();
            $destinationPath = 'assets/compro/assets/frontend_assets/images/meet_people';
            $file->move($destinationPath, $name);


            DB::table('new_cms_meet_peoples')->where('id', $id)->update([
                'image_url'               => $destinationPath.'/'.$name,
                'name'            => $request->name,
                'position'            => $request->position,
                'words'            => $request->words,
                'status'            => $request->status,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ]);

            Session::flash('success', 'Our People Berhasil Ditambahkan.');
            return redirect()->route('meet.people');          
        }else{

            DB::table('new_cms_meet_peoples')->where('id', $id)->update([
                'name'            => $request->name,
                'position'            => $request->position,
                'words'            => $request->words,
                'status'            => $request->status,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ]);            

            Session::flash('success', 'Our People Successfully Updated.');
            return redirect()->route('meet.people');          
        }         

    }

    public function delete($id){
        $post = DB::table('new_cms_meet_peoples')->where('id', $id)->delete();

        Session::flash('success', 'Our People Successfully Deleted');
        return redirect()->back();
    }

    public function detail($id){

        $decId = '';

        try{
            $decId = Crypt::decrypt($id);
        }catch(\Exception $e){
            return redirect()->back();
        }

        $people = DB::table('new_cms_meet_peoples')->where('id', $decId)->first();

        if(!$people) return redirect()->back();

        $title = new \stdClass();
        $title->title_in = 'Meet Our People - ' . $people->name;
        $title->title_en = 'Meet Our People - ' . $people->name;

        $footer = DB::table('cms_contact')
        ->where('id', 1)
        ->first();

        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();

        $produk = DB::table('cms_contact')
        ->where('id', 1)
        ->first();

        $serv = DB::table('cms_servicelist')
        ->orderBy('name', 'ASC')
        ->get();


        return view('pages.cms_compro.meet_people.detail')->with('servs', $serv)->with('produk', $produk)->with('setting', $setting)->with('footer', $footer)->with('title', $title)->with('people', $people);
      }
}
