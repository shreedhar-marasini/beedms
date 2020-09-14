<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    protected $fillable=['designation_name','designation_short_name'];
    
    public function users(){
        return $this->hasMany('App\User');
    }
}
