<?php

namespace Mukul\Matrixusermanagement\Http\Controllers;

use  Mukul\Matrixusermanagement\Models\SysModule;
use Illuminate\Http\Request;
use Mukul\Matrixusermanagement\Contracts\ModuleContract;
use Mukul\Matrixusermanagement\Http\Requests\ModuleStoreFormRequest;
use Mukul\Matrixusermanagement\Http\Requests\ModuleUpdateFormRequest;

class ModuleController extends BaseController
{
    protected $moduleRepository;

    public function __construct(ModuleContract $moduleRepository)
    {
        $this->moduleRepository = $moduleRepository;
    }

    public function index()
    {
        $this->setPageTitle('Modules', 'Module List');

        $data = [
            'tableHeads' => ['SN','name','home_url','status','action'],
            'dataUrl' => 'modules/get-data',
            'columns' => [
                ['data' => 'id', 'name' => 'id'],
                ['data' => 'name', 'name' => 'name'],
                ['data' => 'home_url', 'name' => 'home_url'],
                ['data' => 'status', 'name' => 'status'],
                ['data' => 'action', 'name' => 'action', 'orderable' => false]
            ],
        ];

        return view('matrixusermanagement::modules.index', $data);
    }

    public function getData(Request $request)
    {
        return $this->moduleRepository->moduleList($request);
    }

    public function create()
    {
        $this->setPageTitle('Modules', 'Create Module');

        return view('matrixusermanagement::modules.create');
    }

    public function store(ModuleStoreFormRequest $request)
    {
        $params = $request->except('_token');

        $module = $this->moduleRepository->createModule($params);

        if (!$module) {
            return $this->responseRedirectBack('Module create error', 'error', true, true);
        }
        return $this->responseRedirect('modules.index', 'Module create success', 'success', false, false);
    }

    public function edit($id)
    {
        $module = $this->moduleRepository->findModuleById($id);

        $this->setPageTitle('Modules', 'Edit Module');
        return view('matrixusermanagement::modules.edit', compact('module'));
    }

    public function update(ModuleUpdateFormRequest $request, SysModule $sysModuleModel)
    {
        $params = $request->except('_token');

        $module = $this->moduleRepository->updateModule($params);

        if (!$module) {
            return $this->responseRedirectBack('Module update error', 'error', true, true);
        }
        return $this->responseRedirect('modules.index', 'Module update success', 'success', false, false);
    }

    public function destroy(Request $request, $id)
    {
        $params = $request->except('_token');
        $module = $this->moduleRepository->deleteModule($id, $params);

        if (!$module) {
            return $this->responseRedirectBack('Module delete error', 'error', true, true);
        }
        return $this->responseRedirect('modules.index', 'Module delete success' ,'success',false, false);
    }

    public function restore()
    {
        $modules = $this->moduleRepository->restore();

        if (!$modules) {
            return $this->responseRedirectBack(trans('module.restore_error'), 'error', true, true);
        }
        return $this->responseRedirect('modules.index', trans('module.restore_success') ,'success',false, false);
    }
}
