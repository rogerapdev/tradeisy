<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateSellPerMonthView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE VIEW sell_per_month as
                SELECT YEAR(date) as year, MONTH(date) as month, SUM(cost) as total
                FROM orders
                WHERE type = 'V'
                GROUP BY MONTH(date), YEAR(date)
                ORDER BY 1, 2");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW sell_per_month');
    }
}
