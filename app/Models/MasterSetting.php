<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterSetting extends Model
{
    protected $fillable=['key_name','key_label','key_value','key_type','key_description',
        'key_display_order','master_configuration_type'];
}
