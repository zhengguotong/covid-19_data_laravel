<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdminFieldToReportedCases extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reported_cases', function (Blueprint $table) {
            $table->string('admin2')->after('id');
            $table->integer('active')->after('recovered');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reported_cases', function (Blueprint $table) {
            $table->dropColumn('admin2');
            $table->dropColumn('active');
        });
    }
}
