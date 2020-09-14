<?php

namespace App\Http\Requests\Configurations;

use Illuminate\Foundation\Http\FormRequest;

class FiscalYearRequest extends FormRequest
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
            'fy_start_date' => 'required',
            'fy_end_date' => 'required',
            'fy_name' => 'required',
        ];
    }
    public function message()
    {
        return [
            'fy_start_date.required' => 'Fiscal Year Start Date is Required.',
            'fy_end_date.required' => 'Fiscal Year End Date is Required.',
            'fy_name.required' => 'Fiscal Year Name is Reqiuired.'
        ];
    }
}
