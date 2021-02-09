<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseOptionTable extends Migration
{
    public function up()
    {
        Schema::create('course_option', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->foreignId('course_id');
            $table->foreignId('option_id');
            $table->integer('price')->default(0);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('course_option');
    }
}
