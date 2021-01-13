<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('nickname')->nullable();
            $table->string('color')->nullable();
            $table->string('interests')->nullable();
            $table->string('avatar')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->integer('pin')->nullable();
            // $table->foreignId('counselor_id')->references('id')->on('counselors');
            $table->foreignId('counselor_id')->constraint('counselor')->nullable();
            // $table->foreignId('class_id')->references('id')->on('classes');
            $table->foreignId('class_id')->constraint('class')->nullable();
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
        Schema::dropIfExists('students');
    }
}
