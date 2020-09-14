<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Template extends Model
{
    use SoftDeletes;
    protected $table='dms_templates';

    protected $dates=['deleted_at'];
    protected $fillable =['document_category_id','template_name','template_short_name','template_content','template_subject','include_header','include_footer'];


    public function digitized_documents(){
        return $this->hasMany('App\Models\DigitizedDocument');
    }
    public function outgoing_documents(){
        return $this->hasMany('App\Models\OutgoingDocument');
    }
    public function document_categories(){
        return $this->belongsTo('App\Models\DocumentCategory','document_category_id','id');
    }

}
