<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Role;
use App\RoleWebsite;
use DebugBar\DebugBar;
use Illuminate\Http\Request;
use Session;
use App\Permission;


use DataTables;

class RolesController extends Controller
{


    public function __construct()
    {
        
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('admin.roles.index');
    }
    
    public function datatable(Request $request) {

       
        

        $record = Role::where('id',">",0);
        

        return Datatables::of($record)->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
		return redirect('admin/roles');
		
        $permissions = Permission::with('child')->parent()->get();

        $isChecked = function ($name) {
            return '';
        };

        return view('admin.roles.create', compact('permissions', 'isChecked'));
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
        $this->validate($request, ['name' => 'required', 'permissions' => 'required']);


        $role = Role::create($request->all());

        $role->permissions()->detach();

        foreach ($request->permissions as $permission_name) {
            $permission = Permission::whereName($permission_name)->first();
            $role->givePermissionTo($permission);
        }

        

        Session::flash('flash_message', __('Role added!'));

        return redirect('admin/roles/' . $role->id . '/edit');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function show($id)
    {
        $role = Role::with('main_permission.child')->lower()->findOrFail($id);

        $permissions = Permission::with('child')->parent()->get();

        $isChecked = function ($name) use ($role) {

            if ($role->permissions->contains('name', $name)) {
                return 'checked';
            }
            return '';
        };


        return view('admin.roles.show', compact('role', 'permissions', 'isChecked'));
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
        

        $role = Role::with('permissions')->lower()->findOrFail($id);

		$permissions = Permission::with('child')->parent()->get();

        $isChecked = function ($name) use ($role) {

            if ($role->permissions->contains('name', $name)) {
                return 'checked';
            }
            return '';
        };

        return view('admin.roles.edit', compact('role', 'permissions', 'isChecked'));
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
        $this->validate($request, ['name' => 'required', 'permissions' => 'required']);

        $role = Role::findOrFail($id);

        $role->update($request->all());

        $role->permissions()->detach();

        foreach ($request->permissions as $permission_name) {
            $permission = Permission::whereName($permission_name)->first();
            $role->givePermissionTo($permission);
        }

        Session::flash('flash_message', __('Role updated!'));

        return redirect('admin/roles/' . $id . '/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function destroy($id,Request $request)
    {
        $ob = Role::whereId($id)->first();

        if($ob){
            $ob->permissions()->detach();
            $ob->delete();
            $result['message'] = \Lang::get('comman.responce_msg.record_deleted_succes');;
            $result['code'] = 200;
        }else{
            $result['message'] = \Lang::get('comman.responce_msg.you_have_no_permision_to_delete_record');;
            $result['code'] = 400;
        }

        if($request->ajax()){
            return response()->json($result, $result['code']);
        }else{
            Session::flash('flash_message',$result['message']);
            return redirect('admin/roles');
        }

    }
}
