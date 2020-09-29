<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSysCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',100);
            $table->string('phone',14);
            $table->string('website',150);
            $table->string('logo',150);
            $table->text('address');
            $table->enum('status', ['active','inactive'])->default('active');
            $table->timestamps();
            $table->softDeletes();
            //$table->foreignId('created_by')->references('id')->on('sys_users')->onDelete('cascade');
            //$table->foreignId('updated_by')->nullable()->references('id')->on('sys_users')->onDelete('cascade');
            //$table->foreignId('deleted_by')->nullable()->references('id')->on('sys_users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sys_companies');
    }
}
