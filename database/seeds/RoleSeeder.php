<?php

use Illuminate\Database\Seeder;

use App\Role;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $roles = config('role-users.roles');
        foreach ($roles as $value)
        {
			$role = Role::whereName($value['name'])->first();
			if(!$role){
				$role = new Role;
			}
            
            $role->name=$value['name'];
            $role->label=$value['label'];
            $role->save();
        }
    }
}
