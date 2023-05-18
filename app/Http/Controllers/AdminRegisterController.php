<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
Use Session;
use Auth;
use App\User;
use App\CmsTrainRegis;

use App\CmsTrainPayment;
use Hash;
use Image;

class AdminRegisterController extends Controller{

    public function index(){
        $post = DB::table('cms_train_regis')
        ->select('cms_train_regis.*' ,'cms_training.title_in', 'cms_training_class.class_name_in', 'cms_training_time.day_in' )
        ->leftJoin('cms_training', 'cms_training.id', '=', 'cms_train_regis.id_train')
        ->leftJoin('cms_training_class', 'cms_training_class.id', '=', 'cms_train_regis.id_class')
        ->leftJoin('cms_training_time', 'cms_training_time.id', '=', 'cms_train_regis.id_schedule')
        ->orderBy('cms_train_regis.id', 'DESC')
        ->where('cms_train_regis.rowstate', '!=', '4')
        ->get(); 

        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();  

        return view('pages.cms_compro.register.index')->with('posts', $post)->with('setting', $setting);
    }
        
    public function confirmed(){

        $post = DB::table('cms_train_regis')
        ->select('cms_train_regis.*' ,'cms_training.title_in', 'cms_training_class.class_name_in', 'cms_training_time.day_in' )
        ->leftJoin('cms_training', 'cms_training.id', '=', 'cms_train_regis.id_train')
        ->leftJoin('cms_training_class', 'cms_training_class.id', '=', 'cms_train_regis.id_class')
        ->leftJoin('cms_training_time', 'cms_training_time.id', '=', 'cms_train_regis.id_schedule')
        ->orderBy('cms_train_regis.id', 'DESC')
        ->where('cms_train_regis.rowstate', '=', '4')
        ->get();


        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();  

        return view('pages.cms_compro.register.confirmed')->with('posts', $post)->with('setting', $setting);
    }

    public function add(){
        $cat = DB::table('cms_training')
        ->orderBy('id', 'ASC')
        ->get();  
        $class = DB::table('cms_training_class')
        ->orderBy('id', 'ASC')
        ->get(); 
        $time = DB::table('cms_training_time')
        ->orderBy('id', 'ASC')
        ->get();                         
        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();
        return view('pages.cms_compro.register.add')->with('setting', $setting)->with('cat', $cat);
    }

    public function store(Request $request){
        // print_r($_POST);
        // die();   
      
        
        $this->validate($request, [
            // 'url'       => 'required',
            'rowstate'       => 'required',
        ]);

        Session::flash('success', 'Client Berhasil Ditambahkan.');
        return redirect()->route('register');

    }

    public function edit($id){

        $post = DB::table('cms_register')
        ->where('id', $id)
        ->first();
        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();          
        
        return view('pages.cms_compro.register.edit')->with('post', $post)->with('setting', $setting);
    }

    public function detail($id){

        $post = DB::table('cms_train_regis')
        ->select('cms_train_regis.*' ,'cms_training.title_in', 'cms_training_class.class_name_in', 'cms_training_time.day_in' )
        ->leftJoin('cms_training', 'cms_training.id', '=', 'cms_train_regis.id_train')
        ->leftJoin('cms_training_class', 'cms_training_class.id', '=', 'cms_train_regis.id_class')
        ->leftJoin('cms_training_time', 'cms_training_time.id', '=', 'cms_train_regis.id_schedule')
        ->orderBy('cms_train_regis.id', 'DESC')
        ->where('cms_train_regis.id', $id)
        ->first();

        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();          
        
        return view('pages.cms_compro.register.detail')->with('post', $post)->with('setting', $setting);
    }


    public function confirm($id){

        DB::table('cms_train_regis')->where('id', $id)->update([
            'rowstate'          => 4,
            'updated_at'        => date('Y-m-d H:i:s')
        ]);

         Session::flash('success', 'Peserta Berhasil Dikonfirmasi.');
        return redirect()->route('register');
    }

    public function payment($id){
        $post = DB::table('cms_train_regis')
        ->where('id', $id)
        ->first();

        $data = DB::table('cms_train_payment')
        ->where('id_train_regis', $id)
        ->get();

        // echo '<pre>';
        // // echo $payment;
        // print_r($data);
        // echo '</pre>';
        // die();

        $setting = DB::table('cms_setting')
        ->where('id', 1)
        ->first();

        return view('pages.cms_compro.register.payment')->with('post', $post)->with('setting', $setting)->with('data', $data);
    }

    public function paymentDo(Request $request, $id){
        
        function rupiahToNumber($string){
        	$new = substr($string, 4);
			return preg_replace("/([^0-9])/i", "", $new);			
        }
        $this->validate($request, [
            // 'url'       => 'required',
            'payment'       => 'required',
        ]);
        
        $post = CmsTrainPayment::create([
            'id_train_regis'          => $id,
            'pay'               => rupiahToNumber($request->payment),
            'rowstate'          => 1,
            'created_at'        => date('Y-m-d h:i:s' )
        ]);

        $payAll = DB::table('cms_train_payment')
        ->select('cms_train_payment.pay')
        ->where('id_train_regis', '=', $id)
        ->get();
        
        
        $payment = 0; 
        foreach ($payAll as $key => $value) {
            $payment += $value->pay;
        }

        // echo '<pre>';
        // echo $payment;
        // print_r($payAll);
        // echo '</pre>';
        // die();

        DB::table('cms_train_regis')->where('id', $id)->update([
            'payment'          => $payment,
            'updated_at'        => date('Y-m-d H:i:s')
        ]);        

        Session::flash('success', 'Add payment done.');
        return redirect()->route('register');
    }



    public function update(Request $request, $id){
        // print_r($_POST);
        // die();      

        $this->validate($request, [
            // 'url'       => 'required',
            'rowstate'       => 'required',
        ]);

        Session::flash('success', 'Something Wrong.');
        return redirect()->route('register');
    }

    public function delete($id){
        $post = CmsTrainRegis::find($id);
        $post->delete();

        Session::flash('success', 'Peserta Berhasil Dihapus');
        return redirect()->back();
    }

}
