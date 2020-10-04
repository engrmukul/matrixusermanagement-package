<?php

namespace Mukul\Matrixusermanagement\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MenuUpdateFormRequest extends FormRequest
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
            $menuId = $this->id;
        }

        return [
            'name' => [
                'required',
                Rule::unique('sys_menus')->where(function ($query) use($companyId, $name, $menuId) {
                    return $query->where('company_id', $companyId)->where('name', $name)->where('id', '<>', $menuId);
                }),
            ],
            'menu_type'    =>  'required',
            'parent_id'    =>  'required',
            'sys_module_id'    =>  'required',
            'icon'    =>  'required|max:100',
            'menu_url'    =>  'required',
            'sort_number'    =>  'required',
            'description'    =>  'required',
        ];
    }
}
