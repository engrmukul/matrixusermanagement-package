<?php


namespace Mukul\Matrixusermanagement\Models;


use Illuminate\Database\Eloquent\Model;

class SysPrivilegeMenu extends Model
{
    protected $fillable = [
        'sys_user_id',
        'sys_menu_id',
        'sys_role_id',
        'create_permission',
        'edit_permission',
        'delete_permission',
        'view_permission',
    ];
}
