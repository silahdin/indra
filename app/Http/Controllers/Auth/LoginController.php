<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\TestUserCareer;
use App\User;
use Carbon\Carbon;
use DB;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use Laravel\Socialite\Facades\Socialite;
use Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin/dashboard';

    public function showLoginForm()
    {
        return $this->view_page('auth.login');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('guest')->except('logout', 'addTest');
    }

    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */

    public function handleProviderCallback()
    {
        function generateRandomString($length = 10) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }

        // die('hmm');
        // Socialite::driver('google')->stateless()->user();
        $userSocial = Socialite::driver('google')->stateless()->user();
        
        $findUser = User::where('email', $userSocial->email)->first();
        if($findUser){
            
            $userdata = array(
                'id'     => $findUser->id,
                'name'     => $findUser->name,
                'email'     => $findUser->email,
                'password'     => $findUser->password,
                'avatar'     => $findUser->avatar,
            );
            // echo '</pre>';
            // print_r($userdata);
            // echo '</pre>';
            
            session()->put('userLogin', $userdata);
            // Auth::attempt();

            // echo '<pre>';
            // print_r(Auth::user($userdata));
            // echo '</pre>';
            // die();

            return redirect()->route('compro.registerTrain');
            // return 'old'; 
        }else{
            $pass = generateRandomString();
            $user = New User;
            $user->name = $userSocial->name;
            $user->email = $userSocial->email;
            $user->avatar = $userSocial->avatar;
            $user->password = generateRandomString();
            $user->level = 'user';
            $user->st_user = 1;
            $user->save();

            $findUser = User::where('email', $userSocial->email)->first();
            $userdata = array(
                'id'     => $findUser->id,
                'name'     => $findUser->name,
                'email'     => $findUser->email,
                'password'     => $findUser->password,
                'avatar'     => $findUser->avatar,
            );
            session()->put('userLogin', $userdata);

            // Session::set('userLogin', $userdata);
            // Auth::attempt($userdata);

            // return 'new';

                    return redirect()->route('compro.registerTrain');
        }
    }

    public function logOutUser(){
        session()->forget('userLogin');
        return redirect()->back();         

    }

    public function addTest(Request $request)
    {
        if(Auth::check()){
            $decId = $this->decrypt($request->id, 'compro.career');

            if($decId != 0){
                // ADD USER CAREER
                TestUserCareer::firstOrCreate([
                    'user_id' => Auth::user()->id,
                    'career_id' => $decId
                ]);
            }

            return redirect('home');

        }else{
            return redirect('register?id='.$request->id);
        }
    }

    protected function _addTest(Request $request){
        if(Auth::check()){
            if(isset($request->id) && $request->id != "") {
                $twaktus = DB::table('tbl_list_test_job')
                ->leftJoin('tbl_test', 'tbl_test.id_test', '=', 'tbl_list_test_job.id_test')
                ->where('id_career', $request->id)
                ->sum('minutes');
                //echo "twaktus:".$twaktus;     
                //echo "<br>";

                $current = Carbon::now();
                $targetwaktu = Carbon::now()->addMinutes($twaktus);
                
                $cekusern = DB::table('users')
                ->select('id')
                ->where('email', Auth::user()->email)
                ->first();

                $cekwaktu = DB::table('tbl_test_user_target')
                ->select('id_target')
                ->where('id_career', $request->id)
                ->where('users_id', Auth::user()->id)
                ->first();
                if(isset($cekwaktu->id_target) && $cekwaktu->id_target != "") {
                    //jika sudah ada datanya edit datanya
                    //DB::table('tbl_test_user_target')->where('users_id', Auth::user()->id)->where('id_career', $idjob)->update(['st_test' => 1, 'updated_at' => NOW()]);
                } else {
                    //jika belum ada datanya tambahkan datanya
                    DB::table('tbl_test_user_target')->insert(array ('users_id' => Auth::user()->id, 'id_career' => $request->id, 'start' => $current) );
                    return redirect('home');
                }
            }
        }else{
            return redirect('register?id='.$request->id);
        }
    }

    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required|exists:users,' . $this->username() . ',st_user,1',
            'password' => 'required',
            'captcha' => 'required|captcha'
        ], [
            $this->username() . '.exists' => 'The selected email is invalid or the account has been disabled.'
        ]);


        // ADD JOB
        if(isset($request->idjob) && $request->idjob != "") {
            $decId = '';

            try{
                $decId = Crypt::decrypt($request->idjob);
            }catch(\Exception $e){
                $decId = 0;
            }

            if($decId != 0){
                $user = User::whereEmail($request->email)->first();

                if($user){
                    // ADD USER CAREER
                    TestUserCareer::firstOrCreate([
                        'user_id' => $user->id,
                        'career_id' => $decId
                    ]);
                }

                
            }
        }
        
        // if(isset($request->idjob) && $request->idjob != "") {
        //     $twaktus = DB::table('tbl_list_test_job')
        //     ->leftJoin('tbl_test', 'tbl_test.id_test', '=', 'tbl_list_test_job.id_test')
        //     ->where('id_career', $request->idjob)
        //     ->sum('minutes');
        //     //echo "twaktus:".$twaktus;     
        //     //echo "<br>";

        //     $current = Carbon::now();
        //     $targetwaktu = Carbon::now()->addMinutes($twaktus);
            
        //     $cekusern = DB::table('users')
        //     ->select('id')
        //     ->where('email', $request->email)
        //     ->first();

        //     $cekwaktu = DB::table('tbl_test_user_target')
        //     ->select('id_target')
        //     ->where('id_career', $request->idjob)
        //     ->where('users_id', $cekusern->id)
        //     ->first();
        //     if(isset($cekwaktu->id_target) && $cekwaktu->id_target != "") {
        //         //jika sudah ada datanya edit datanya
        //         //DB::table('tbl_test_user_target')->where('users_id', Auth::user()->id)->where('id_career', $idjob)->update(['st_test' => 1, 'updated_at' => NOW()]);
        //     } else {
        //         //jika belum ada datanya tambahkan datanya
        //         DB::table('tbl_test_user_target')->insert(array ('users_id' => $cekusern->id, 'id_career' => $request->idjob, 'start' => $current) );
        //     }
        // }
        
    }
}
