<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postfiles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('file_name');
            $table->string('file_type');
            $table->string('file_size');
            $table->integer('post_id')->unsigned();
            $table->timestamps();
        });
        Schema::table('postfiles', function ($table){
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropForeign(['post_id']);
        Schema::dropIfExists('postfiles');
    }
}
