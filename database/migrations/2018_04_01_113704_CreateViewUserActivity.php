<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViewUserActivity extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('Create VIEW v_user_activity as SELECT id as document_id, \'incoming\' as document_type , uploaded_by_user_id as user_id ,\'incoming\'as activity_type , created_at as created_at, NULL as issued_by_user_id, NULL as signed_by_user_id, deleted_at as deleted_date FROM dms_incoming_documents UNION

 SELECT id as document_id, \'outgoing\' as document_type , created_by_user_id as user_id, \'outgoing\'as activity_type , created_at as created_at, issued_by as issued_by_user_id, signature_user_id as signed_by_user_id, deleted_at as deleted_date FROM dms_outgoing_documents UNION

 SELECT id as document_id, \'digitized\' as document_type , uploaded_by_user_id as user_id, \'digitized\'as activity_type , created_at as created_at, NULL as issued_by_user_id, NULL as signed_by_user_id , deleted_at as deleted_date FROM dms_digitized_documents UNION

    SELECT email_logs_document_id as document_id, email_logs_document_type as document_type , sender_user_id as user_id ,\'email\'as activity_type , created_at as created_at, NULL as issued_by_user_id, NULL as signed_by_user_id ,NULL as deleted_date FROM dms_email_logs UNION

    SELECT documents_id as document_id, document_comments_type as document_type , commented_by_user_id as user_id ,\'comments\'as activity_type , created_at as created_at, NULL as issued_by_user_id, NULL as signed_by_user_id, NULL as deleted_date FROM dms_document_comments UNION

    SELECT tracks_document_id as document_id, tracks_document_type as document_type , document_access_user_id as user_id ,\'tracks\'as activity_type , created_at as created_at, NULL as issued_by_user_id, NULL as signed_by_user_id, NULL as deleted_date FROM dms_document_tracks UNION

      SELECT document_id as document_id, document_type as document_type , reminder_user_id as user_id ,\'reminder\'as activity_type , created_at as created_at, NULL as issued_by_user_id, NULL as signed_by_user_id, NULL as deleted_date FROM dms_reminders');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::raw('Drop view v_user_activity ');
    }
}
