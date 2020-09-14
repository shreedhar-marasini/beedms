<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OutgoingDocument extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'dms_outgoing_documents';

    /* By: Santosh Dhungana
 * laravel will not accept the provided foreign key in relationship
 * so refer the foreign key while implementing relationships
 */
    protected $fillable = [
        'institution_id',
        'template_id',
        'created_by_user_id',
        'signature_user_id',
        'department_name',
        'outgoing_registration_number',
        'outgoing_registration_date',
        'outgoing_document_date',
        'outgoing_document_subject',
        'outgoing_document_content',
        'outgoing_file_uploads',
        'outgoing_document_privacy',
        'outgoing_issue_status',
        'outgoing_issue_date',
        'issued_by',
        'outgoing_issue_number',
        'reminder_email_send_date',
        'outgoing_reminder_date',
        'outgoing_reminder_content',
        'url_verification_key',
        'url_verification_key_validity_date',
        'outgoing_serial_number',
        'document_qr_code',
        'folder_id',


    ];

    public function institution()
    {
        return $this->belongsTo('App\Models\Institution', 'institution_id', 'id');
    }

    public function template()
    {
        return $this->belongsTo('App\Models\Template', 'template_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'created_by_user_id', 'id');
    }

    public function documentPrivacy($userId, $document_id)
    {

        return $this->hasOne('App\Models\DocumentPrivacy', 'document_id', 'id')
            ->where('dms_document_privacy.document_type', '=', 'outgoing')
            ->where('dms_document_privacy.user_id', '=', $userId)
            ->where('dms_document_privacy.document_id', '=', $document_id)
            ->first();
    }

    public function folder()
    {
        return $this->belongsTo('App\Models\Folder', 'folder_id', 'id');
    }


}
