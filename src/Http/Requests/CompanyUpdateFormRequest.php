<?php

namespace Mukul\Matrixusermanagement\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CompanyUpdateFormRequest extends FormRequest
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
            'name'      =>  'required|max:100',
            'phone' => [
                'required',
                'max:14',
                Rule::unique('companies', 'mobile')->ignore($this->company)
            ],
            'email' => [
                'required',
                'max:50',
                Rule::unique('companies', 'email')->ignore($this->company)
            ]
        ];
    }
}
