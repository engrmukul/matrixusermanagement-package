<?php

namespace Mukul\Matrixusermanagement\Http\Controllers;

use  Mukul\Matrixusermanagement\Models\SysBranch;
use Illuminate\Http\Request;
use Mukul\Matrixusermanagement\Contracts\BranchContract;
use Mukul\Matrixusermanagement\Http\Requests\BranchStoreFormRequest;
use Mukul\Matrixusermanagement\Http\Requests\BranchUpdateFormRequest;

class BranchController extends BaseController
{
    protected $branchRepository;

    public function __construct(BranchContract $branchRepository)
    {
        $this->branchRepository = $branchRepository;
    }

    public function index()
    {
        $this->setPageTitle('Branches', 'Branch List');

        $data = [
            'tableHeads' => ['SN','name','email','phone','mobile','status','action'],
            'dataUrl' => 'branches/get-data',
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

        return view('matrixusermanagement::branches.index', $data);
    }

    public function getData(Request $request)
    {
        return $this->branchRepository->branchList($request);
    }

    public function create()
    {
        $this->setPageTitle('Branches', 'Create Branch');

        return view('matrixusermanagement::branches.create');
    }

    public function store(BranchStoreFormRequest $request)
    {
        $params = $request->except('_token');

        $branch = $this->branchRepository->createBranch($params);

        if (!$branch) {
            return $this->responseRedirectBack('Branch create error', 'error', true, true);
        }
        return $this->responseRedirect('branches.index', 'Branch create success', 'success', false, false);
    }

    public function edit($id)
    {
        $branch = $this->branchRepository->findBranchById($id);

        $this->setPageTitle('Branches', 'Edit Branch');
        return view('matrixusermanagement::branches.edit', compact('branch'));
    }

    public function update(BranchUpdateFormRequest $request, SysBranch $sysBranchModel)
    {
        $params = $request->except('_token');

        $branch = $this->branchRepository->updateBranch($params);

        if (!$branch) {
            return $this->responseRedirectBack('Branch update error', 'error', true, true);
        }
        return $this->responseRedirect('branches.index', 'Branch update success', 'success', false, false);
    }

    public function destroy(Request $request, $id)
    {
        $params = $request->except('_token');
        $branch = $this->branchRepository->deleteBranch($id, $params);

        if (!$branch) {
            return $this->responseRedirectBack('Branch delete error', 'error', true, true);
        }
        return $this->responseRedirect('branches.index', 'Branch delete success' ,'success',false, false);
    }

    public function restore()
    {
        $branches = $this->branchRepository->restore();

        if (!$branches) {
            return $this->responseRedirectBack(trans('branch.restore_error'), 'error', true, true);
        }
        return $this->responseRedirect('branches.index', trans('branch.restore_success') ,'success',false, false);
    }
}
