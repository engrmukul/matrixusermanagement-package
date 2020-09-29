<?php


namespace Mukul\Matrixusermanagement\Models;


use Illuminate\Database\Eloquent\Model;

class SysPrivilegeRole extends Model
{
    protected $fillable = [
        'sys_user_id',
        'sys_role_id'
    ];
}
