<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Crypt;
use Carbon\Carbon;
Use Session;
use Illuminate\Support\Facades\Mail;
use Hash;

class WebsiteController extends Controller
{
    public function aktifiasi($email, $idjob)
    {
        return view('aktifiasi')->with('email', $email)->with('idjob', $idjob);
    }
    
    public function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    
    public function lupapassword()
    {
        return view('auth.passwords.email');
    }

    public function lupapasswordpost(Request $request) {
        //dd($request->all());
        
         $gnmuser = DB::table('users')
        ->select('first_name', 'last_name')
        ->where('email', $request->email)
        ->first();
        
        $pass = $this->generateRandomString(8);

        $new_password = Hash::make($pass);

        DB::table('users')->where('email', $request->email)->update([
            'password'           => $new_password
        ]);
        
        $data = array(
            'email'         => $request->email,
            'password'      => $pass,
            'name'          => $gnmuser->first_name." ".$gnmuser->last_name
        );
        
        $email_notif = $request->email;

        Mail::send('emails.resetpassword', $data, function ($message) use($email_notif) {
                $message->from('info@reandabernardi.com', 'Info')->subject('Reset Password | Reanda Bernardi');
                $message->to($email_notif);
                //$message->bcc('poeji.exact@gmail.com');
        });

        //return redirect()->url('/');
        return redirect()->route('home');
    }
}
