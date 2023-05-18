<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\TestUserCareer;
use App\User;
use App\VerificationCode;
use Carbon\Carbon;
use Crypt;
use DB;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    public function showRegistrationForm()
    {
        return $this->view_page('auth.register');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {   
        // CHECK ID CAREER
        if($data['idjob'] != 0){
            try{
                $decId = Crypt::decrypt($data['idjob']);
            }catch(\Exception $e){
                return redirect(route('compro.career'));
            }
        }else{
            $decId = 0;
        }

        // CHECK USER
        $user = User::whereEmail($data['email'])->first();
        $check_email = true;

        if($user && $user->st_user == 0){
            $check_email = false;

            // CHECK IF VERIFICATION HAS BEEN SENT
            if(VerificationCode::whereEmail($data['email'])->first())
                return redirect()->route('register.verify', ['email' => $data['email']]);

        }

        if($check_email) Validator::make(['email' => $data['email']], ['email' => ['required', 'string', 'email', 'max:255', 'unique:users']])->validate();

        if(!$user){
            // CREATE USER
            $user =  User::create([
                'name' => $data['first_name']. ' ' .$data['last_name'],
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'birthday' => $data['birthday'],
                'level' => 'user',
                'gender' => $data['gender'],
            ]);
        }

        /* OLD
        // ADD TEST TARGET
        $twaktus = DB::table('tbl_list_test_job')
        ->leftJoin('tbl_test', 'tbl_test.id_test', '=', 'tbl_list_test_job.id_test')
        ->where('id_career', $data['idjob'])
        ->sum('minutes');
        //echo "twaktus:".$twaktus;     
        //echo "<br>";

        $current = Carbon::now();
        $targetwaktu = Carbon::now()->addMinutes($twaktus);

        $cekwaktu = DB::table('tbl_test_user_target')
        ->select('id_target')
        ->where('id_career', $data['idjob'])
        ->where('users_id', $user->id)
        ->first();
        if(isset($cekwaktu->id_target) && $cekwaktu->id_target != "") {
            //jika sudah ada datanya edit datanya
            //DB::table('tbl_test_user_target')->where('users_id', Auth::user()->id)->where('id_career', $idjob)->update(['st_test' => 1, 'updated_at' => NOW()]);
        } else {
            //jika belum ada datanya tambahkan datanya
            DB::table('tbl_test_user_target')->insert(array ('users_id' => $user->id, 'id_career' => $data['idjob'], 'start' => $current) ); //, 'target' => $targetwaktu
        }
        */

        /* NEW */
        // ADD USER CAREER
        if($decId != 0){
            TestUserCareer::firstOrCreate([
                'user_id' => $user->id,
                'career_id' => $decId
            ]);
        }

        // GENERATE CODE AND SEND IT
        try{
            $token = $this->randomize();
            VerificationCode::updateOrCreate(['email' => $data['email']], ['token' => $token]);

            $admemail = $data['email'];
            $nmmember = $data['first_name']." ".$data['last_name'];

            $data = array(
                'name'          => $nmmember,
                'email'         => $data['email'],
                'token'         => $token
            );

            Mail::send('emails.aktifasireg', $data, function ($message) use($admemail, $nmmember) {
                $message->from('info@reandabernardi.com', 'Account Activation')->subject('Account Activation '.$nmmember.' | Reanda Bernardi');
                $message->to($admemail);
            });
        }catch(\Exception $e){
            return redirect()->route('register.verify', ['email' => $data['email'], 'error' => 1]);
        }

        return redirect()->route('register.verify', ['email' => $data['email']]);
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        return $this->create($request->all());

        // event(new Registered($user = $this->create($request->all())));

        // $this->guard()->login($user);

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }

    public function verify($email)
    {
        // CHECK VERIFICATION CODE
        $user = User::whereEmail($email)->first();
        if($user && $user->st_user == 1) return redirect()->route('login');

        return $this->view_page('auth.verify', ['email' => $email]);
        // return view('auth.verify', ['email' => $email]);
    }

    public function verifying(Request $request)
    {
        Validator::make(
            $request->all(), 
            ['token' => ['required', 'string', 'max:255']],
            ['token.required' => 'Verification Code must be filled']
        )->validate();

        $token = VerificationCode::whereEmail($request->email)->first();

        if(!$token || ($token->token != $request->token)) return redirect()->route('register.verify', ['email' => $request->email, 'notValid' => 1])->withInput(Input::all());

        // SUCCESS & UPDATE USER
        $token->delete();

        $user = User::whereEmail($request->email)->first();
        $user->update([
            'st_user' => 1,
            'email_verified_at' => Carbon::now(),
        ]);

        $this->guard()->login($user);

        return $this->registered($request, $user)
                        ?: redirect()->route('home');
    }

    public function resend($email)
    {
        // GENERATE CODE AND SEND IT
        try{
            $user = User::whereEmail($email)->first();
            $token = $this->randomize();
            VerificationCode::updateOrCreate(['email' => $email], ['token' => $token]);

            $admemail = $email;
            $nmmember = @$user->first_name." ".@$user->last_name;

            $data = array(
                'name'          => $nmmember,
                'email'         => $email,
                'token'         => $token
            );

            Mail::send('emails.aktifasireg', $data, function ($message) use($admemail, $nmmember) {
                $message->from('info@reandabernardi.com', 'Account Activation')->subject('Account Activation '.$nmmember.' | Reanda Bernardi');
                $message->to($admemail);
            });
        }catch(\Exception $e){
            return redirect()->route('register.verify', ['email' => $email, 'error' => 1]);
        }

        return redirect()->route('register.verify', ['email' => $email, 'resend' => 1]);
    }

    public function randomize($n = 8)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
        $randomString = ''; 
      
        for ($i = 0; $i < $n; $i++) { 
            $index = rand(0, strlen($characters) - 1); 
            $randomString .= $characters[$index]; 
        } 
      
        return $randomString;
    }

}
