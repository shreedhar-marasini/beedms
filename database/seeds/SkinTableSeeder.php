<?php

use Illuminate\Database\Seeder;

class SkinTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('skins')->truncate();
        $rows=[
            [
                'skin_name'=>'red',
                'fixed_layout'=>'yes',
                'boxed_layout'=>'yes',
                'toggle_sidebar'=>'yes',
                'sidebar_expand_on_hover'=>'yes',
                'toggle_right_sidebar_slide'=>'yes',
                'toggle_right_sidebar_skin'=>'yes'

            ]
        ];
        DB::table('skins')->insert($rows);
    }
}
