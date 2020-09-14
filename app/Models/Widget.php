<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Widget extends Model
{
    protected $fillable=['widget_name','widget_description','widget_default','widget_key','widget_status'];
}
