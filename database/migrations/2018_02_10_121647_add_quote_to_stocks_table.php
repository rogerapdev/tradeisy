<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQuoteToStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stocks', function (Blueprint $table) {
            $table->decimal('quote', 15, 2)->default(0.00)->after('equilibrium_price');
            $table->decimal('yield', 15, 2)->default(0.00)->after('quote');
            $table->decimal('gain', 15, 2)->default(0.00)->after('yield');
            $table->decimal('current_cost', 15, 2)->default(0.00)->after('gain');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stocks', function (Blueprint $table) {
            $table->dropColumn('quote');
            $table->dropColumn('yield');
            $table->dropColumn('gain');
            $table->dropColumn('current_cost');
        });
    }
}
