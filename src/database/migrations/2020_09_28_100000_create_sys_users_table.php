<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Mukul\Matrixusermanagement\Traits\TableCommonColumn;

class CreateSysUsersTable extends Migration
{
    use TableCommonColumn;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code',20)->unique();
            $table->string('username',150);
            $table->string('email',100)->unique();
            $table->string('password',100);
            $table->string('password_key',50);
            $table->tinyInteger('is_employee',1)->autoIncrement(false)->default(0);
            $table->timestamp('email_verified_at');
            $table->dateTime('last_login');
            $table->string('remember_token',100);
            $table->dateTime('password_changed_date');
            $table->tinyInteger('wrong_attempts_count', 1)->autoIncrement(false)->nullable(true)->default(0);
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
        Schema::dropIfExists('sys_users');
    }
}
