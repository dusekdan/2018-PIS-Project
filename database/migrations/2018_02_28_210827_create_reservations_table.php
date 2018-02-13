<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->dateTime('reservation_start_time');
            $table->dateTime('reservation_end_time');
            $table->enum('status', ["Přijata", "Potvrzena", "Zamítnuta", "Stornována", "Realizována"]);
            $table->integer('number_of_people');
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('reservation_key')->default("ABCDEFGHIJKLMNOPGRST");
            $table->text('note');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
