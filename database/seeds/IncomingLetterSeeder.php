<?php

use Illuminate\Database\Seeder;

class IncomingLetterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dms_incoming_documents')->truncate();
        $rows = [
            [
                'sender_institution_id' => '1',
                'receiver_department_id' => '1',
                'document_category_id'=>'1',
                'uploaded_by_user_id'=>'1',
                'sender_department_name'=>'admin',
                'issue_number'=>'34234gbw34',
                'issue_date'=>'2017-10-1',
                'document_received_date'=>'2017-10-12',
                'incoming_document_subject'=>'test',
                'incoming_document_registration_number'=>'123sdfs',
                'incoming_serial_number' => '465',
                'incoming_document_registration_date'=>'2017-10-12',
                'incoming_document_upload'=>'test',
                'incoming_document_additional_uploads'=>'',
                'incoming_document_privacy'=>'general',
                'folder_id' => '0',
                'created_at' => date('Y-m-d'),
                
                
            ],
            [
                'sender_institution_id' => '2',
                'receiver_department_id' => '2',
                'document_category_id'=>'2',
                'uploaded_by_user_id'=>'2',
                'sender_department_name'=>'admin',
                'issue_number'=>'34234Dept01',
                'issue_date'=>'2019-10-1',
                'document_received_date'=>'2019-10-12',
                'incoming_document_subject'=>'Job Inquiry',
                'incoming_document_registration_number'=>'01Jb52',
                'incoming_serial_number' => '125',
                'incoming_document_registration_date'=>'2019-10-12',
                'incoming_document_upload'=>'Null',
                'incoming_document_additional_uploads'=>'',
                'incoming_document_privacy'=>'general',
                'folder_id' => '0',
                'created_at' => date('Y-m-d'),
                
                
            ]
        ];
        DB::table('dms_incoming_documents')->insert($rows);
    }
}
