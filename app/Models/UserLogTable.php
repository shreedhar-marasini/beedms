<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserLogTable extends Model
{
    protected $fillable = ['user_id','log_in_date','log_in_device','log_in_ip'];


    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }
}
