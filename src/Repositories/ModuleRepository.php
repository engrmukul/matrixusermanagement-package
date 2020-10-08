<?php

namespace Mukul\Matrixusermanagement\Repositories;

use Mukul\Matrixusermanagement\Contracts\ModuleContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Mukul\Matrixusermanagement\Models\SysModule;
use Yajra\DataTables\Facades\DataTables;

class ModuleRepository extends BaseRepository implements ModuleContract
{
    /**
     * ModuleRepository constructor.
     * @param Module $model
     */
    public function __construct(SysModule $model)
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
    public function moduleList(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        $query = $this->companyWiseAllData();
        return Datatables::of($query)
            ->addColumn('action', function ($row) {
                $actions = '';

                $actions .= '<a class="btn btn-primary btn-xs float-left mr-1" href="' . route('modules.edit', [$row->id]) . '" title="Module Edit"><i class="fa fa-pencil"></i> Edit</a>';

                $actions .= '
                    <form action="' . route('modules.destroy', [$row->id]) . '" method="POST">
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
    public function findModuleById(int $id)
    {
        try {
            return $this->findOneOrFail($id);

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }

    }

    /**
     * @param array $params
     * @return Module|mixed
     */
    public function createModule(array $params)
    {
        try {
            $collection = collect($params);

            $created_by = auth()->user()->id;

            $company_id = auth()->user()->company_id;

            $merge = $collection->merge(compact('created_by', 'company_id'));

            $module = new SysModule($merge->all());

            $module->save();

            return $module;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateModule(array $params)
    {
        $module = $this->findModuleById($params['id']);

        $collection = collect($params)->except('_token');

        $updated_by = auth()->user()->id;

        $merge = $collection->merge(compact('updated_by'));

        $module->update($merge->all());

        return $module;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteModule($id, array $params)
    {
        $module = $this->findModuleById($id);

        $module->delete();

        $collection = collect($params)->except('_token');

        $deleted_by = auth()->user()->id;

        $merge = $collection->merge(compact('deleted_by'));

        $module->update($merge->all());

        return $module;
    }

    /**
     * @return mixed
     */
    public function restore()
    {
        return $this->restoreOnlyTrashed();
    }

    public function getModuleList()
    {
        return SysModule::where('company_id', 3)->get();
    }
}
