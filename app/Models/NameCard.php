<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NameCard extends Model
{
    Use SoftDeletes;
    protected $table='dms_name_cards';

    protected $dates = ['deleted_at'];

    protected $fillable=['institution_id','name_card_person','name_card_address','name_card_email_address1',
    'name_card_email_address2','name_card_contact_number1','name_card_contact_number2','business_card','name_card_designation'];

    public function institution(){
        return $this->belongsTo('App\Models\Institution','institution_id','id');
    }
}
