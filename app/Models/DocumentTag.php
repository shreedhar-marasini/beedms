<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentTag extends Model
{
    protected $table='dms_document_tags';

    protected $fillable = ['document_id','tag_id','document_tag_type'];
    
    public function tag(){
        return $this->belongsTo('App\Models\Tag','tag_id','id');
    }
}
