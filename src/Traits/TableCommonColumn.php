<?php
namespace Mukul\Matrixusermanagement\Traits;


/**
 * Trait TableCommonColumn
 * @package Mukul\Matrixusermanagement\Traits
 */
trait TableCommonColumn
{
    public function commonColumns($table)
    {
        $table->enum('status', ['active','inactive'])->default('active');
        $table->timestamps();
        $table->softDeletes();
        $table->unsignedBigInteger('created_by');
        $table->foreign('created_by')->references('id')->on('sys_users')->onDelete('cascade');
        $table->unsignedBigInteger('updated_by');
        $table->foreign('updated_by')->references('id')->on('sys_users')->onDelete('cascade');
        $table->unsignedBigInteger('deleted_by');
        $table->foreign('deleted_by')->references('id')->on('sys_users')->onDelete('cascade');
        $table->unsignedBigInteger('company_id');
        $table->foreign('company_id')->references('id')->on('sys_companies')->onDelete('cascade');
    }
}
