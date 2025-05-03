<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDinnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dinners', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('food_id')->unsigned()->nullable();
            $table->float('serving_size');
            $table->float('servings_per_container');
            $table->bigInteger('unit_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('food_id')->references('id')->on('food')->onDelete('cascade');
            $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dinners');
    }
}
