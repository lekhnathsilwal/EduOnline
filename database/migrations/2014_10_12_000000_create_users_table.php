<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name');
            $table->string('user_name')->unique();
            $table->string('address');
            $table->bigInteger('contact');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('engaged_college');
            $table->string('teaching_faculty');
            $table->string('teaching_program');
            $table->string('citizenship');
            $table->string('teacher_card');
            $table->string('profile_picture');
            $table->string('verification');
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
