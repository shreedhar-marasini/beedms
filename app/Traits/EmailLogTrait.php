<?php
/**
 * User: prakash
 * Date: 6/20/16
 * Time: 10:34 AM
 */

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait EmailLogTrait
{

    public static function createEmailLog($institution_id, $department_id, $sender_user_id,
                                          $email_send_success, $document_type, $email_logs_document_type, $email_addresses, $email_logs_sent_date)
    {
        DB::table('email_logs')->insert(
            [
                'institution_id' => $institution_id,
                'department_id' => $department_id,
                'sender_user_id' => $sender_user_id,
                'email_send_success' => $email_send_success,
                'document_type' => $document_type,
                'email_logs_document_type' => $email_logs_document_type,
                'email_addresses' => $email_addresses,
                'email_logs_sent_date' => $email_logs_sent_date,


            ]
        );
    }
}