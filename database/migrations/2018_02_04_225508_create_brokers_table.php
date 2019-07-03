<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrokersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brokers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->decimal('brokerage', 15, 2)->default(0.00);
            $table->decimal('emolument_normal', 15, 4);
            $table->decimal('emolument_daytrade', 15, 4);
            $table->decimal('percentage_stop_loss', 15, 2);
            $table->decimal('percentage_stop_gain', 15, 2);
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
        Schema::dropIfExists('brokers');
    }
}
