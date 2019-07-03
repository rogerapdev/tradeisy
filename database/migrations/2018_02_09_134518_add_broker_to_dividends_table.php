<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBrokerToDividendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dividends', function (Blueprint $table) {
            $table->integer('broker_id')->after('id')->nullable()->unsigned();

            $table->foreign('broker_id')->references('id')->on('brokers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dividends', function (Blueprint $table) {
            $table->dropForeign('dividends_broker_id_foreign');
            $table->dropColumn('broker_id');
        });
    }
}
