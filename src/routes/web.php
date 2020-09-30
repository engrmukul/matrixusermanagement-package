<?php


Route::group(['namespace'=>'Mukul\Matrixusermanagement\Http\Controllers'], function (){
    Route::get('matrix-users', 'MatrixUserController@index')->name('matrix.users');
    Route::resource('companies', 'CompanyController', ['except' => ['show']]);
    Route::get('companies/get-data', 'CompanyController@getData');
});
