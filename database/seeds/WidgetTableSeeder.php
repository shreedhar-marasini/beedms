<?php

use Illuminate\Database\Seeder;

class WidgetTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('widgets')->truncate();
        $rows = [
            [
                'widget_name' => 'Calender',
                'widget_description' => 'calender',
                 'widget_default' => 'calender',
                'widget_key'=>'8'
            ],

            [
                'widget_name' => 'Documents',
                'widget_description' => 'Documents',
                'widget_default' => 'documents',
                'widget_key'=>'2'
            ],
            [
                'widget_name' => 'Document Information',
                'widget_description' => 'document information',
                'widget_default' => 'document_information',
                'widget_key'=>'1'
            ],
            [
                'widget_name' => 'My Activity',
                'widget_description' => 'my activities',
                'widget_default' => 'my activities',
                'widget_key'=>'6'
            ],
            [
                'widget_name' => 'Recently Added Documents',
                'widget_description' => 'recently added documents',
                'widget_default' => 'recently added documents',
                'widget_key'=>'9'
            ],
            [
                'widget_name' => 'Recently logged in users',
                'widget_description' => 'recently alogged in users',
                'widget_default' => 'recently logged in users',
                'widget_key'=>'5'
            ],
            [
                'widget_name' => 'Document Comment',
                'widget_description' => 'Document Comment',
                'widget_default' => 'Document Comment',
                'widget_key'=>'7'
            ],
            [
                'widget_name' => 'Online Users',
                'widget_description' => 'Online Users',
                'widget_default' => 'Online Users',
                'widget_key'=>'4'
            ],
            [
                'widget_name' => 'Document Access Information',
                'widget_description' => 'Document Access Information',
                'widget_default' => 'Document Access Information',
                'widget_key'=>'3'
            ],


        ];
        DB::table('widgets')->insert($rows);
    }
}
