<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailLog extends Model
{
    protected $table='dms_email_logs';
    public $timestamps = true;
    protected $fillable=['institution_id','department_id','sender_user_id','email_send_status'
    ,'email_logs_document_id','email_received_acknowledgement','email_received_acknowledgement_date',
    'email_logs_document_type','email_logs_address','email_logs_sent_date'];
    
    public function institution(){
        return $this->belongsTo('App\Models\Institution','institution_id','id');
    }

    public function department(){
        return $this->belongsTo('App\Models\Department','department_id','id');
    }

    public function user(){
        return $this->belongsTo('App\User','sender_user_id','id');
    }
}
