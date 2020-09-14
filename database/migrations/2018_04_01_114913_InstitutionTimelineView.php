<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InstitutionTimelineView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement(' CREATE VIEW v_institution_timeline AS SELECT id AS document_id,sender_institution_id as institution_id ,created_at AS created_date,deleted_at as deleted_date,\'incoming\' AS documentType,\'incoming\' AS timelineType FROM dms_incoming_documents UNION

    SELECT id AS document_id,institution_id as institution_id, created_at AS created_date,deleted_at as deleted_date,\'outgoing\' AS documentType,\'outgoing\' AS timelineType FROM dms_outgoing_documents UNION


    SELECT id AS document_id,related_institution_id as institution_id, created_at AS created_date,deleted_at as deleted_date,\'digitized\' AS documentType,\'digitized\' AS timelineType FROM dms_digitized_documents UNION

    SELECT email_logs_document_id AS document_id,institution_id as institution_id, created_at AS created_date,NULL as deleted_date,email_logs_document_type AS documentType,\'email\' AS timelineType FROM dms_email_logs');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::raw('Drop view v_institution_timeline');
    }
}
