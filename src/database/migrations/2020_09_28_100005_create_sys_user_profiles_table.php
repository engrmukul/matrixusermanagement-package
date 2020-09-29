<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Mukul\Matrixusermanagement\Traits\TableCommonColumn;

class CreateSysUserProfilesTable extends Migration
{
    use TableCommonColumn;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_user_profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name',100);
            $table->string('last_name',100);
            $table->string('spouse_name',100);
            $table->string('mobile',14);
            $table->date('date_of_birth');
            $table->enum('blood_group', ['A+','A-','B+','B-','O+','O-','AB+','AB-',''])->default('');
            $table->enum('gender', ['Female','Male','Common'])->default('Male');
            $table->enum('religion', ['Buddhist','Christian','Hindu','Islam','Others'])->default('Islam');
            $table->enum('marital_status', ['Married','Unmarried','Divorced','Widow','Single'])->default('Unmarried');
            $table->string('father_name',100);
            $table->string('mother_name',100);
            $table->string('nationality',50);
            $table->string('nid',20);
            $table->string('tin',20);
            $table->string('passport',100);
            $table->string('image',100)->default('/img/users/avatar.png');
            $table->string('sign',100);
            $table->text('address');
            $table->date('date_of_join');
            $table->string('default_url',255);
            $table->smallInteger('default_module_id',3)->autoIncrement(false)->default(0);
            $table->smallInteger('designation_id',3)->autoIncrement(false);
            $table->smallInteger('department_id',3)->autoIncrement(false);
            $table->smallInteger('branches_id',3)->autoIncrement(false)->default(1);
            $table->tinyInteger('is_reliever',1)->autoIncrement(false)->default(0);
            $table->unsignedBigInteger('reliever_to');
            $table->foreign('reliever_to')->nullable()->references('id')->on('sys_users')->onDelete('cascade');
            $table->dateTime('reliever_start_datetime');
            $table->dateTime('reliever_end_datetime');
            $table->enum('working_type', ['Full Time','Part Time','Contractual','On Call'])->default('Full Time');
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
        Schema::dropIfExists('sys_user_profiles');
    }
}
