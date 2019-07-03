<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInvestedAndAvailableToBrokersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('brokers', function (Blueprint $table) {
            $table->decimal('available', 15, 2)->default(0.00)->after('percentage_stop_gain');
            $table->decimal('invested', 15, 2)->default(0.00)->after('percentage_stop_gain');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('brokers', function (Blueprint $table) {
            $table->dropColumn('available');
            $table->dropColumn('invested');
        });
    }
}
