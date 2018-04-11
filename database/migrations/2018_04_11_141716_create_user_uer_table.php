<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserUerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('subscriber_id')->unsigned();
            $table->integer('author_id')->unsigned();

            $table->foreign('subscriber_id')->references('id')->on('users');
            $table->foreign('author_id')->references('id')->on('users');

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
        Schema::dropIfExists('user_user');
    }
}
