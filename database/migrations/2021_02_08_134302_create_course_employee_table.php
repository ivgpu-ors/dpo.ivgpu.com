<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseEmployeeTable extends Migration
{
    public function up()
    {
        Schema::create('course_employee', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->foreignId('course_id');
            $table->foreignId('employee_id');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('course_employee');
    }
}
