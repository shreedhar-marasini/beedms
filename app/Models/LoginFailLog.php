<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoginFailLog extends Model
{
    protected $fillable = ['user_name','fail_password','log_in_ip','log_in_device'];
}
