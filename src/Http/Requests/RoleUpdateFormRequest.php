<?php

namespace Mukul\Matrixusermanagement\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoleUpdateFormRequest extends FormRequest
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
            $roleId = $this->id;
        }

        return [
            'name' => [
                'required',
                Rule::unique('sys_departments')->where(function ($query) use($companyId, $name, $roleId) {
                    return $query->where('company_id', $companyId)->where('name', $name)->where('id', '<>', $roleId);
                }),
            ],
            'description' => 'required',
            'min_username_length' => 'required',
            'max_username_length' => 'required',
            'multi_login_allow' => 'required',
            'max_wrong_login_attempt' => 'required',
            'wrong_login_attempt' => 'required',
            'block_period' => 'required',
            'session_time_out' => 'required',
            'password_regEx' => 'required',
            'password_regEx_error_msg' => 'required',
            'password_expiry_notify' => 'required',
            'password_expiry_duration' => 'required',
            'password_expiry_action' => 'required',
        ];
    }
}
