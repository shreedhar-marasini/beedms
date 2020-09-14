<?php
/**
 * Created by PhpStorm.
 * User: santosh
 * Date: 8/8/17
 * Time: 4:20 PM
 */

namespace App\Repository;


use App\Models\Notification;
use App\User;

class NotificationRepository
{
    /**
     * @var Notification
     */
    private $notification;

    function __construct(Notification $notification)
    {
        $this->notification = $notification;
    }

    /*
     * accepts id and parameter as image to get user image or name to get user name
     */
    public static function getUserInformation($id){
        $user=User::find($id);
        return $user;
    }

}