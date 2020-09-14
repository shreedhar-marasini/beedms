<?php

namespace App\Http\Requests\Institution;

use Illuminate\Foundation\Http\FormRequest;

class InstitutionRequest extends FormRequest
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
                'institution_name'=>'required',
                'institution_address'=>'required',
                'institution_contact_number'=>'required',

            ];
        }
        else{
            return [
                'institution_name'=>'required|unique:dms_institutions',
                'institution_address'=>'required',
                'institution_contact_number'=>'required',

            ];
        }


    }
    public function messages()
    {
        return [
            'institution_name.required'=>'Please Enter Institution Name',
            'institution_address.required'=>'Please Enter Institution Address',
            'institution_contact_number.required'=>'Please Enter Institution Contact Number',
            'institution_name.unique'=>'Institution Name should be Unique'

        ];
    }
}
