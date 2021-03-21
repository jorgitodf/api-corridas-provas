<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRunnersRacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('runner_race', function (Blueprint $table) {
            $table->integer('runner_id')->unsigned();
            $table->foreign('runner_id')->references('id')->on('runners')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('racer_id')->unsigned();
            $table->foreign('racer_id')->references('id')->on('races')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('runners_races');
    }
}
