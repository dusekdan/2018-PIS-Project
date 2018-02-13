<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderOrderableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_orderable', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('order_id');
            $table->unsignedInteger('orderable_id');
            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('orderable_id')->references('id')->on('orderables');
            $table->timestamps();
            $table->enum('status', ["Přijato", "V přípravě", "Připraveno", "Servírováno", "Sklizené"]);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_orderable');
    }
}
