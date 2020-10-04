<?php

namespace Mukul\Matrixusermanagement\Http\Controllers;

use  Mukul\Matrixusermanagement\Models\SysDepartment;
use Illuminate\Http\Request;
use Mukul\Matrixusermanagement\Contracts\DepartmentContract;
use Mukul\Matrixusermanagement\Http\Requests\DepartmentStoreFormRequest;
use Mukul\Matrixusermanagement\Http\Requests\DepartmentUpdateFormRequest;

class DepartmentController extends BaseController
{
    protected $departmentRepository;

    public function __construct(DepartmentContract $departmentRepository)
    {
        $this->departmentRepository = $departmentRepository;
    }

    public function index()
    {
        $this->setPageTitle('Departments', 'Department List');

        $data = [
            'tableHeads' => ['SN','name','email','phone','mobile','status','action'],
            'dataUrl' => 'departments/get-data',
            'columns' => [
                ['data' => 'id', 'name' => 'id'],
                ['data' => 'name', 'name' => 'name'],
                ['data' => 'email', 'name' => 'email'],
                ['data' => 'phone', 'name' => 'phone'],
                ['data' => 'mobile', 'name' => 'mobile'],
                ['data' => 'status', 'name' => 'status'],
                ['data' => 'action', 'name' => 'action', 'orderable' => false]
            ],
        ];

        return view('matrixusermanagement::departments.index', $data);
    }

    public function getData(Request $request)
    {
        return $this->departmentRepository->departmentList($request);
    }

    public function create()
    {
        $this->setPageTitle('Departments', 'Create Department');

        return view('matrixusermanagement::departments.create');
    }

    public function store(DepartmentStoreFormRequest $request)
    {
        $params = $request->except('_token');

        $department = $this->departmentRepository->createDepartment($params);

        if (!$department) {
            return $this->responseRedirectBack('Department create error', 'error', true, true);
        }
        return $this->responseRedirect('departments.index', 'Department create success', 'success', false, false);
    }

    public function edit($id)
    {
        $department = $this->departmentRepository->findDepartmentById($id);

        $this->setPageTitle('Departments', 'Edit Department');
        return view('matrixusermanagement::departments.edit', compact('department'));
    }

    public function update(DepartmentUpdateFormRequest $request, SysDepartment $sysDepartmentModel)
    {
        $params = $request->except('_token');

        $department = $this->departmentRepository->updateDepartment($params);

        if (!$department) {
            return $this->responseRedirectBack('Department update error', 'error', true, true);
        }
        return $this->responseRedirect('departments.index', 'Department update success', 'success', false, false);
    }

    public function destroy(Request $request, $id)
    {
        $params = $request->except('_token');
        $department = $this->departmentRepository->deleteDepartment($id, $params);

        if (!$department) {
            return $this->responseRedirectBack('Department delete error', 'error', true, true);
        }
        return $this->responseRedirect('departments.index', 'Department delete success' ,'success',false, false);
    }

    public function restore()
    {
        $departments = $this->departmentRepository->restore();

        if (!$departments) {
            return $this->responseRedirectBack(trans('department.restore_error'), 'error', true, true);
        }
        return $this->responseRedirect('departments.index', trans('department.restore_success') ,'success',false, false);
    }
}
