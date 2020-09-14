<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = ['department_name', 'department_short_name'];

    public function users()
    {
        return $this->hasMany('App\User');
    }

    public function digitized_documents()
    {
        return $this->hasMany('App\Models\DigitizedDocument');
    }

    public function document_department_authorities()
    {
        return $this->hasMany('App\Models\DocumentDepartmentAuthority');
    }

    public function email_logs()
    {
        return $this->hasMany('App\Model\EmailLog');
    }

    public function incoming_documents()
    {
        return $this->hasMany('App\Model\IncomingDocument');
    }

    public function outgoing_documents()
    {
        return $this->hasMany('App\Model\OutgoingDocument');
    }
}
