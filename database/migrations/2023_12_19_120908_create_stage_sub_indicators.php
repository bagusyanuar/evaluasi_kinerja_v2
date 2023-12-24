<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStageSubIndicators extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stage_sub_indicators', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('stage_indicator_id')->unsigned();
            $table->text('name');
            $table->integer('index')->default(0);
            $table->timestamps();
            $table->foreign('stage_indicator_id')->references('id')->on('stage_indicators');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stage_sub_indicators');
    }
}
