<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Password;
use Hash;

use Illuminate\Support\Facades\Validator;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Response;

use App\User;
use Carbon\Carbon;
use App\Responcetext as RT;

class UserController extends Controller
{
	public function UserLogin(Request $request)
    {
		$result = ["data"=>[],"code"=>400,"messages"=>""];
		
    	$rules = array(
            'email' => 'required|email',
            'password'=>'required'
        );

		$validator = \Validator::make($request->all(), $rules, []);

        if (!$validator->fails())
        {
			$input = $request->only('email','password');
            $jwt_token = null;
            $user = User::where("email", $request->email)->first();
			
			if ($user)
            {
				if (Hash::check($request->password, $user->password))
				{
					if ($user->status == "active" && $jwt_token = JWTAuth::attempt($input,['exp' =>Carbon::now()->addDays(7)->timestamp]))
                    {
						if($request->has('device_token')){
							$user->device_token = $request->device_token;
						}
						if($request->has('device_type')){
							$user->device_type = $request->device_type;
						}
						$user->save();
						
						$user = JWTAuth::user();
                        $res=make_null($user);
                        $res['token']=$jwt_token;
						
						$result["data"] = $res;
						$result["code"] = 200;
						$result["messages"] = RT::rtext("success_login");
						
						
					}else{
						$result["messages"] = RT::rtext("warning_your_account_not_activated_yet");
					}
					
				}else{
					$result["messages"] = RT::rtext("warning_incorrect_email_or_password");
				}
			   
		    }else{
				$result["messages"] = RT::rtext("warning_incorrect_email_or_password");
			}
            
		}else{
			$validation = $validator;
            $msgArr = $validator->messages()->toArray();
            
			$result["messages"]  = reset($msgArr)[0];
			$result["code"] = 400;
		}

		
		return $this->JsonResponse($result);
             
    }
	
	public function register(Request $request)
    {
		$result = ["data"=>[],"code"=>400,"messages"=>""];
		
        $rules = array(
            'email' => 'required|email|unique:users',
            'password'=>'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'phone_number' => 'required|regex:/^(?=.*[0-9])[ +()0-9]+$/|unique:users,phone_number',
            'occupation' => 'required'
        );
		$val_msg = [
			'phone_number.unique'=> RT::rtext("warning_require_unique_phone_number")
		];
		
        $validator = \Validator::make($request->all(), $rules, $val_msg);

        if (!$validator->fails())
        {
			$input = $request->all();
			
			$input['password'] = Hash::make($request->password);
			$input['status'] = "active";
			$input['name'] = "";
            $user= User::create($input);
			
			if($user){
				$user->assignRole("LU");
			}
			
			$result["data"] = $user;
			$result["code"] = 200;
			$result["messages"] = RT::rtext("success_register");
		
		}else{
			
			$validation = $validator;
            $msgArr = $validator->messages()->toArray();
			
			$result["messages"]  = reset($msgArr)[0];
			$result["code"] = 400;
		}

		return $this->JsonResponse($result);

    }
}
