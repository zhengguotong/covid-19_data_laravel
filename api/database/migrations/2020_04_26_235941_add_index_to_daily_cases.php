<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexToDailyCases extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('daily_cases', function (Blueprint $table) {
            $table->index(['report_date', 'region', 'province','admin2']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('daily_cases', function (Blueprint $table) {
            $table->dropIndex(['report_date', 'region', 'province','admin2']);
        });
    }
}
