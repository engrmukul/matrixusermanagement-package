<?php

namespace Mukul\Matrixusermanagement\Http\Controllers;

use  Mukul\Matrixusermanagement\Models\SysDesignation;
use Illuminate\Http\Request;
use Mukul\Matrixusermanagement\Contracts\DesignationContract;
use Mukul\Matrixusermanagement\Http\Requests\DesignationStoreFormRequest;
use Mukul\Matrixusermanagement\Http\Requests\DesignationUpdateFormRequest;

class DesignationController extends BaseController
{
    protected $designationRepository;

    public function __construct(DesignationContract $designationRepository)
    {
        $this->designationRepository = $designationRepository;
    }

    public function index()
    {
        $this->setPageTitle('Designations', 'Designation List');

        $data = [
            'tableHeads' => ['SN','name','short_name','status','action'],
            'dataUrl' => 'designations/get-data',
            'columns' => [
                ['data' => 'id', 'name' => 'id'],
                ['data' => 'name', 'name' => 'name'],
                ['data' => 'short_name', 'name' => 'short_name'],
                ['data' => 'status', 'name' => 'status'],
                ['data' => 'action', 'name' => 'action', 'orderable' => false]
            ],
        ];

        return view('matrixusermanagement::designations.index', $data);
    }

    public function getData(Request $request)
    {
        return $this->designationRepository->designationList($request);
    }

    public function create()
    {
        $this->setPageTitle('Designations', 'Create Designation');

        return view('matrixusermanagement::designations.create');
    }

    public function store(DesignationStoreFormRequest $request)
    {
        $params = $request->except('_token');

        $designation = $this->designationRepository->createDesignation($params);

        if (!$designation) {
            return $this->responseRedirectBack('Designation create error', 'error', true, true);
        }
        return $this->responseRedirect('designations.index', 'Designation create success', 'success', false, false);
    }

    public function edit($id)
    {
        $designation = $this->designationRepository->findDesignationById($id);

        $this->setPageTitle('Designations', 'Edit Designation');
        return view('matrixusermanagement::designations.edit', compact('designation'));
    }

    public function update(DesignationUpdateFormRequest $request, SysDesignation $sysDesignationModel)
    {
        $params = $request->except('_token');

        $designation = $this->designationRepository->updateDesignation($params);

        if (!$designation) {
            return $this->responseRedirectBack('Designation update error', 'error', true, true);
        }
        return $this->responseRedirect('designations.index', 'Designation update success', 'success', false, false);
    }

    public function destroy(Request $request, $id)
    {
        $params = $request->except('_token');
        $designation = $this->designationRepository->deleteDesignation($id, $params);

        if (!$designation) {
            return $this->responseRedirectBack('Designation delete error', 'error', true, true);
        }
        return $this->responseRedirect('designations.index', 'Designation delete success' ,'success',false, false);
    }

    public function restore()
    {
        $designations = $this->designationRepository->restore();

        if (!$designations) {
            return $this->responseRedirectBack(trans('designation.restore_error'), 'error', true, true);
        }
        return $this->responseRedirect('designations.index', trans('designation.restore_success') ,'success',false, false);
    }
}
