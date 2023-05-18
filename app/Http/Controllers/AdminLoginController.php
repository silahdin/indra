<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;


class AdminLoginController extends Controller{

    
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index(){
        echo 'hello';

    }

    public function redirectToProvider()
    {

        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */

    public function handleProviderCallback()
    {
        $user = Socialite::driver('facebook')->user();

        $user->name;
    }

}
