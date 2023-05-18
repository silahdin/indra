<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

use DB;
Use Session;
use Auth;
use App\User;
use App\CmsContact;
use Hash;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;

class AdminExportExcelController extends Controller{
    

    public function export() 
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    public function import() 
    {
        Excel::import(new UsersImport, 'users.xlsx');
        return redirect('/')->with('success', 'All good!');
    }

    public function index(){
        $post = DB::table('cms_contact')
        ->where('id', 1)
        ->first();
        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();  
        return view('pages.cms_compro.contact.edit')->with('post', $post)->with('setting', $setting);
    }


}
