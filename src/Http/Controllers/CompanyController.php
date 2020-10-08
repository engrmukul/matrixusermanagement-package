<?php

namespace Mukul\Matrixusermanagement\Http\Controllers;

use  Mukul\Matrixusermanagement\Models\SysCompany;
use Illuminate\Http\Request;
use Mukul\Matrixusermanagement\Contracts\CompanyContract;
use Mukul\Matrixusermanagement\Http\Requests\CompanyStoreFormRequest;
use Mukul\Matrixusermanagement\Http\Requests\CompanyUpdateFormRequest;

class CompanyController extends BaseController
{
    protected $companyRepository;

    public function __construct(CompanyContract $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    public function index()
    {
        $this->setPageTitle('Companies', 'Company List');

        $data = [
            'tableHeads' => ['SN','name','email','phone','status','action'],
            'dataUrl' => 'companies/get-data',
            'columns' => [
                ['data' => 'id', 'name' => 'id'],
                ['data' => 'name', 'name' => 'name'],
                ['data' => 'email', 'name' => 'email'],
                ['data' => 'phone', 'name' => 'phone'],
                ['data' => 'status', 'name' => 'status'],
                ['data' => 'action', 'name' => 'action', 'orderable' => false]
            ],
        ];

        return view('matrixusermanagement::companies.index', $data);
    }

    public function getData(Request $request)
    {
        return $this->companyRepository->companyList($request);
    }

    public function create()
    {
        $this->setPageTitle('Companies', 'Create Company');

        return view('matrixusermanagement::companies.create');
    }

    public function store(CompanyStoreFormRequest $request)
    {
        $params = $request->except('_token');

        $company = $this->companyRepository->createCompany($params);

        if (!$company) {
            return $this->responseRedirectBack('Company create error', 'error', true, true);
        }
        return $this->responseRedirect('companies.index', 'Company create success', 'success', false, false);
    }

    public function edit($id)
    {
        $company = $this->companyRepository->findCompanyById($id);

        $this->setPageTitle('Companies', 'Edit Company');
        return view('matrixusermanagement::companies.edit', compact('company'));
    }

    public function update(CompanyUpdateFormRequest $request, SysCompany $sysCompanyModel)
    {
        $params = $request->except('_token');

        $company = $this->companyRepository->updateCompany($params);

        if (!$company) {
            return $this->responseRedirectBack('Company update error', 'error', true, true);
        }
        return $this->responseRedirect('companies.index', 'Company update success', 'success', false, false);
    }

    public function destroy(Request $request, $id)
    {
        $params = $request->except('_token');
        $company = $this->companyRepository->deleteCompany($id, $params);

        if (!$company) {
            return $this->responseRedirectBack('Company delete error', 'error', true, true);
        }
        return $this->responseRedirect('companies.index', 'Company delete success' ,'success',false, false);
    }

    public function restore()
    {
        $companies = $this->companyRepository->restore();

        if (!$companies) {
            return $this->responseRedirectBack(trans('company.restore_error'), 'error', true, true);
        }
        return $this->responseRedirect('companies.index', trans('company.restore_success') ,'success',false, false);
    }
}
