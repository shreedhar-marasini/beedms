<?php
/**
 * User: prakash
 * Date: 6/20/16
 * Time: 10:34 AM
 */

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait NotificationTrait
{

    public static function createNotification($notification_user_id, $notification_title, $notification_action_url,
                                              $notification_date,
                                              $notifier_user_id)
    {
        for ($i=0;$i<count($notification_user_id);$i++) {
            DB::table('dms_notifications')->insert(
                [
                    'notification_user_id' => $notification_user_id[$i],
                    'notification_title' => $notification_title,
                    'notification_action_url' => $notification_action_url,
                    'notification_date' => $notification_date,
                    'notifier_user_id' => $notifier_user_id
                ]
            );
        }
    }
}