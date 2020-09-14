<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentUserAuthority extends Model
{
    protected $table='dms_document_user_authorities';
    protected $fillable=['authorized_document_id','authorized_user_id','authorized_document_type'
    ,'document_authority_date'];
    /* By: Santosh Dhungana
* laravel will not accept the provided foreign key in relationship
* so refer the foreign key while implementing relationships
*/
    public function user(){
        return $this->belongsTo('App\User','authorized_user_id','id');
    }
}
