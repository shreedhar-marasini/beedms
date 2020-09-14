<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FiscalYear extends Model
{
    protected $fillable=['fy_start_date','fy_start_date_localized','fy_end_date',
        'fy_end_date_localized','fy_status','fy_name'];
}
