<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Institution extends Model
{
    use SoftDeletes;
    protected $table='dms_institutions';

    protected $dates = ['deleted_at'];
    
    protected $fillable= ['institution_name','institution_address','institution_email_address',
        'institution_contact_number','institution_website','institution_pan_number','institution_image'];
    
    public function digitized_documents(){
        return $this->hasMany('App\Models\DigitizedDocument');
    }
    public function email_logs(){
        return $this->hasMany('App\Models\EmailLog');
    }
    public function incoming_documents(){
        return $this->hasMany('App\Models\IncomingDocument');
    }
    public function name_cards(){
        return $this->hasMany('App\Models\NameCard');
    }
    public function outgoing_documents(){
        return $this->hasMany('App\Models\OutgoingDocument');
    }
}
