<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reminder extends Model
{
    use SoftDeletes;
    protected $table='dms_reminders';

    protected $dates = ['deleted_at'];
    protected $fillable = ['reminder_user_id', 'document_id', 'document_type', 'reminder_date',
        'reminder_title', 'reminder_content', 'reminder_type', 'reminder_snooze_date',
        'reminder_to_email', 'reminder_stack_holder', 'remind_to_all'];

    public function user()
    {
        $this->belongsTo('App\User', 'reminder_user_id', 'id');
    }
}
