<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skin extends Model
{
    protected $fillable = [
        'skin_name',
        'fixed_layout',
        'boxed_layout',
        'toggle_sidebar',
        'sidebar_expand_on_hover',
        'toggle_right_sidebar_slide',
        'toggle_right_sidebar_skin'
    ];
   
}
