<?php

namespace Mukul\Matrixusermanagement\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DesignationStoreFormRequest extends FormRequest
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
        if ($this->request->has('name')){
            $name = $this->name;
            $companyId = 3;//auth()->user()-> company_id;
        }

        return [
            'name' => [
                'required',
                'max:200',
                Rule::unique('sys_designations')->where(function ($query) use($companyId, $name) {
                    return $query->where('company_id', $companyId)->where('name', $name);
                }),
            ],
            'short_name'    =>  'required|max:50',
        ];
    }
}
