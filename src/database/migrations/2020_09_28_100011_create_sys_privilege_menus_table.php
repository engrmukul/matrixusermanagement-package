<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSysPrivilegeMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_privilege_menus', function (Blueprint $table) {
            $table->unsignedBigInteger('sys_user_id');
            $table->foreign('sys_user_id')->references('id')->on('sys_users')->onDelete('cascade');
            $table->unsignedBigInteger('sys_menu_id');
            $table->foreign('sys_menu_id')->references('id')->on('sys_menus')->onDelete('cascade');
            $table->unsignedBigInteger('sys_role_id');
            $table->foreign('sys_role_id')->references('id')->on('sys_user_roles')->onDelete('cascade');
            $table->tinyInteger('create_permission', 1)->autoIncrement(false)->default(0);
            $table->tinyInteger('edit_permission', 1)->autoIncrement(false)->default(0);
            $table->tinyInteger('delete_permission', 1)->autoIncrement(false)->default(0);
            $table->tinyInteger('view_permission', 1)->autoIncrement(false)->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sys_privilege_menus');
    }
}
