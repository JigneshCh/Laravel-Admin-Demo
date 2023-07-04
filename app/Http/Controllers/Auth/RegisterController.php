<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\VerifyUser;

use App\Mail\VerifyMail;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use Illuminate\Http\Request;

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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
	protected function registered(Request $request, $user) 
	{
        $this->guard()->logout();
        return redirect('/login')->with('status', 'We sent you an activation code. Check your email and click on the link to verify.');
    }
	
    protected function create(array $data)
    {
        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'status' => "active",
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
		
		$verifyUser = VerifyUser::create([
            'user_id' => $user->id,
            'token' => str_random(40)
        ]);

        \Mail::to($user->email)->send(new VerifyMail($user));
		
		return $user;
    }
	
	protected function resendActivationMail(array $data)
    {
        $rules = [
            'email'=>['required']
        ];

        $this->validate($request, $rules);
		
		$user = User::where("email", $request->email)->first();

        if ($user) {
			
			$verifyUser = VerifyUser::where("user_id",$user->id);	
			if(!$verifyUser){
				$verifyUser = new VerifyUser();
			}
			$verifyUser->user_id = $user->id;
			$verifyUser->token = str_random(40);
			$verifyUser->save();
			
            \Mail::to($user->email)->send(new VerifyMail($user));
			
			$message = __('We sent you an activation code. Check your email and click on the link to verify.');
        } else {
            $message = __('Data not found');
        }

        
		return redirect('/login')->with('status', $status);
    }
	
	public function verifyUser($token)
    {
        $verifyUser = VerifyUser::where('token', $token)->first();
        if(isset($verifyUser) ){
            $user = $verifyUser->user;
            if(!$user->verified) {
                $verifyUser->user->verified = 1;
                $verifyUser->user->save();
                $status = "Your e-mail is verified. You can now login.";
            }else{
                $status = "Your e-mail is already verified. You can now login.";
            }
        }else{
            return redirect('/login')->with('warning', "Sorry your email cannot be identified.");
        }

        return redirect('/login')->with('status', $status);
    }
}
