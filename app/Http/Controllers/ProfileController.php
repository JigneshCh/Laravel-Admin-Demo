<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Hash;
use Illuminate\Support\Facades\Lang;
use Session;

class ProfileController extends Controller
{


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();

        return view('frontend.profile.index', compact('user'));
    }


    public function edit()
    {
        $user = Auth::user();

        


        return view('frontend.profile.edit', compact('user'));
    }


    /**
     * @param Request $request
     */
    public function update(Request $request)
    {


        $normal = [
            'first_name' => 'required',
            'last_name' => 'required',
        ];

       
        
		$user = Auth::user();

		$this->validate($request, $normal,[],['first_name'=>'Company Name','last_name'=>'Contact Person name']);
       


        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        

        if ($user->save()) {
            
        }


		 Session::flash('flash_message', __('Your profile updated successfully.'));
		 
      

        return redirect()->back();

    }


    //
    /**
     * @param Request $request
     * @return null|string
     */
    public function uploadPhoto(Request $request)
    {
        
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function changePassword()
    {
        return view('frontend.profile.changePassword');
    }

    /**
     * @param Request $request
     */
    public function updatePassword(Request $request)
    {

        $messages = [
            'current_password.required' => __('Please enter current password'),
            'password_confirmation.same' => __('The confirm password and new password must match.'),
        ];

        $this->validate($request,
            [
                'current_password' => 'required',
                'password' => 'required|min:6|max:255',
                'password_confirmation' => 'required|same:password',
            ], $messages);


        $cur_password = $request->input('current_password');


        $user = Auth::user();

        if (Hash::check($cur_password, $user->password)) {

           // $user->password = Hash::make($request->input('password'));
           // $user->save();

			 Session::flash('flash_message', __('Function is disabled for now.'));
         

            return redirect('profile');

        } else {
            $error = array('current-password' => __('Please enter correct current password'));
//            return response()->json(array('error' => $error), 400);
            return redirect()->back()->withErrors($error);
        }

        flash('Something wrong. Please try again latter.', 'error');

        return redirect()->back();


    }

}
