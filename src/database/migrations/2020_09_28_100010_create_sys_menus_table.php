<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Mukul\Matrixusermanagement\Traits\TableCommonColumn;

class CreateSysMenusTable extends Migration
{
    use TableCommonColumn;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_menus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',100);
            $table->text('description');
            $table->enum('menu_type', ['Main','Sub'])->default('Main');
            $table->unsignedBigInteger('parent_id');
            $table->foreign('parent_id')->references('id')->on('sys_menus')->onDelete('cascade');
            $table->unsignedBigInteger('sys_module_id');
            $table->foreign('sys_module_id')->references('id')->on('sys_modules')->onDelete('cascade');
            $table->string('icon',100);
            $table->string('menu_url',150);
            $table->smallInteger('sort_number',2)->autoIncrement(false);
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
        Schema::dropIfExists('sys_menus');
    }
}
