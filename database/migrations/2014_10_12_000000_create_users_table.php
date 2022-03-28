<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('abvp_no')->nullable();
            $table->string('email')->nullable()->unique();
            $table->string('member_name');
            $table->string('father_or_husband_name');
            $table->string('gender')->nullable();
            $table->date('dob')->nullable();
            $table->date('ma')->nullable();
            $table->string('aadhar_no')->nullable();
            $table->string('qualification')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('address');
            $table->string('city');
            $table->string('pin_code');
            $table->string('mobile_mo')->nullable();
            $table->string('password');
            $table->tinyInteger('status')->default('1')->comment('1 = Active, 0 = Inactive');
            $table->softDeletes();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}