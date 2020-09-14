<?php
/**
 * Created by PhpStorm.
 * User: santosh
 * Date: 8/8/17
 * Time: 11:56 AM
 */

namespace App\Http\ViewComposers;


use App\Models\Notification;
use App\Models\Reminder;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class NotificationComposer
{
    /**
     * @var Notification
     */
    private $notification;
    /**
     * @var Reminder
     */
    private $reminder;

    function __construct(Notification $notification, Reminder $reminder)
    {
        $this->notification = $notification;
        $this->reminder = $reminder;
    }

    public function compose(View $view)
    {
        $notifications = $this->notification->where('notification_user_id', '=', Auth::id())
            ->where('notification_read_date', '=', null)->orderBy('id', 'DESC')->limit(10)->get();
        $view->with('notifications', $notifications);


        $now = Carbon::now()->toDateString();
        $reminders = $this->reminder->where('reminder_user_id','=',Auth::id())
            ->where('reminder_date','=',$now)->orwhere('reminder_snooze_date','=',$now)->orderBy('id','Desc')->limit(10)->get();
        $view->with('reminders',$reminders);


        $session = Carbon::now()->addMinute(5);
        $user = Auth::user()->id;
        DB::table('users')->where(['id'=>$user])->update(['last_online' => $session]);
    }


}