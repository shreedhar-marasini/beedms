<?php

namespace App\Http\Requests\Documents\IncomingDocument;

use Illuminate\Foundation\Http\FormRequest;

class IncomingDocumentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->method() == 'PUT') {
            return [
                'incoming_document_privacy' => 'required',
                'sender_institution_id' => 'required',
                'receiver_department_id' => 'required',
                'issue_number' => 'required',
                'document_received_date' => 'required',
                'incoming_document_registration_date' => 'required',
                'issue_date' => 'required',
         
                'file_uploads' => 'required|mimes:jpg,pdf,zip,jpeg,png,xlsx,xls,csv',
               'file_upload' => 'required|mimes:jpg,pdf,jpeg,png',
               'incoming_document_add_uploads' => 'mimes:jpg,pdf,zip,jpeg,png,xlsx,xls',

            ];
        } elseif ($this->method() == 'PATCH') {
            return [];
        } else {
            return [
                'sender_department_name' => 'required',
                'incoming_document_subject' => 'required',
                'sender_institution_id' => 'required',
                'receiver_department_id' => 'required',
                'document_category_id' => 'required',
                'issue_number' => 'required|unique:dms_incoming_documents',
                'issue_date' => 'required',
                'document_received_date' => 'required',
                'incoming_document_registration_date' => 'required',
                'incoming_document_privacy' => 'required',
             
              
               'file_upload' => 'required|mimes:jpg,pdf,jpeg,png',
               'incoming_document_add_uploads' => 'mimes:jpg,pdf,zip,jpeg,png,xlsx,xls',


            ];
        }

    }
 
}
