<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailyCasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_cases', function (Blueprint $table) {
            $table->id();
            $table->string('province');
            $table->string('state');
            $table->string('region');
            $table->dateTime('last_update');
            $table->integer('confirmed');
            $table->integer('deaths');
            $table->integer('recovered');
            $table->softDeletes();
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
        Schema::dropIfExists('daily_cases');
    }
}
