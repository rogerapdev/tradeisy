<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('broker_id')->unsigned();
            $table->string('stock_ticker');
            $table->integer('quantity');
            $table->decimal('average_price', 15, 2);
            $table->decimal('invested', 15, 2);
            $table->decimal('stop_loss', 15, 2);
            $table->decimal('stop_gain', 15, 2);
            $table->decimal('rate', 15, 2);
            $table->decimal('expense', 15, 2);
            $table->decimal('equilibrium_price', 15, 2);

            $table->integer('user_id')->unsigned();
            $table->timestamps();

            $table->foreign('broker_id')->references('id')->on('brokers');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stocks');
    }
}
