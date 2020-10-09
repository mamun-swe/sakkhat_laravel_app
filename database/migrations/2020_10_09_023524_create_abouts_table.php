<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abouts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('uid');
            $table->string('phone')->nullable();;
            $table->string('school')->nullable();;
            $table->string('school_year')->nullable();;
            $table->string('college')->nullable();;
            $table->string('college_year')->nullable();;
            $table->string('university')->nullable();;
            $table->string('university_year')->nullable();;
            $table->string('address')->nullable();;
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
        Schema::dropIfExists('abouts');
    }
}
