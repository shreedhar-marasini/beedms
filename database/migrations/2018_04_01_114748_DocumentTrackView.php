<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DocumentTrackView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE VIEW v_document_timeline AS SELECT id AS track_id,tracks_document_id AS document_id, tracks_action_date AS action_date,tracks_document_type AS document_type,\'tracking\' AS timelineType,created_at as timeline_created_at FROM dms_document_tracks UNION SELECT id AS track_id,email_logs_document_id AS document_id, email_logs_sent_date AS action_date,email_logs_document_type AS document_type, \'email_log\'AS timelineType, created_at as timeline_created_at FROM dms_email_logs');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::raw('Drop view v_document_timeline');
    }
}
