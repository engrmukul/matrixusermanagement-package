<?php

namespace Mukul\Matrixusermanagement\Http\Controllers;

use  Mukul\Matrixusermanagement\Models\SysMenu;
use Illuminate\Http\Request;
use Mukul\Matrixusermanagement\Contracts\MenuContract;
use Mukul\Matrixusermanagement\Http\Requests\MenuStoreFormRequest;
use Mukul\Matrixusermanagement\Http\Requests\MenuUpdateFormRequest;

class MenuController extends BaseController
{
    protected $menuRepository;

    public function __construct(MenuContract $menuRepository)
    {
        $this->menuRepository = $menuRepository;
    }

    public function index()
    {
        $this->setPageTitle('Menus', 'Menu List');

        $data = [
            'tableHeads' => ['SN','name','menu_type','parent_id','sys_module_id','icon','module_url','sort_number','status','action'],
            'dataUrl' => 'menus/get-data',
            'columns' => [
                ['data' => 'id', 'name' => 'id'],
                ['data' => 'name', 'name' => 'name'],
                ['data' => 'menu_type', 'name' => 'menu_type'],
                ['data' => 'parent_id', 'name' => 'parent_id'],
                ['data' => 'sys_module_id', 'name' => 'sys_module_id'],
                ['data' => 'icon', 'name' => 'icon'],
                ['data' => 'module_url', 'name' => 'module_url'],
                ['data' => 'sort_number', 'name' => 'sort_number'],
                ['data' => 'status', 'name' => 'status'],
                ['data' => 'action', 'name' => 'action', 'orderable' => false]
            ],
        ];

        return view('matrixusermanagement::menus.index', $data);
    }

    public function getData(Request $request)
    {
        return $this->menuRepository->menuList($request);
    }

    public function create()
    {
        $this->setPageTitle('Menus', 'Create Menu');

        return view('matrixusermanagement::menus.create');
    }

    public function store(MenuStoreFormRequest $request)
    {
        $params = $request->except('_token');

        $menu = $this->menuRepository->createMenu($params);

        if (!$menu) {
            return $this->responseRedirectBack('Menu create error', 'error', true, true);
        }
        return $this->responseRedirect('menus.index', 'Menu create success', 'success', false, false);
    }

    public function edit($id)
    {
        $menu = $this->menuRepository->findMenuById($id);

        $this->setPageTitle('Menus', 'Edit Menu');
        return view('matrixusermanagement::menus.edit', compact('menu'));
    }

    public function update(MenuUpdateFormRequest $request, SysMenu $sysMenuModel)
    {
        $params = $request->except('_token');

        $menu = $this->menuRepository->updateMenu($params);

        if (!$menu) {
            return $this->responseRedirectBack('Menu update error', 'error', true, true);
        }
        return $this->responseRedirect('menus.index', 'Menu update success', 'success', false, false);
    }

    public function destroy(Request $request, $id)
    {
        $params = $request->except('_token');
        $menu = $this->menuRepository->deleteMenu($id, $params);

        if (!$menu) {
            return $this->responseRedirectBack('Menu delete error', 'error', true, true);
        }
        return $this->responseRedirect('menus.index', 'Menu delete success' ,'success',false, false);
    }

    public function restore()
    {
        $menus = $this->menuRepository->restore();

        if (!$menus) {
            return $this->responseRedirectBack(trans('menu.restore_error'), 'error', true, true);
        }
        return $this->responseRedirect('menus.index', trans('menu.restore_success') ,'success',false, false);
    }
}
