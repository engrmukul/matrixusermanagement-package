<?php


Route::group(['middleware' => ['web'], 'namespace'=>'Mukul\Matrixusermanagement\Http\Controllers'], function (){
    Route::get('matrix-users', 'MatrixUserController@index')->name('matrix.users');

    Route::resource('companies', 'CompanyController', ['except' => ['show']]);
    Route::get('companies/get-data', 'CompanyController@getData');

    Route::resource('branches', 'BranchController', ['except' => ['show']]);
    Route::get('branches/get-data', 'BranchController@getData');

    Route::resource('departments', 'DepartmentController', ['except' => ['show']]);
    Route::get('departments/get-data', 'DepartmentController@getData');

    Route::resource('designations', 'DesignationController', ['except' => ['show']]);
    Route::get('designations/get-data', 'DesignationController@getData');

    Route::resource('modules', 'ModuleController', ['except' => ['show']]);
    Route::get('modules/get-data', 'ModuleController@getData');

    Route::resource('menus', 'MenuController', ['except' => ['show']]);
    Route::get('menus/get-data', 'MenuController@getData');

    Route::resource('roles', 'RoleController', ['except' => ['show']]);
    Route::get('roles/get-data', 'RoleController@getData');
});
