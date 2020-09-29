<?php


namespace Mukul\Matrixusermanagement\Models;


use Illuminate\Database\Eloquent\Model;

class SysPrivilegeModule extends Model
{
    protected $fillable = [
        'sys_user_id',
        'sys_module_id',
        'sys_role_id',
    ];
}
