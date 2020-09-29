<?php


namespace Mukul\Matrixusermanagement\Models;


use Illuminate\Database\Eloquent\Model;

class SysBranch extends Model
{
    protected $fillable = [
        'name',
        'address',
        'email',
        'phone',
        'mobile',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by',
        'updated_by',
        'deleted_by',
        'company_id',
    ];
}
