<?php

namespace Mukul\Matrixusermanagement\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BranchUpdateFormRequest extends FormRequest
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
            $companyId = 3;//auth()->user()->company_id;
            $branchId = $this->id;
        }

        return [
            'name' => [
                'required',
                Rule::unique('sys_branches')->where(function ($query) use($companyId, $name, $branchId) {
                    return $query->where('company_id', $companyId)->where('name', $name)->where('id', '<>', $branchId);
                }),
            ],
            'email'    =>  'required|max:50',
            'phone'    =>  'required|max:14',
            'mobile'    =>  'required|max:14',
            'address'    =>  'required',
        ];
    }
}
