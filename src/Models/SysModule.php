<?php


namespace Mukul\Matrixusermanagement\Models;


use Illuminate\Database\Eloquent\Model;

class SysModule extends Model
{
    protected $fillable = [
        'name',
        'icon',
        'module_lang',
        'description',
        'home_url',
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
