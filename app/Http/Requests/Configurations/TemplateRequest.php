<?php

namespace App\Http\Requests\Configurations;

use App\Models\Template;
use Illuminate\Foundation\Http\FormRequest;

class TemplateRequest extends FormRequest
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
        if($this->method()=='PUT'){
            return [
                'document_category_id'=>'required|not_in:0',
                'template_name'=>'required',
                'template_short_name'=>'required',
                'editor1'=>'required',
                'template_subject'=>'required',
                'include_header'=>'required',
                'include_footer'=>'required',


            ];

        }
        else{
            return [
                'document_category_id'=>'required|not_in:0',
                'template_name'=>'required|unique:dms_templates',
                'template_short_name'=>'required',
                'editor1'=>'required',
                'template_subject'=>'required',
                'include_header'=>'required',
                'include_footer'=>'required',
            ];
        }




    }
    public function messages()
    {

        return[
            'template_name.unique:dms_templates'=>'Template Name Must Be Unique',
           
        ];
    }
}
