<?php

namespace Mukul\Matrixusermanagement\Http\Controllers;

use  Mukul\Matrixusermanagement\Models\SysUserRole;
use Illuminate\Http\Request;
use Mukul\Matrixusermanagement\Contracts\RoleContract;
use Mukul\Matrixusermanagement\Http\Requests\RoleStoreFormRequest;
use Mukul\Matrixusermanagement\Http\Requests\RoleUpdateFormRequest;

class RoleController extends BaseController
{
    protected $roleRepository;

    public function __construct(RoleContract $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function index()
    {
        $this->setPageTitle('Roles', 'Role List');

        $data = [
            'tableHeads' => ['SN','name','min_username_length','max_username_length','multi_login_allow',
                'max_wrong_login_attempt','wrong_login_attempt','block_period','session_time_out','password_regEx',
                'password_regEx_error_msg', 'password_expiry_notify','password_expiry_duration',
                'password_expiry_action','status','action',
            ],
            'dataUrl' => 'roles/get-data',
            'columns' => [
                ['data' => 'id', 'name' => 'id'],
                ['data' => 'name', 'name' => 'name'],
                ['data' => 'min_username_length', 'name' => 'min_username_length'],
                ['data' => 'max_username_length', 'name' => 'max_username_length'],
                ['data' => 'multi_login_allow', 'name' => 'multi_login_allow'],
                ['data' => 'max_wrong_login_attempt', 'name' => 'max_wrong_login_attempt'],
                ['data' => 'wrong_login_attempt', 'name' => 'wrong_login_attempt'],
                ['data' => 'block_period', 'name' => 'block_period'],
                ['data' => 'session_time_out', 'name' => 'session_time_out'],
                ['data' => 'password_regEx', 'name' => 'password_regEx'],
                ['data' => 'password_regEx_error_msg', 'name' => 'password_regEx_error_msg'],
                ['data' => 'password_expiry_notify', 'name' => 'password_expiry_notify'],
                ['data' => 'password_expiry_duration', 'name' => 'password_expiry_duration'],
                ['data' => 'password_expiry_duration', 'name' => 'password_expiry_duration'],
                ['data' => 'password_expiry_action', 'name' => 'password_expiry_action'],
                ['data' => 'action', 'name' => 'action', 'orderable' => false]
            ],
        ];

        return view('matrixusermanagement::roles.index', $data);
    }

    public function getData(Request $request)
    {
        return $this->roleRepository->roleList($request);
    }

    public function create()
    {
        $this->setPageTitle('Roles', 'Create Role');

        return view('matrixusermanagement::roles.create');
    }

    public function store(RoleStoreFormRequest $request)
    {
        $params = $request->except('_token');

        $role = $this->roleRepository->createRole($params);

        if (!$role) {
            return $this->responseRedirectBack('Role create error', 'error', true, true);
        }
        return $this->responseRedirect('roles.index', 'Role create success', 'success', false, false);
    }

    public function edit($id)
    {
        $role = $this->roleRepository->findRoleById($id);

        $this->setPageTitle('Roles', 'Edit Role');
        return view('matrixusermanagement::roles.edit', compact('role'));
    }

    public function update(RoleUpdateFormRequest $request, SysUserRole $sysUserRoleModel)
    {
        $params = $request->except('_token');

        $role = $this->roleRepository->updateRole($params);

        if (!$role) {
            return $this->responseRedirectBack('Role update error', 'error', true, true);
        }
        return $this->responseRedirect('roles.index', 'Role update success', 'success', false, false);
    }

    public function destroy(Request $request, $id)
    {
        $params = $request->except('_token');
        $role = $this->roleRepository->deleteRole($id, $params);

        if (!$role) {
            return $this->responseRedirectBack('Role delete error', 'error', true, true);
        }
        return $this->responseRedirect('roles.index', 'Role delete success' ,'success',false, false);
    }

    public function restore()
    {
        $roles = $this->roleRepository->restore();

        if (!$roles) {
            return $this->responseRedirectBack(trans('role.restore_error'), 'error', true, true);
        }
        return $this->responseRedirect('roles.index', trans('role.restore_success') ,'success',false, false);
    }
}
