<?php

namespace App\Http\Requests\Documents\OutgoingDocument;

use Illuminate\Foundation\Http\FormRequest;

class OutgoingDocumentRequest extends FormRequest
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
          
                'outgoing_document_date' => 'required',
                'outgoing_document_subject' => 'required',
                'institution_id' => 'required',
               
                'signature_user_id' => 'required',
               'file_uploads' => 'mimes:jpg,pdf,zip,jpeg,png,xlsx,xls,csv',
            ];
        } elseif ($this->method() == 'PATCH') {
            return [];
        } else {
            return [
                'template_id' => 'required',
                'outgoing_document_date' => 'required',
                'outgoing_document_subject' => 'required',
                'institution_id' => 'required',
             
                'signature_user_id' => 'required',
               
               'file_uploads' => 'mimes:jpg,pdf,zip,jpeg,png,xlsx,xls,csv',
            ];
        }
    }

    public function messages()
    {
        return [
            'content.required' => 'Please Select template Category to load content here.'

        ];
    }
}
