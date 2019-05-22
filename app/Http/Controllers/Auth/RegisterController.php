<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Mail;
use Carbon\Carbon;
use App\Mail\VerifyMail;

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
    protected $redirectTo = '/home';

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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
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
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'email_verification_token' => str_random(40),
        ]);

        Mail::to($user->email)->send(new VerifyMail($user));

        return $user;
    }

    public function verifyUser($token)
    {
        $verifyUser = User::where('email_verification_token', $token)->first();
        if(isset($verifyUser) ){
            if(!$verifyUser->email_verified_at) {
                $verifyUser->email_verified_at = Carbon::now();
                $verifyUser->save();
                $status = "Email berhasil terverifikasi";
            }else{
                $status = "Email sudah terverifikasi sebelumnya";
            }
        }else{
            return redirect('/login')->with('warning', "Email anda tidak terdaftar");
        }

        return redirect('/login')->with('status', $status);
    }

    protected function registered()
    {
        $this->guard()->logout();
        return redirect('/login')->with('status', 'Pendaftaran berhasil, kode aktivasi sudah dikirim ke email anda');
    }
}
