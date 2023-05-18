<?php

namespace App\Http\Controllers;
use App\User;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index()
    {
        $user = DB::table('users')
        ->orderBy('id', 'DESC')
        ->get();

        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first(); 

        return view('pages.admin.user.index')->with('users', $user)->with('setting', $setting);
    }

    public function add()
    {
        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first(); 

        return view('pages.admin.user.add')->with('setting', $setting);
    }

    public function store(Request $request){

        $this->validate($request, [

            'first_name'        => 'required',
            'last_name'         => 'nullable',
            'gender'            => 'required',
            'email'             => 'required|email|unique:users',
            'password'          => 'required',
            'level'             => 'required',
            'st_user'           => 'required'
        ]);

        $user = User::create([
            'name'              => trim($request->first_name . ' ' .@$request->last_name),
            'first_name'             => $request->first_name,
            'last_name'             => $request->last_name,
            'birthday'          => Carbon::parse($request->birthday)->format('Y-m-d'),
            'gender'             => $request->gender,
            'email'             => $request->email,
            'password'          => Hash::make($request->password),
            'level'             => $request->level,
            'st_user'           => $request->st_user
        ]);

        Session::flash('success', 'User Berhasil Ditambahkan.');

        return redirect()->route('users');
    }

    public function edit($id){

        $users = DB::table('users')
        ->where('id', Crypt::decrypt($id))
        ->first();

         $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first(); 

    	return view('pages.admin.user.edit')->with('user', $users)->with('setting', $setting);
    }

    public function update(Request $request, $id){

        $this->validate($request, [

            'first_name'        => 'required',
            'last_name'         => 'nullable',
            'gender'            => 'required',
            'email'             => 'required|email|unique:users,email,'.Crypt::decrypt($id),
            'level'             => 'required',
            'st_user'           => 'required'
        ]);

        $user = User::find(Crypt::decrypt($id));

        $user->name           = trim($request->first_name . ' ' .@$request->last_name);
        $user->first_name          = $request->first_name;
        $user->last_name          = $request->last_name;
        $user->email          = $request->email;

        $user->level          = $request->level;
        $user->st_user          = $request->st_user;

        if($request->gender) $user->gender = $request->gender;
        if($request->birthday) $user->birthday = Carbon::parse($request->birthday)->format('Y-m-d');

        if($request->password){
            $user->password    = Hash::make($request->password);
        }

        $user->save();

    	Session::flash('success', 'User Berhasil Diupdate.');
    	return redirect()->route('users');
    }

    public function delete($id){

        $user = User::find($id);
        $user->delete();

    	Session::flash('success', 'User Berhasil Dihapus');
    	return redirect()->back();
    }
}
