<?php


namespace Mukul\Matrixusermanagement\Models;


use Illuminate\Database\Eloquent\Model;

class SysUserProfile extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'spouse_name',
        'mobile',
        'date_of_birth',
        'blood_group',
        'gender',
        'religion',
        'marital_status',
        'father_name',
        'mother_name',
        'nationality',
        'nid',
        'tin',
        'passport',
        'image',
        'sign',
        'address',
        'date_of_join',
        'default_url',
        'default_module_id',
        'designation_id',
        'department_id',
        'branches_id',
        'is_reliever',
        'reliever_to',
        'reliever_start_datetime',
        'reliever_end_datetime',
        'working_type',
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
