<?php

use Illuminate\Database\Seeder;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dms_tags')->truncate();
        $rows = [
            [
                'tag_name' => 'No Tag',
               
            ],
            [
                'tag_name' => 'invoice',
               
            ],
            [
                'tag_name' => 'proposal',
             
            ],
            [
                'tag_name' => 'notice',
               
            ]

        ];
        DB::table('dms_tags')->insert($rows);
    }
}
