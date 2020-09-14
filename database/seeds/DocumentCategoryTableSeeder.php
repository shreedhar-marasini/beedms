<?php

use Illuminate\Database\Seeder;

class DocumentCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dms_document_categories')->truncate();
        $rows = [
            [
                'category_name' => 'Contract',
                'category_status' => 'active',
                'parent_id'=>'0'
            ],
            [
                'category_name' => 'Letters',
                'category_status' => 'active',
                'parent_id'=>'0'
            ],
            [
                'category_name' => 'Minutes',
                'category_status' => 'active',
                'parent_id'=>'0'
            ],
            [
                'category_name' => 'Request Application',
                'category_status' => 'active',
                'parent_id'=>'3'
            ],
            [
                'category_name' => 'Rental Contract',
                'category_status' => 'active',
                'parent_id'=>'1'
            ],
            [
                'category_name' => 'Event Contract',
                'category_status' => 'active',
                'parent_id'=>'1'
            ],
            [
                'category_name' => 'Household Service Contract',
                'category_status' => 'active',
                'parent_id'=>'1'
            ],
            [
                'category_name' => 'Job Contract',
                'category_status' => 'active',
                'parent_id'=>'1'
            ],
            [
                'category_name' => 'Business Letter',
                'category_status' => 'active',
                'parent_id'=>'2'
            ],
            [
                'category_name' => 'Cover Letter',
                'category_status' => 'active',
                'parent_id'=>'2'
            ],
            [
                'category_name' => 'Job Acceptance Letter',
                'category_status' => 'active',
                'parent_id'=>'2'
            ],
            [
                'category_name' => 'Reference Letter',
                'category_status' => 'active',
                'parent_id'=>'2'
            ],

        ];
        DB::table('dms_document_categories')->insert($rows);
    }
}
