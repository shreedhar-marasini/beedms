<?php

namespace App\Http\Requests\Documents;

use Illuminate\Foundation\Http\FormRequest;

class DigitizedDocumentRequest extends FormRequest
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
        if($this->method()=='PUT') {
            return [
                'department_id' => 'required',
                'related_institution_id' => 'required',
                'digitized_document_name' => 'required',
                'digitized_document_date' => 'required',
                'digitized_document_privacy' => 'required',
                'file_uploads' => 'required',
            //    'file_uploads' => 'mimes:jpg,pdf,zip,jpeg,png,xlsx,xls,csv,doc,docx,ppt,pptx,gif,rar',

            ];
        }
        elseif($this->method()=='PATCH'){
            return [

            //    'file_uploads' => 'mimes:jpg,pdf,zip,jpeg,png,xlsx,xls,csv,doc,docx,ppt,pptx,gif,rar',

            ];
        }
        else{
            return [
                'document_category_id' => 'required',
                'department_id' => 'required',
                'related_institution_id' => 'required',
                'digitized_document_name' => 'required',
                'digitized_document_date' => 'required',
                'digitized_document_privacy' => 'required',
                'file_uploads' => 'required',
          
            //    'file_uploads' => 'mimes:jpg,pdf,zip,jpeg,png,xlsx,xls,csv,doc,docx,ppt,pptx,gif,rar',
            ];
        }
    }


    public function messages()
    {
        return[
            'content.required'=>'Please Select template Category to load content here.'

        ];
    }
}
