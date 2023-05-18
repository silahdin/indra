<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use Auth;
Use Session;
use Illuminate\Support\Facades\Crypt;

class LokerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = DB::table('cms_career')
        ->orderBy('id', 'ASC')
        ->get();

        $set = array(
            'titles'        => 'Data Lowongan Pekerjaan',
            'title'         => 'Data Lowongan Pekerjaan',
        );
        
        return view('admin.loker.index')->with('users', $users)->with($set);
    }

    public function detail($id)
    {
        $users = DB::table('cms_career')
        ->where('id', Crypt::decryptString($id))
        ->first();

        $set = array(
            'titles'        => 'Detail Lowongan Pekerjaan',
            'title'         => 'Detail Lowongan Pekerjaan',
            'id'            => Crypt::decryptString($id),
            'position'      => $users->position
        );
        
        return view('admin.loker.detail')->with('users', $users)->with($set);
    }

    public function update(Request $request, $id) {
        dd($request->all());

        //DB::table('users')->where('id', $id)->delete();
        $count = (count($request->id_test));

        for ($i=0; $i < $count; $i++) {
          $dtest = ListTestJob::create([
              'id_career'       => $id,
              'id_test'      => $request->id_test[$i],
          ]);
        }
    }
}
