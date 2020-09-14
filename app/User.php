<?php

namespace App;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'designation_id', 'department_id', 'user_group_id', 'name', 'email', 'password',
        'user_image', 'user_signature', 'user_signature_allow_other', 'user_signature_content',
        'user_status','last_online','_FIXED_LAYOUT_','_UI_SKIN_','_BOXED_LAYOUT_','_TOGGLE_SIDEBAR_'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function designation(){
        return $this->belongsTo('App\Models\Designation','designation_id','id');
    }
    public function department(){
        return $this->belongsTo('App\Models\Department','department_id','id');
        
    }
    public function user_group(){
        return $this->belongsTo('App\Models\UserGroup','user_group_id','id');
    }

    public function digitized_documents()
    {
        return $this->hasMany('App\Models\DigitizedDocument');
    }
    
    public function document_comments(){
        return $this->hasMany('App\Models\DocumentComment');
    }
    
    public function document_tracks(){
        return $this->hasMany('App\Models\DocumentTrack');
    }
    
    public function document_user_authorities(){
        return $this->hasMany('App\Models\DocumentUserAuthority');
    }

    public function email_logs(){
        return $this->hasMany('App\Models\EmailLog');
    }
    public function incoming_documents(){
        return $this->hasMany('App\Models\IncomingDocument');
    }
    public function notifications(){
        return $this->hasMany('App\Models\Notification');
    }
    public function outgoing_documents(){
        return $this->hasMany('App\Models\OutgoingDocument');
    }
    public function user_log_tables(){
        return $this->hasMany('App\Models\UserLogTable');
    }
    public function reminders(){
        return $this->hasany('App\Models\Reminder');
    }

    public static function isSuperAdmin()
    {
        return (Auth::user()->user_group_id==1)?true:false;
    }
   
}
