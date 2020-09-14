<?php

use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        DB::table('departments')->truncate();
        $rows = [
            [
                'department_name' => 'Admin',
                'department_short_name' => 'admin'
            ],
            [
                'department_name' => 'Marketing',
                'department_short_name' => 'marketing'
            ],
            [
                'department_name' => 'Development',
                'department_short_name' => 'development'
            ]

        ];
        DB::table('departments')->insert($rows);
    }
}
