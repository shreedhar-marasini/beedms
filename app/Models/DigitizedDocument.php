<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DigitizedDocument extends Model
{
    use SoftDeletes;
    protected $table='dms_digitized_documents';


    protected $dates = ['deleted_at'];
    protected $fillable = [
        'document_category_id',
        'department_id',
        'template_id',
        'uploaded_by_user_id',
        'related_institution_id',
        'digitized_document_name',
        'digitized_document_description',
        'digitized_document_path',
        'digitized_document_date',
        'digitized_document_content',
        'digitized_document_privacy',
        'digitized_document_reminder_date',
        'digitized_document_reminder_content',
        'folder_id',
        'digitized_file_uploads',
    ];

    /* By: Santosh Dhungana
   * laravel will not accept the provided foreign key in relationship
   * so refer the foreign key while implementing relationships
   */
    public  function document_category(){
        return $this->belongsTo('App\Models\DocumentCategory','document_category_id','id');
    }
    public function department(){
        return $this->belongsTo('App\Models\Department','department_id','id');
    }
//    public function template(){
//        return $this->belongsTo('App\Models\Template','template_id','id');
//    }
    public function user(){
        return $this->belongsTo('App\User','uploaded_by_user_id','id');
    }
    public function institution(){
        return $this->belongsTo('App\Models\Institution','related_institution_id','id');
    }
    public function folder(){
        return $this->belongsTo('App\Models\Folder','folder_id','id');
    }
}
