<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentTrack extends Model
{
    protected $table='dms_document_tracks';
    public $timestamps = true;

    protected $fillable = ['document_access_user_id','tracks_document_type','tracks_document_id'
    ,'tracks_action_type','tracks_action_type','tracks_action_date'];



 public function user(){
     return $this->belongsTo('App\User','document_access_user_id','id');
 }
}
