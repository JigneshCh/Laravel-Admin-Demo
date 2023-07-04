<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		
		$users = config('role-users.users');
        foreach ($users as $value)
        {
			$user = User::whereEmail($value['email'])->first();
			if(!$user){ $user = new User(); }
            
			$user->email=$value['email'];
			$user->first_name=$value['first_name'];
			$user->last_name=$value['last_name'];
			$user->status=$value['status'];
			$user->utype=$value['utype'];
			$user->verified=$value['verified'];
			$user->password=bcrypt($value['password']);
			$user->save();
			if(!$user->hasRole($value['role'])){
				$user->assignRole($value['role']);
			}
			
        }
        
        

       // $role=Role::where('label','=','AU')->first();
      //  $users->roles()->attach($role->id);
    }
}
