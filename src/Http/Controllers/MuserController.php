<?php


namespace Mukul\Matrixusermanagement\Http\Controllers;


use Mukul\Matrixusermanagement\Http\Controllers\BaseController;
use Mukul\Matrixusermanagement\Models\SysUser;

class MuserController extends BaseController
{
    public function index()
    {
        dd(SysUser::all());
    }
}
