<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRhymeCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_rhyme', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('rhyme_id')->unsigned();
            $table->integer('category_id')->unsigned();

            $table->foreign('rhyme_id')->references('id')->on('rhymes');
            $table->foreign('category_id')->references('id')->on('categories');

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
        Schema::dropIfExists('category_rhyme');
    }
}
