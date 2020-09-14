<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        $rows = [
            [
                'user_group_id' => 1,
                'name' => 'Super Admin',
                'email' => 'superAdmin@youngminds.com.np',
                'password' => bcrypt('youngminds'),
                'designation_id'=>1,
                'department_id'=>1,
                'user_signature'=>'...',
                'user_signature_allow_other'=>'false',
                'user_status'=>'inactive',

            ],

            [
                'user_group_id' => 2,
                'name' => 'Admin',
                'email' => 'admin@youngminds.com.np',
                'password' => bcrypt('youngminds'),
                'designation_id'=>1,
                'department_id'=>1,
                'user_signature'=>'...',
                'user_signature_allow_other'=>'false',
                'user_status'=>'inactive',


            ],
            [
                'user_group_id' => 2,
                'name' => 'General',
                'email' => 'general@youngminds.com.np',
                'password' => bcrypt('general'),
                'designation_id'=>1,
                'department_id'=>1,
                'user_signature'=>'...',
                'user_signature_allow_other'=>'false',
                'user_status'=>'active',

            ],
      
            [
            'user_group_id' => 2,
            'name' => 'Luffy',
            'email' => 'luffy@youngminds.com.np',
            'password' => bcrypt('pirate'),
            'designation_id'=>1,
            'department_id'=>1,
            'user_signature'=>'...',
            'user_signature_allow_other'=>'false',
            'user_status'=>'active',

        ]

        ];
        DB::table('users')->insert($rows);
    }
}
