<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Repository\NotificationRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    /**
     * @var Notification
     */
    private $notification;
    /**
     * @var NotificationRepository
     */
    private $notificationRepository;

    function __construct(Notification $notification,NotificationRepository $notificationRepository)
    {

        $this->notification = $notification;
        $this->notificationRepository = $notificationRepository;
    }

    public function showAllNotifications(){
        $notifications=$this->notification->orderBy('id','DESC')
            ->where('notification_user_id','=',Auth::user()->id)
            ->get();
        $notificationRepository=$this->notificationRepository;
        return view('notifications.allNotifications',compact('notifications','notificationRepository'));
    }
    public function updateNotificationTable($id){
        $notification=Notification::find($id);
        if($notification){
            $notification->update(['notification_read_date'=>date('Y-m-d')]);
            return redirect($notification->notification_action_url);
        }
    }

    public function readAll()
    {
        $user = Auth::user()->id;
        $notifications = Notification::where('notification_read_date',null)->where('notification_user_id',$user)->get();
        foreach($notifications as $notification) {
            $date = Carbon::now();
            $notification->update(['notification_read_date' => $date]);
        }
        return back();
    }
}
