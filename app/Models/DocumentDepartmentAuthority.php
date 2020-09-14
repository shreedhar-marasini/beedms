<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentDepartmentAuthority extends Model
{
    protected $table='dms_document_department_authorities';

    protected $fillable=['department_id','authorized_department_document_type',
       'authorized_department_document_id','document_authority_date'];
    
    public function department(){
        return $this->belongsTo('App\Models\Department');
    }
}
