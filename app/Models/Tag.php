<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    
    protected $fillable = ['tag_name'];
    protected $table='dms_tags';

    public function document_tags()
    {
        return $this->hasMany('App\Models\DocumentTag');
    }
}
