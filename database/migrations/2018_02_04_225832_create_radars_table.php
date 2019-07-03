<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRadarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('radars', function (Blueprint $table) {
            $table->increments('id');
            $table->string('stock_ticker');
            $table->decimal('last_quote', 15, 2);
            $table->decimal('desired_price', 15, 2);
            $table->decimal('target_price', 15, 2);
            $table->decimal('percentage_missing', 15, 2);
            $table->decimal('percentage_gain', 15, 2);
            $table->integer('user_id')->unsigned();
            $table->timestamps();

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
        Schema::dropIfExists('radars');
    }
}
