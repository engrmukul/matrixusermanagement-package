<?php

namespace Mukul\Matrixusermanagement\Repositories;

use Mukul\Matrixusermanagement\Contracts\DesignationContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Mukul\Matrixusermanagement\Models\SysDesignation;
use Yajra\DataTables\Facades\DataTables;

class DesignationRepository extends BaseRepository implements DesignationContract
{
    /**
     * DesignationRepository constructor.
     * @param Designation $model
     */
    public function __construct(SysDesignation $model)
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
    public function designationList(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        $query = $this->companyWiseAllData();
        return Datatables::of($query)
            ->addColumn('action', function ($row) {
                $actions = '';

                $actions .= '<a class="btn btn-primary btn-xs float-left mr-1" href="' . route('designations.edit', [$row->id]) . '" title="Designation Edit"><i class="fa fa-pencil"></i> Edit</a>';

                $actions .= '
                    <form action="' . route('designations.destroy', [$row->id]) . '" method="POST">
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
    public function findDesignationById(int $id)
    {
        try {
            return $this->findOneOrFail($id);

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }

    }

    /**
     * @param array $params
     * @return Designation|mixed
     */
    public function createDesignation(array $params)
    {
        try {
            $collection = collect($params);

            $created_by = auth()->user()->id;

            $company_id = auth()->user()->company_id;

            $merge = $collection->merge(compact('created_by', 'company_id'));

            $designation = new SysDesignation($merge->all());

            $designation->save();

            return $designation;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateDesignation(array $params)
    {
        $designation = $this->findDesignationById($params['id']);

        $collection = collect($params)->except('_token');

        $updated_by = auth()->user()->id;

        $merge = $collection->merge(compact('updated_by'));

        $designation->update($merge->all());

        return $designation;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteDesignation($id, array $params)
    {
        $designation = $this->findDesignationById($id);

        $designation->delete();

        $collection = collect($params)->except('_token');

        $deleted_by = auth()->user()->id;

        $merge = $collection->merge(compact('deleted_by'));

        $designation->update($merge->all());

        return $designation;
    }

    /**
     * @return mixed
     */
    public function restore()
    {
        return $this->restoreOnlyTrashed();
    }
}
