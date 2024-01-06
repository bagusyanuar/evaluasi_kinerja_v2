<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScoreSmkkv2Revisions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('score_smkkv2_revisions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('score_smkkv2_id')->unsigned();
            $table->bigInteger('package_id')->unsigned();
            $table->bigInteger('stage_sub_indicator_id')->unsigned();
            $table->string('name');
            $table->text('file')->nullable();
            $table->timestamps();
            $table->foreign('score_smkkv2_id')->references('id')->on('score_smkkv2');
            $table->foreign('package_id')->references('id')->on('package');
            $table->foreign('stage_sub_indicator_id')->references('id')->on('stage_sub_indicators');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('score_smkkv2_revisions');
    }
}
