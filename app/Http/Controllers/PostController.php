<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
Use Session;
use App\Post;

class PostController extends Controller
{
    public function index()
    {
        $post = DB::table('posts')
        ->orderBy('id', 'ASC')
        ->get();
        
        return view('pages.admin.post.index')->with('posts', $post);
    }

    public function add()
    {        
        return view('pages.admin.post.add');
    }

    public function store(Request $request){
        
        $this->validate($request, [
      
            'title'             => 'required',
            'short_desc'        => 'required',
            'images'            => 'required|image',
            'description'       => 'required'
        ]);

        $featured = $request->images;

        $featured_new_name = time()."_".$featured->getClientOriginalName();

        $featured->move('uploads/page', $featured_new_name);
        
        
            $post = Post::create([
                'title'             => $request->title,
                'short_desc'        => $request->short_desc,
                'description'       => $request->description,
                'images'            => 'uploads/page/'.$featured_new_name,
                'slug_title'        => str_slug($request->title)
            ]);
        

        Session::flash('success', 'Page Berhasil Ditambahkan.');
        

        return redirect()->route('pages');
    }

    public function edit($id){

        $post = DB::table('posts')
        ->where('id', $id)
        ->first();
        
    	return view('pages.admin.post.edit')->with('post', $post);
    }

    public function update(Request $request, $id){

        $this->validate($request, [
      
            'title'             => 'required',
            'short_desc'        => 'required',
            'description'       => 'required',
            'st_post'           => 'required'
        ]);
        

        if($request->hasFile('images')){
            $featured = $request->images;

            $featured_new_name = time()."_".$featured->getClientOriginalName();

            $featured->move('uploads/page', $featured_new_name);
            
            DB::table('posts')->where('id', $id)->update([
                'title'             => $request->title, 
                'slug_title'        => str_slug($request->title),
                'images'            => 'uploads/page/'.$featured_new_name,
                'short_desc'        => $request->short_desc, 
                'description'       => $request->description,
                'st_post'           => $request->st_post
                ]);

            @unlink("./".$request->image_old);

        } else {

            DB::table('posts')->where('id', $id)->update([
                'title'             => $request->title, 
                'slug_title'        => str_slug($request->title),
                'short_desc'        => $request->short_desc, 
                'description'       => $request->description,
                'st_post'           => $request->st_post
                ]);

        }

    	Session::flash('success', 'Page Berhasil Diupdate.');
    	return redirect()->route('pages');
    }

    public function delete($id){
    	$post = Post::find($id);
        $post->delete();

    	Session::flash('success', 'Page Berhasil Dihapus');
    	return redirect()->back();
    }
}
