<?php

namespace Mukul\Matrixusermanagement\Repositories;

use Mukul\Matrixusermanagement\Contracts\MenuContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Mukul\Matrixusermanagement\Models\SysMenu;
use Yajra\DataTables\Facades\DataTables;

class MenuRepository extends BaseRepository implements MenuContract
{
    /**
     * MenuRepository constructor.
     * @param Menu $model
     */
    public function __construct(SysMenu $model)
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
    public function menuList(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        $query = $this->companyWiseAllData();
        return Datatables::of($query)
            ->addColumn('action', function ($row) {
                $actions = '';

                $actions .= '<a class="btn btn-primary btn-xs float-left mr-1" href="' . route('menus.edit', [$row->id]) . '" title="Menu Edit"><i class="fa fa-pencil"></i> Edit</a>';

                $actions .= '
                    <form action="' . route('menus.destroy', [$row->id]) . '" method="POST">
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
    public function findMenuById(int $id)
    {
        try {
            return $this->findOneOrFail($id);

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }

    }

    /**
     * @param array $params
     * @return Menu|mixed
     */
    public function createMenu(array $params)
    {
        try {
            $collection = collect($params);

            $created_by = auth()->user()->id;

            $company_id = auth()->user()->company_id;

            $merge = $collection->merge(compact('created_by', 'company_id'));

            $menu = new SysMenu($merge->all());

            $menu->save();

            return $menu;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateMenu(array $params)
    {
        $menu = $this->findMenuById($params['id']);

        $collection = collect($params)->except('_token');

        $updated_by = auth()->user()->id;

        $merge = $collection->merge(compact('updated_by'));

        $menu->update($merge->all());

        return $menu;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteMenu($id, array $params)
    {
        $menu = $this->findMenuById($id);

        $menu->delete();

        $collection = collect($params)->except('_token');

        $deleted_by = auth()->user()->id;

        $merge = $collection->merge(compact('deleted_by'));

        $menu->update($merge->all());

        return $menu;
    }

    /**
     * @return mixed
     */
    public function restore()
    {
        return $this->restoreOnlyTrashed();
    }

    /**
     * @return mixed
     */
    public function treeList()
    {
        //return SysMenu::where('company_id', auth()->user()->shop_id)->orderByRaw('-name ASC')
        return SysMenu::where('company_id', 3)->orderByRaw('-name ASC')
            ->get()
            ->nest()
            ->setIndent('|––> ')
            ->listsFlattened('name');
    }
}
