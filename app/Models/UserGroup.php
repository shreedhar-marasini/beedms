<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{
    protected $fillable=['group_name','group_details'];
    public function users(){
        return $this->hasMany('App\User');
    }
    public function user_roles(){
        return $this->hasMany('App\Models\UserRole');
    }
}
