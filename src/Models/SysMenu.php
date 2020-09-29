<?php


namespace Mukul\Matrixusermanagement\Models;


use Illuminate\Database\Eloquent\Model;

class SysMenu extends Model
{
    protected $fillable = [
        'name',
        'description',
        'menu_type',
        'parent_id',
        'sys_module_id',
        'icon',
        'menu_url',
        'sort_number',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by',
        'updated_by',
        'deleted_by',
        'company_id'
    ];
}
