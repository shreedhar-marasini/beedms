<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentComment extends Model
{
    protected $table='dms_document_comments';


    protected $fillable = ['commented_by_user_id','documents_id',
        'document_comments_description','document_comments_type','document_comments_upload'
    ];
    /* By: Santosh Dhungana
  * laravel will not accept the provided foreign key in relationship
  * so refer the foreign key while implementing relationships
  */
    public function user(){
        return $this->belongsTo('App\User','commented_by_user_id','id');
    }
    
    
}