<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student', function (Blueprint $table) {
            $table->id();
            $table->string('maso');
            $table->string('name');
            $table->string('password');
            $table->string('email');
            $table->string('image');
            $table->integer('course_id');
            $table->integer('faculty_id');
            $table->integer('major_id');
            $table->integer('phone');
            $table->integer('district_id');
            $table->integer('ward_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student');
    }
}
