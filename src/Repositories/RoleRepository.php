<?php

namespace Mukul\Matrixusermanagement\Repositories;

use Mukul\Matrixusermanagement\Contracts\RoleContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Mukul\Matrixusermanagement\Models\SysUserRole;
use Yajra\DataTables\Facades\DataTables;

class RoleRepository extends BaseRepository implements RoleContract
{
    /**
     * RoleRepository constructor.
     * @param UserRole $model
     */
    public function __construct(SysUserRole $model)
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
    public function roleList(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        $query = $this->companyWiseAllData();
        return Datatables::of($query)
            ->addColumn('action', function ($row) {
                $actions = '';

                $actions .= '<a class="btn btn-primary btn-xs float-left mr-1" href="' . route('roles.edit', [$row->id]) . '" title="UserRole Edit"><i class="fa fa-pencil"></i> Edit</a>';

                $actions .= '
                    <form action="' . route('roles.destroy', [$row->id]) . '" method="POST">
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
    public function findRoleById(int $id)
    {
        try {
            return $this->findOneOrFail($id);

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }

    }

    /**
     * @param array $params
     * @return UserRole|mixed
     */
    public function createRole(array $params)
    {
        try {
            $collection = collect($params);

            $created_by = auth()->user()->id;

            $company_id = auth()->user()->company_id;

            $merge = $collection->merge(compact('created_by', 'company_id'));

            $userRole = new SysUserRole($merge->all());

            $userRole->save();

            return $userRole;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateRole(array $params)
    {
        $userRole = $this->findRoleById($params['id']);

        $collection = collect($params)->except('_token');

        $updated_by = auth()->user()->id;

        $merge = $collection->merge(compact('updated_by'));

        $userRole->update($merge->all());

        return $userRole;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteRole($id, array $params)
    {
        $userRole = $this->findRoleById($id);

        $userRole->delete();

        $collection = collect($params)->except('_token');

        $deleted_by = auth()->user()->id;

        $merge = $collection->merge(compact('deleted_by'));

        $userRole->update($merge->all());

        return $userRole;
    }

    /**
     * @return mixed
     */
    public function restore()
    {
        return $this->restoreOnlyTrashed();
    }
}
