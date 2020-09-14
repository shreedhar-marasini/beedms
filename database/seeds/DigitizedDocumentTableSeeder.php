<?php

use Illuminate\Database\Seeder;

class DigitizedDocumentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dms_digitized_documents')->truncate();
        $rows = [
            [
                'document_category_id' => '1',
                'department_id' => '1',
                'template_id'=>'1',
                'uploaded_by_user_id'=>'1',
                'related_institution_id'=>'1',
                'digitized_document_name'=>'document name',
                'digitized_document_description'=>'2017-10-1 dsfsdf sdfasdfasdf sdfasd fasdfasdfsdf dfsdf',
                'digitized_document_path'=>'test/test.jpg',
                'digitized_document_date'=>'2017-10-12',
                'digitized_document_content'=>'test sdefs dfasd dsfsadf dsf asdf dasf dfas ',
                'digitized_document_privacy'=>'general',
                'folder_id' => '0',
                'created_at' => date('Y-m-d'),
              

            ],
            [
                'document_category_id' => '2',
                'department_id' => '2',
                'template_id'=>'1',
                'uploaded_by_user_id'=>'1',
                'related_institution_id'=>'2',
                'digitized_document_name'=>'Recepit for the webiste',
                'digitized_document_description'=>'For payments, the receipt lists the transaction details as proof that an invoice has been paid, partially or in-full. Afterward, the receipt is stored as an accounting record for billing and tax purposes. As a payor, a receipt should be kept for cash payments or if a product is purchased that may need to be returned at a later date.',
                'digitized_document_path'=>'test/test.jpg',
                'digitized_document_date'=>'2017-10-12',
                'digitized_document_content'=>'For payments, the receipt lists the transaction details as proof that an invoice has been paid, partially or in-full. Afterward, the receipt is stored as an accounting record for billing and tax purposes. As a payor, a receipt should be kept for cash payments or if a product is purchased that may need to be returned at a later date. ',
                'digitized_document_privacy'=>'general',
                'folder_id' => '0',
                'created_at' => date('Y-m-d'),
              

            ]

        ];
        DB::table('dms_digitized_documents')->insert($rows);
    }
}
