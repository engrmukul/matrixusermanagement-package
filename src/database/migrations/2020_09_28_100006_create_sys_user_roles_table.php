<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Mukul\Matrixusermanagement\Traits\TableCommonColumn;

class CreateSysUserRolesTable extends Migration
{
    use TableCommonColumn;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_user_roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100);
            $table->string('description', 200);
            $table->integer('min_username_length', 2)->autoIncrement(false)->default(6);
            $table->integer('max_username_length', 2)->autoIncrement(false)->default(25);
            $table->tinyInteger('multi_login_allow', 1)->autoIncrement(false)->default(0);
            $table->integer('max_wrong_login_attempt', 1)->autoIncrement(false)->default(3);
            $table->enum('wrong_login_attempt', ['No Restriction', 'Blocked', 'Block for a Period'])->default('No Restriction');
            $table->integer('block_period', 4)->autoIncrement(false)->default(30);
            $table->integer('session_time_out', 3)->autoIncrement(false)->default(30);
            $table->string('password_regEx', 255);
            $table->string('password_regEx_error_msg', 255);
            $table->integer('password_expiry_notify', 3)->autoIncrement(false)->default(15);
            $table->integer('password_expiry_duration', 3)->autoIncrement(false)->default(90);
            $table->enum('password_expiry_action', ['Notify', 'Force'])->default('Notify');
            $this->commonColumns($table);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sys_user_roles');
    }
}
