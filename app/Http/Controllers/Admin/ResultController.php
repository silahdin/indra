<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use Auth;
Use Session;

class ResultController extends Controller
{
    //1=AKtif; 2=Submit; 3=Interview; 4=Tolak
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function forms()
    {
        return view('admin.forms');
    }

    public function jobs()
    {
        return view('admin.jobs');
    }

    public function update()
    {
        return view('admin.update');
    }
    public function users()
    {
        $users = DB::table('tbl_test_user_target')
        ->select('users.first_name', 'users.last_name', 'users.email', 'tbl_test_user_target.id_target', 'users.id', 'users.st_user', 'cms_career.position', 'cms_career.jobdesk_in', 'cms_career.id AS idcareer', 'st_target')
        ->leftJoin('users', 'users.id', '=', 'tbl_test_user_target.users_id')
        ->leftJoin('cms_career', 'cms_career.id', '=', 'tbl_test_user_target.id_career')
        ->whereIn('tbl_test_user_target.st_target', [1,2,3,4])
        ->where('level', '=', 'user')
        ->where('tbl_test_user_target.id_career', '!=', '')
        ->orderBy('id_target', 'ASC')
        ->get();

        $set = array(
            'titles'        => 'Data Pelamar',
            'title'         => 'Data Pelamar',
        );
        
        return view('admin.user.index')->with('users', $users)->with($set);
    }

    public function baru()
    {
        $users = DB::table('tbl_test_user_target')
        ->select('users.first_name', 'users.last_name', 'users.email', 'tbl_test_user_target.id_target', 'users.id', 'users.st_user', 'cms_career.position', 'cms_career.jobdesk_in', 'cms_career.id AS idcareer', 'st_target')
        ->leftJoin('users', 'users.id', '=', 'tbl_test_user_target.users_id')
        ->leftJoin('cms_career', 'cms_career.id', '=', 'tbl_test_user_target.id_career')
        ->whereIn('tbl_test_user_target.st_target', [2])
        ->where('level', '=', 'user')
        ->where('tbl_test_user_target.id_career', '!=', '')
        ->orderBy('id_target', 'ASC')
        ->get();

        $set = array(
            'titles'        => 'Data Pelamar - Submit',
            'title'         => 'Data Pelamar',
        );
        
        return view('admin.user.index')->with('users', $users)->with($set);
    }

    public function submit()
    {
        $users = DB::table('tbl_test_user_target')
        ->select('users.first_name', 'users.last_name', 'users.email', 'tbl_test_user_target.id_target', 'users.id', 'users.st_user', 'cms_career.position', 'cms_career.jobdesk_in', 'cms_career.id AS idcareer', 'st_target')
        ->leftJoin('users', 'users.id', '=', 'tbl_test_user_target.users_id')
        ->leftJoin('cms_career', 'cms_career.id', '=', 'tbl_test_user_target.id_career')
        ->whereIn('tbl_test_user_target.st_target', [2])
        ->where('level', '=', 'user')
        ->where('tbl_test_user_target.id_career', '!=', '')
        ->orderBy('id_target', 'ASC')
        ->get();

        $set = array(
            'titles'        => 'Data Pelamar - Submit',
            'title'         => 'Data Pelamar',
        );
        
        return view('admin.user.index')->with('users', $users)->with($set);
    }

    public function interview()
    {
        $users = DB::table('tbl_test_user_target')
        ->select('users.first_name', 'users.last_name', 'users.email', 'tbl_test_user_target.id_target', 'users.id', 'users.st_user', 'cms_career.position', 'cms_career.jobdesk_in', 'cms_career.id AS idcareer', 'st_target')
        ->leftJoin('users', 'users.id', '=', 'tbl_test_user_target.users_id')
        ->leftJoin('cms_career', 'cms_career.id', '=', 'tbl_test_user_target.id_career')
        ->whereIn('tbl_test_user_target.st_target', [3])
        ->where('level', '=', 'user')
        ->where('tbl_test_user_target.id_career', '!=', '')
        ->orderBy('id_target', 'ASC')
        ->get();

        $set = array(
            'titles'        => 'Data Pelamar - Interview',
            'title'         => 'Data Pelamar',
        );
        
        return view('admin.user.index')->with('users', $users)->with($set);
    }

    public function tolak()
    {
        $users = DB::table('tbl_test_user_target')
        ->select('users.first_name', 'users.last_name', 'users.email', 'tbl_test_user_target.id_target', 'users.id', 'users.st_user', 'cms_career.position', 'cms_career.jobdesk_in', 'cms_career.id AS idcareer', 'st_target')
        ->leftJoin('users', 'users.id', '=', 'tbl_test_user_target.users_id')
        ->leftJoin('cms_career', 'cms_career.id', '=', 'tbl_test_user_target.id_career')
        ->whereIn('tbl_test_user_target.st_target', [4])
        ->where('level', '=', 'user')
        ->where('tbl_test_user_target.id_career', '!=', '')
        ->orderBy('id_target', 'ASC')
        ->get();

        $set = array(
            'titles'        => 'Data Pelamar - Rejected',
            'title'         => 'Data Pelamar',
        );
        
        return view('admin.user.index')->with('users', $users)->with($set);
    }

    public function userresult($id){

        $users = DB::table('users')
        ->where('id', Crypt::decryptString($id))
        ->first();

    	return view('admin.user.detail')->with('users', $users);
    }

    public function acttolak($iduser, $idjob){

        $dtarget = DB::table('tbl_test_user_target')
        ->where('id_career', $idjob)
        ->where('users_id', $iduser)
        ->first();

        $utarget = DB::table('tbl_test_user_target')->where('id_target', $dtarget->id_target)->update(['st_target' => 4]);

        //return redirect()->route('result.baru');
        Session::flash('success', 'Status peserta berhasil di update menjadi Tolak');
        return redirect()->back();
    }

    public function actinterview($iduser, $idjob){

        $dtarget = DB::table('tbl_test_user_target')
        ->where('id_career', $idjob)
        ->where('users_id', $iduser)
        ->first();

        $utarget = DB::table('tbl_test_user_target')->where('id_target', $dtarget->id_target)->update(['st_target' => 3]);

        Session::flash('success', 'Status peserta berhasil di update menjadi Iterview');
        return redirect()->back();

    	//return redirect()->route('result.baru');
    }
    
}
