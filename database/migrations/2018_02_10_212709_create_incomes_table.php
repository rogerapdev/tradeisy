<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incomes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('month');
            $table->integer('year');
            $table->decimal('deposit', 15, 2);
            $table->decimal('start', 15, 2);
            $table->decimal('finish', 15, 2);
            $table->decimal('yield', 15, 2);
            $table->decimal('gain', 15, 2);
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
        Schema::dropIfExists('incomes');
    }
}
