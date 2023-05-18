<?php

namespace App\Http\Controllers;

use App\Filters\NewCmsCareerFaqGroupFilters;
use App\Models\NewCmsCareerFaqGroup;
use App\User;
use Auth;
use DB;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Image;


class AdminFaqGroupController extends Controller{

    public function index(){
        // return view('pages.admin.inbox.index')->with('inbox', $inbox);
        $post = DB::table('new_cms_career_faq_group')
        ->orderBy('id', 'ASC')
        ->get();
        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();  

        return view('pages.cms_compro.faq_group.index')->with('posts', $post)->with('setting', $setting);
    }

    public function data(NewCmsCareerFaqGroupFilters $filters)
    {
        return NewCmsCareerFaqGroup::filter($filters)->get();
    }

    public function add(){
        // $post = DB::table('cms_province')
        // ->get();    
        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();       
        return view('pages.cms_compro.faq_group.add')->with('setting', $setting);
    }

    public function store(Request $request){

        DB::table('new_cms_career_faq_group')->insert([
            'group'            => $request->group,
        ]);            

        Session::flash('success', 'FAQ Group Successfully Added.');
        return redirect()->route('faq.group');          
    }

    public function edit($id){
        $post = DB::table('new_cms_career_faq_group')
        ->where('id', $id)
        ->first();
        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();  
        return view('pages.cms_compro.faq_group.edit')->with('post', $post)->with('setting', $setting);
    }


    public function update(Request $request, $id){
      
        DB::table('new_cms_career_faq_group')->where('id', $id)->update([
            'group'            => $request->group,
        ]);

        Session::flash('success', 'FAQ Group Successfully Diupdate.');
        return redirect()->route('faq.group');         

    }

    public function delete($id){
        $post = DB::table('new_cms_career_faq_group')->where('id', $id)->delete();

        Session::flash('success', 'FAQ Group Successfully Deleted');
        return redirect()->back();
    }
}
