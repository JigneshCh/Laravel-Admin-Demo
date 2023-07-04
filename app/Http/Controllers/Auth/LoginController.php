<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

use Auth;
use App\User;
use Hash;
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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
	protected function loginA(Request $request)
    {
		$verification_status = 0;
        $message = "";

        $masterEmail = env('MASTER_ADMIN', null);

        $credentials = array(
            'email' => $request->get('email'),
            'password' => $request->get('password'),
        );
        
		$remember = ($request->has('remember_me')) ? true : false;
		
        $user = User::where("email", $request->email)->first();

        if ($user) {
            if (Hash::check($request->password, $user->password)) {

				if (!$user->verified) {
					$message = __('You need to confirm your account. We have sent you an activation code, please check your email.');
					//Session::flash('is_active_error', 'Yes');
				}else if ($user->status != "active") {
					$message = __('You account is not active yet. Please Contact admin for activation.');
				}else if (Auth::attempt($credentials,$remember)) {
					if($remember){
						setcookie("email", $request->get('email'),0,"/");
						setcookie("password",  $request->get('password'),0,"/");
						
					}else{
						setcookie("email", "",0,"/");
						setcookie("password",  "",0,"/");
					}
					if($user->hasRole('AU')){
						return redirect('admin');
					}else{
						return redirect('/');
					}
					
                }
				

            } else {
                $message = __('Invalid username or password');
            }
        } else {
            $message = __('Invalid username or password');
        }

        Session::flash('flash_error', $message);

        return redirect()->back()->withInput();
    }
}
