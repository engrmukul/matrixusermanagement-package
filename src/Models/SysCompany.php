<?php


namespace Mukul\Matrixusermanagement\Models;


use Illuminate\Database\Eloquent\Model;

class SysCompany extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'website',
        'logo',
        'address',
        'status',
    ];
}
