<?php


Route::group(['namespace'=>'Mukul\Matrixusermanagement\Http\Controllers'], function (){
    Route::get('users', 'MuserController@index')->name('users');
});
