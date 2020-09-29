<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Mukul\Matrixusermanagement\Traits\TableCommonColumn;

class CreateSysDesignationsTable extends Migration
{
    use TableCommonColumn;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_designations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',200);
            $table->string('short_name',50);
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
        Schema::dropIfExists('sys_designations');
    }
}
