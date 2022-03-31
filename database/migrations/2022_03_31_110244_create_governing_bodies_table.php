<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoverningBodiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('governing_bodies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('file_path');
            $table->string('designation');
            $table->string('email');
            $table->string('mobile_no');
            $table->string('tearms_start_year')->nullable();
            $table->string('tearms_end_year')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('governing_bodies');
    }
}
