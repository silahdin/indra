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


class AdminFaqController extends Controller{

    public function index(){
        // return view('pages.admin.inbox.index')->with('inbox', $inbox);
        $post = DB::table('new_cms_career_faq')
        ->join('new_cms_career_faq_group', 'new_cms_career_faq.group_id', 'new_cms_career_faq_group.id')
        ->orderBy('new_cms_career_faq.id', 'ASC')
        ->select('new_cms_career_faq.*', 'new_cms_career_faq_group.group as group_name')
        ->get();

        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();  

        return view('pages.cms_compro.faq.index')->with('posts', $post)->with('setting', $setting);
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
        return view('pages.cms_compro.faq.add')->with('setting', $setting);
    }

    public function store(Request $request){

        DB::table('new_cms_career_faq')->insert([
            'group_id'            => $request->group_id,
            'question'            => $request->question,
            'answer'            => $request->answer,
        ]);            

        Session::flash('success', 'FAQ Successfully Added.');
        return redirect()->route('faq');          
    }

    public function edit($id){
        $post = DB::table('new_cms_career_faq')
        ->join('new_cms_career_faq_group', 'new_cms_career_faq.group_id', 'new_cms_career_faq_group.id')
        ->where('new_cms_career_faq.id', $id)
        ->select('new_cms_career_faq.*', 'new_cms_career_faq_group.group as group_name')
        ->first();

        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();  
        return view('pages.cms_compro.faq.edit')->with('post', $post)->with('setting', $setting);
    }


    public function update(Request $request, $id){
      
        DB::table('new_cms_career_faq')->where('id', $id)->update([
            'group_id'            => $request->group_id,
            'question'            => $request->question,
            'answer'            => $request->answer,
        ]);

        Session::flash('success', 'FAQ Successfully Diupdate.');
        return redirect()->route('faq');         

    }

    public function delete($id){
        $post = DB::table('new_cms_career_faq')->where('id', $id)->delete();

        Session::flash('success', 'FAQ Successfully Deleted');
        return redirect()->back();
    }
}
