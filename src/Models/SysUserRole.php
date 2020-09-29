<?php


namespace Mukul\Matrixusermanagement\Models;


use Illuminate\Database\Eloquent\Model;

class SysUserRole extends Model
{
    protected $fillable = [
        'name',
        'description',
        'min_username_length',
        'max_username_length',
        'multi_login_allow',
        'max_wrong_login_attempt',
        'wrong_login_attempt',
        'block_period',
        'session_time_out',
        'password_regEx',
        'password_regEx_error_msg',
        'password_expiry_notify',
        'password_expiry_duration',
        'password_expiry_action',
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
