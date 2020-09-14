<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $fillable=['user_group_id','menu_id','allow_view','allow_add','allow_edit','allow_delete',];
    
    public function user_group(){
        return $this->belongsTo('App\Models\UserGroup','user_group_id','id');
    }
}
