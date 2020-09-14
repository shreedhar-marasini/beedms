<?php
namespace App\Repository;

use App\Models\DocumentTrack;
use App\Models\EmailLog;
use Illuminate\Support\Facades\DB;

/**
 * Created by PhpStorm.
 * User: ym-bikash
 * Date: 8/20/17
 * Time: 2:12 PM
 */
class DocumentTimelineRepository
{
    /**
     * @var EmailLogRepo
     */
    private $emailLogRepo;
    /**
     * @var EmailLog
     */
    private $emailLog;

    public function __construct(EmailLog $emailLog)
    {

        $this->emailLog = $emailLog;
    }

    public function getDocumentDate($document_id, $document_type)
    {

        //create view sql CREATE VIEW v_document_timeline AS SELECT id AS track_id,tracks_document_id AS document_id, tracks_action_date AS action_date,tracks_document_type AS document_type,'tracking' AS timelineType,created_at as timeline_created_at FROM dms_document_tracks UNION SELECT id AS track_id,email_logs_document_id AS document_id, email_logs_sent_date AS action_date,email_logs_document_type AS document_type, 'email_log'AS timelineType, created_at as timeline_created_at FROM dms_email_logs
        //drop view sql  DROP VIEW v_document_timeline


        $documentTrack = DB::select("SELECT DISTINCT( action_date) FROM `v_document_timeline` where document_id= $document_id  AND document_type=\"$document_type\" ORDER by action_date desc");
        return $documentTrack;
    }
    public static function getDocumentInfo($action_date, $document_id, $document_type)
    {
        $documentTrack = DB::select("SELECT * FROM `v_document_timeline` where document_id= $document_id AND action_date=\"$action_date\" AND document_type=\"$document_type\" ORDER by timeline_created_at desc ");
        return $documentTrack;
    }
    public function getRecentlyAddedDocuments(){

        $userActivity =    DB::select('select * from v_user_activity where (`document_type`=\'incoming\' and `activity_type`=\'incoming\' )
        or (`document_type`=\'outgoing\' and `activity_type`=\'outgoing\' ) or (`document_type`=\'digitized\' and `activity_type`=\'digitized\' ) and deleted_date is NULL order by created_at desc');
 

        return $userActivity;
    }

}