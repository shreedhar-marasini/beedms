<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentCategory extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'dms_document_categories';

    protected $fillable = ['parent_id', 'category_name', 'category_status'];

    public function digitized_documents()
    {
        return $this->hasMany('App\Models\DigitizedDocument');
    }
    public function incoming_documents(){
        return $this->hasMany('App\Model\IncomingDocument');
    }
}
