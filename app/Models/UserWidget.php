<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserWidget extends Model
{
    protected $fillable=['user_id','widget_id'];
    protected $table='user_widget';

}
