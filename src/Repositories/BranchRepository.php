<?php

namespace Mukul\Matrixusermanagement\Repositories;

use Mukul\Matrixusermanagement\Contracts\BranchContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Mukul\Matrixusermanagement\Models\SysBranch;
use Yajra\DataTables\Facades\DataTables;

class BranchRepository extends BaseRepository implements BranchContract
{
    /**
     * BranchRepository constructor.
     * @param Branch $model
     */
    public function __construct(SysBranch $model)
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
    public function branchList(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        $query = $this->companyWiseAllData();
        return Datatables::of($query)
            ->addColumn('action', function ($row) {
                $actions = '';

                $actions .= '<a class="btn btn-primary btn-xs float-left mr-1" href="' . route('branches.edit', [$row->id]) . '" title="Branch Edit"><i class="fa fa-pencil"></i> Edit</a>';

                $actions .= '
                    <form action="' . route('branches.destroy', [$row->id]) . '" method="POST">
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
    public function findBranchById(int $id)
    {
        try {
            return $this->findOneOrFail($id);

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }

    }

    /**
     * @param array $params
     * @return Branch|mixed
     */
    public function createBranch(array $params)
    {
        try {
            $collection = collect($params);

            $created_by = 1;//auth()->user()->id;

           $company_id = 3;//auth()->user()->company_id;

            $merge = $collection->merge(compact('created_by', 'company_id'));

           $branch = new SysBranch($merge->all());

           $branch->save();

            return$branch;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateBranch(array $params)
    {
       $branch = $this->findBranchById($params['id']);

        $collection = collect($params)->except('_token');

        $updated_by = 1;//auth()->user()->id;

        $merge = $collection->merge(compact('updated_by'));

       $branch->update($merge->all());

        return$branch;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteBranch($id, array $params)
    {
       $branch = $this->findBranchById($id);

       $branch->delete();

        $collection = collect($params)->except('_token');

        $deleted_by = 1;//auth()->user()->id;

        $merge = $collection->merge(compact('deleted_by'));

       $branch->update($merge->all());

        return$branch;
    }

    /**
     * @return mixed
     */
    public function restore()
    {
        return $this->restoreOnlyTrashed();
    }
}
