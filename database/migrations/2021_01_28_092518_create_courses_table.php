<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('enabled')->default(false);
            $table->date('start')->nullable();
            $table->date('end')->nullable();
            $table->string('duration');
            $table->string('education_time');
            $table->text('description');
            $table->text('program');
            $table->text('conditions')->nullable();
            $table->text('target_audience')->nullable();
            $table->string('impl_form');
            $table->foreignId('leader_id')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('courses');
    }
}
