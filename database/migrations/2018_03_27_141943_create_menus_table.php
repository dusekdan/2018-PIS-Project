<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->dateTime('validityStart');
            $table->dateTime('validityEnd');
            $table->string('name');
            $table->unsignedInteger('soup_id')->nullable();
            $table->unsignedInteger('meal_1_id')->nullable();
            $table->unsignedInteger('meal_2_id')->nullable();
            $table->unsignedInteger('meal_3_id')->nullable();
            $table->foreign('soup_id')->references('id')->on('orderables');
            $table->foreign('meal_1_id')->references('id')->on('orderables');
            $table->foreign('meal_2_id')->references('id')->on('orderables');
            $table->foreign('meal_3_id')->references('id')->on('orderables');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
}
