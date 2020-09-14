<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserAddRequest extends FormRequest
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
        return [
            'designation_id'=>'required',
            'department_id'=>'required',
            'user_group_id'=>'required',
            'name'=>'required',
            'email'=>'required|unique:users',
            'avatar_image'=>'mimes:jpg,jpeg,png',
            'signature_image'=>'mimes:jpg,jpeg,png',
            'user_signature_allow_other'=>'required',
            'user_signature_content'=>'required',
            'user_status'=>'required'
        ];
    }
}
