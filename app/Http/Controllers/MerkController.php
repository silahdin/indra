<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

use DB;
Use Session;
use App\MerkMobil;
use App\TypeMobil;

class MerkController extends Controller
{
  public function index()
  {
      $merk = DB::table('merk_mobil')
      ->orderBy('name', 'ASC')
      ->get();

      return view('pages.admin.merk.index')->with('merks', $merk);
  }

  public function add()
  {
      return view('pages.admin.merk.add');
  }

  public function store(Request $request){

      $this->validate($request, [
          'name'             => 'required',
          'images'            => 'required|image'
      ]);

      $featured = $request->images;
      $featured_new_name = time()."_".$featured->getClientOriginalName();
      $featured->move('uploads/logo', $featured_new_name);

          $merk = merk::create([
              'name'             => $request->name,
              'img'              => 'uploads/logo/'.$featured_new_name,
              'slug_name'        => str_slug($request->name)
          ]);

      Session::flash('success', 'Page Berhasil Ditambahkan.');
      return redirect()->route('pages');
  }

  public function edit($id){

      $merk = DB::table('merk_mobil')
      ->where('id', Crypt::decryptString($id))
      ->first();

    return view('pages.admin.merk.edit')->with('merk', $merk);
  }

  public function update(Request $request, $id){

      $this->validate($request, [
          'name'             => 'required'
      ]);


      if($request->hasFile('images')){
          $featured = $request->images;
          $featured_new_name = time()."_".$featured->getClientOriginalName();
          $featured->move('uploads/mobil', $featured_new_name);

          DB::table('merk_mobil')->where('id', Crypt::decryptString($id))->update([
              'name'              => $request->name,
              'img'               => 'uploads/mobil/'.$featured_new_name,
              'slug_name'         => str_slug($request->name)
              ]);
      } else {

          DB::table('merk_mobil')->where('id', Crypt::decryptString($id))->update([
            'name'                => $request->name,
            'slug_name'           => str_slug($request->name)
          ]);
      }

    Session::flash('success', 'Page Berhasil Diupdate.');
    return redirect()->route('merks');
  }

  public function delete($id){
    $merk = Merk::find($id);
    $merk->delete();

    Session::flash('success', 'Page Berhasil Dihapus');
    return redirect()->back();
  }

  //Type ==================================================================================
  public function type($id){

      $type = DB::table('type_mobil')
      ->select('type_mobil.name as type', 'type_mobil.id', 'merk_mobil.name as merk')
      ->leftJoin('merk_mobil', 'merk_mobil.id', '=', 'type_mobil.merk_id')
      ->where('merk_id', Crypt::decryptString($id))
      ->get();

      $merk = DB::table('merk_mobil')
      ->where('id', Crypt::decryptString($id))
      ->first();

      $merk_id = Crypt::decryptString($id);
    return view('pages.admin.merk.type')->with('types', $type)->with('merk_id', $merk_id)->with('title', $merk);
  }

  public function addtype($id){
    $merk = DB::table('merk_mobil')
    ->select('name')
    ->where('id', Crypt::decryptString($id))
    ->first();

    $merk_id = Crypt::decryptString($id);

    return view('pages.admin.merk.addtype')->with('merk_id', $merk_id)->with('merk', $merk);
  }

  public function storetype(Request $request){

      $this->validate($request, [
          'name'    => 'required'
      ]);

      $mobil = TypeMobil::create([
            'merk_id'           => $request->merk,
            'name'              => $request->name
        ]);

      Session::flash('success', 'Type Merk Mobil Berhasil Ditambahkan.');


      return redirect()->route('merk.type', [Crypt::encryptString($request->merk)]);
  }

  public function edittype($id){

      $type = DB::table('type_mobil')
      ->where('id', Crypt::decryptString($id))
      ->first();

      $merk = DB::table('merk_mobil')
      ->select('merk_mobil.name', 'merk_mobil.id')
      ->leftJoin('type_mobil', 'type_mobil.merk_id', '=', 'merk_mobil.id')
      ->where('type_mobil.id', Crypt::decryptString($id))
      ->first();

    return view('pages.admin.merk.edittype')->with('type', $type)->with('merk', $merk);
  }

  public function updatetype(Request $request, $id){

      $this->validate($request, [
          'name'          => 'required'
      ]);

      $type = TypeMobil::find(Crypt::decryptString($id));
      $type->name            = $request->name;
      $type->save();

    Session::flash('success', 'Type Merk Mobil Berhasil Diupdate.');
    return redirect()->route('merk.type', [Crypt::encryptString($request->merk)]);
  }

  public function deletetype($id){
    $type = TypeMobil::find(Crypt::decryptString($id));
    $type->delete();

    Session::flash('success', 'Type Merk Mobil Berhasil Dihapus');
    return redirect()->back();
  }

}
