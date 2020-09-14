<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IncomingDocument extends Model
{
    Use SoftDeletes;
    protected $table = 'dms_incoming_documents';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'sender_institution_id',
        'receiver_department_id',
        'document_category_id',
        'uploaded_by_user_id',
        'sender_department_name',
        'issue_number', 'issue_date',
        'document_received_date',
        'incoming_document_subject',
        'incoming_document_registration_number',
        'incoming_document_registration_date',
        'incoming_document_upload',
        'incoming_document_additional_uploads',
        'incoming_document_privacy',
        'incoming_document_reminder_date', '
        incoming_document_reminder_content',
        'incoming_serial_number',
        'folder_id',
    ];

    /* By: Santosh Dhungana
    * laravel will not accept the provided foreign key in relationship
    * so refer the foreign key while implementing relationships
    */

    public function institution()
    {
        return $this->belongsTo('App\Models\Institution', 'sender_institution_id', 'id');
    }

    public function department()
    {
        return $this->belongsTo('App\Models\Department', 'receiver_department_id', 'id');
    }

    public function document_category()
    {
        return $this->belongsTo('App\Models\DocumentCategory', 'document_category_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'uploaded_by_user_id', 'id');
    }

    public function folder()
    {
        return $this->belongsTo('App\Models\Folder', 'folder_id', 'id');
    }
}
