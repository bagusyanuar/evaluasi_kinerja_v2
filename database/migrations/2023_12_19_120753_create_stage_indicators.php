<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStageIndicators extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stage_indicators', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('sub_stage_id')->unsigned();
            $table->text('name');
            $table->integer('index')->default(0);
            $table->timestamps();
            $table->foreign('sub_stage_id')->references('id')->on('sub_stages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stage_indicators');
    }
}
