<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table='dms_notifications';
    protected $fillable=['notification_user_id','notification_title','notification_action_url',
        'notification_date','notification_read_date','notifier_user_id'];


    /* By: Santosh Dhungana
     * laravel will not accept the provided foreign key in relationship
     * so refer the foreign key while implementing relationships
     */
    public function user(){
        return $this->belongsTo('App\User','notification_user_id','id');
    }

    public function notifier(){
        return $this->belongsTo('App\User','notifier_user_id','id');
    }
    public $timestamps = true;
}
