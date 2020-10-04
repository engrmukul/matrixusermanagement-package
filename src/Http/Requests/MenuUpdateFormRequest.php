<?php

namespace Mukul\Matrixusermanagement\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ModuleUpdateFormRequest extends FormRequest
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
            $moduleId = $this->id;
        }

        return [
            'name' => [
                'required',
                Rule::unique('sys_departments')->where(function ($query) use($companyId, $name, $moduleId) {
                    return $query->where('company_id', $companyId)->where('name', $name)->where('id', '<>', $moduleId);
                }),
            ],
            'home_url'    =>  'required|max:100',
            'icon'    =>  'required|max:100',
            'description'    =>  'required',
        ];
    }
}
