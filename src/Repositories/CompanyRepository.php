<?php

namespace Mukul\Matrixusermanagement\Repositories;

use Mukul\Matrixusermanagement\Contracts\CompanyContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Mukul\Matrixusermanagement\Models\SysCompany;
use Yajra\DataTables\Facades\DataTables;

class CompanyRepository extends BaseRepository implements CompanyContract
{
    /**
     * CompanyRepository constructor.
     * @param Company $model
     */
    public function __construct(SysCompany $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function companyList(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        $query = $this->all();
        return Datatables::of($query)
            ->addColumn('action', function ($row) {
                $actions = '';

                $actions .= '<a class="btn btn-primary btn-xs float-left mr-1" href="' . route('companies.edit', [$row->id]) . '" title="Company Edit"><i class="fa fa-pencil"></i> Edit</a>';

                $actions .= '
                    <form action="' . route('companies.destroy', [$row->id]) . '" method="POST">
                        <input type="hidden" name="_method" value="delete">
                        <input type="hidden" name="_token" value="' . csrf_token() . '">
                        <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-remove"></i> Delete</button>
                    </form>
                ';

                return $actions;
            })
            ->make(true);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findCompanyById(int $id)
    {
        try {
            return $this->findOneOrFail($id);

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }

    }

    /**
     * @param array $params
     * @return Company|mixed
     */
    public function createCompany(array $params)
    {
        try {
            $collection = collect($params);

            $created_by = 1;//auth()->user()->id;

            $merge = $collection->merge(compact('created_by'));

            $company = new SysCompany($merge->all());

            $company->save();

            return $company;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateCompany(array $params)
    {
        $company = $this->findCompanyById($params['id']);

        $collection = collect($params)->except('_token');

        $updated_by = 1;//auth()->user()->id;

        $merge = $collection->merge(compact('updated_by'));

        $company->update($merge->all());

        return $company;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteCompany($id, array $params)
    {
        $company = $this->findCompanyById($id);

        $company->delete();

        $collection = collect($params)->except('_token');

        $deleted_by = 1;//auth()->user()->id;

        $merge = $collection->merge(compact('deleted_by'));

        $company->update($merge->all());

        return $company;
    }

    /**
     * @return mixed
     */
    public function restore()
    {
        return $this->restoreOnlyTrashed();
    }
}
