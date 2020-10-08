<?php

namespace Mukul\Matrixusermanagement\Http\Controllers;

use Mukul\Matrixusermanagement\Models\SysUser;

class MatrixUserController extends BaseController
{
    public function index()
    {
        dd(SysUser::all());
    }
}
