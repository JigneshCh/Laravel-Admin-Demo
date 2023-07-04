<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Role;
use App\User;

use Illuminate\Http\Request;
use Session;

use Illuminate\Support\Facades\File;

use DataTables;

class UsersController extends Controller

{

    public function __construct()
    {
        
    }


    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function userDatatable(Request $request) {
        $record = User::with('roles');

		if($request->has('status') && $request->status != ""){
			$record->where("status",$request->status);
		}
        return Datatables::of($record)->make(true);
    }

    public function index(Request $request)
    {
        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
		$roles= Role::pluck('label', 'name');
		$selected_role = [];
        return view('admin.users.create', compact('roles','selected_role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return void
     */
    public function store(Request $request)
    {
        $this->validate($request,[
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|unique:users', 
                'password' => 'required',
                'roles' => 'required'
            ],[],['first_name'=>'Company Name','last_name'=>'Contact Person name']);

        $data = $request->except('password');
        $data['password'] = bcrypt($request->password);
        $data['utype'] = "employee";
        $data['verified'] = 1;
		
		foreach ($request->roles as $role) {
            if ($role =="AU") {
            $data['utype'] = "admin";
			}
			if ($role =="EU") {
				$data['utype'] = "employee";
			}
        }
    
        $user = User::create($data);

        foreach ($request->roles as $role) {
            $user->assignRole($role);
        }
        
        Session::flash('flash_message', __('User added!'));

		
        return redirect('admin/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return void
     */
    public function show($id)
    {

        $user = User::where("id",$id)->first();

        if(!$user){
            Session::flash('flash_message', 'No Access !');
            return redirect()->back();
        }
        

        
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return void
     */
    public function edit($id)
    {
       $user = User::where("id",$id)->first();

	   $roles= Role::pluck('label', 'name');
	   
        if(!$user){
            Session::flash('flash_message', 'No Access !');
            return redirect()->back();
        }
		
		$selected_role = $user->roles->pluck('name');
        
		return view('admin.users.edit', compact('user','roles','selected_role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @param  \Illuminate\Http\Request $request
     *
     * @return void
     */
    public function update($id, Request $request)
    {
        $this->validate($request, [
			'first_name' => 'required',
            'last_name' => 'required',
			'email' => 'required|unique:users,email,' . $id,
			'roles' => 'required'
			],[],['first_name'=>'Company Name','last_name'=>'Contact Person name']);



        $data = $request->except('password');
        if ($request->has('password') && $request->get('password') !="") {
            $data['password'] = bcrypt($request->password);
        }
		
		foreach ($request->roles as $role) {
            if ($role =="AU") {
            $data['utype'] = "admin";
			}
			if ($role =="EU") {
				$data['utype'] = "employee";
			}
        }
		
        $data['verified'] = 1;

        $user = User::where("id",$id)->where("id","!=",1)->first();

        if(!$user){
            Session::flash('flash_message', 'No Access !');
            return redirect()->back();
        }




        if ($user) {
            $user->update($data);
            $user->save();
        }

        $user->roles()->detach();
        foreach ($request->roles as $role) {
            $user->assignRole($role);
        }
        
        
        Session::flash('flash_message', __('User updated!'));

        return redirect('admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return void
     */
    public function destroy($id,Request $request)
    {
        $result = array();
        $ob = User::where("id",$id)->where("id","!=",\Auth::user()->id)->where("id","!=",1)->first();

        if($ob){
			if($ob->id < 6){
				$result['message'] = "No access to Delete master User , Delete user having id > 5";
				$result['code'] = 400;
			}else{
				$ob->roles()->detach();
				$ob->delete();
				$result['message'] = \Lang::get('comman.responce_msg.record_deleted_succes');;
				$result['code'] = 200;
			}
            
			
        }else{
            Session::flash('flash_message', 'No Access !');
            $result['message'] = \Lang::get('comman.responce_msg.you_have_no_permision_to_delete_record');;
            $result['code'] = 400;
        }


        if($request->ajax()){
            return response()->json($result, $result['code']);
        }else{
            Session::flash('flash_message',$result['message']);
            return redirect('admin/users');
        }
    }

    
    
    
    
    public function uploadPhoto(Request $request)
    {
        if ($request->hasFile('photo')) {

//            dd($request->file('image'));
            $file = $request->file('photo');
            //getting timestamp
            $timestamp = str_replace([' ', ':'], '-', \Carbon\Carbon::now()->toDateTimeString() . uniqid());

            $name = $timestamp . '-' . $file->getClientOriginalName();

//            dd($name);
//            $image->filePath = $name;

            $file->move(public_path() . '/uploads/', $name);

            return $name;
        } else {

            return null;
        }

    }
    public function removeImage($imageName)
    {
        $image_path1 = public_path()."/uploads/".$imageName;

        if ($imageName && $imageName !="" && File::exists($image_path1)) {
            unlink($image_path1);
        }
    }

}
