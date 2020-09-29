<?php


namespace Mukul\Matrixusermanagement\Models;


use Illuminate\Database\Eloquent\Model;

class SysUser extends Model
{
    protected $fillable = [
        'code',
        'username',
        'email',
        'password',
        'password_key',
        'is_employee',
        'email_verified_at',
        'last_login',
        'remember_token',
        'password_changed_date',
        'wrong_attempts_count',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by',
        'updated_by',
        'deleted_by',
        'company_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
