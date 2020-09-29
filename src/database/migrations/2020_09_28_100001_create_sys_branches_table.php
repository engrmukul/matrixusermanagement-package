<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Mukul\Matrixusermanagement\Traits\TableCommonColumn;

class CreateSysBranchesTable extends Migration
{
    use TableCommonColumn;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_branches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',200);
            $table->text('address');
            $table->string('email',50);
            $table->string('phone',14);
            $table->string('mobile',14);
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
        Schema::dropIfExists('sys_branches');
    }
}
