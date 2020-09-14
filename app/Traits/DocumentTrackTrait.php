<?php
/**
 * User: prakash
 * Date: 6/20/16
 * Time: 10:34 AM
 */

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait DocumentTrackTrait
{

    public static function createDocumentTrack($document_access_user_id, $tracks_document_type,$document_id, $tracks_action_type,
                                              $tracks_action_date)
    {
        DB::table('dms_document_tracks')->insert(
            [
                'document_access_user_id' => $document_access_user_id,
                'tracks_document_type' => $tracks_document_type,
                'tracks_document_id'=>$document_id,
                'tracks_action_type' => $tracks_action_type,
                'tracks_action_date' => $tracks_action_date,
                'created_at'=>date('Y-m-d H:i:s.u0')

            ]
        );
    }
}