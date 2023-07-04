<?php

return [

    'roles' => [
            '0' => [
                'label' => ' Admin',
                'name' => 'AU'
            ],
            '3' => [
                'label' => 'Employee',
                'name' => 'EU'
            ],
        ],
		
	'users' => [
            '0' => [
                'name' => ' Admin User',
                'first_name' => 'Admin',
                'last_name' => '',
				'status'=>'active',
				'email'=>'admin@gmail.com',
				'password'=>'123456',
				'role'=>'AU',
				'utype'=>'admin',
				'verified'=>1,
            ],
            '1' => [
                'name' => 'Employee User',
                'first_name' => 'Emp',
                'last_name' => '',
				'status'=>'active',
				'email'=>'employee@gmail.com',
				'password'=>'123456',
				'role'=>'EU',
				'utype'=>'employee',
				'verified'=>1,
            ],
        ],	

];
