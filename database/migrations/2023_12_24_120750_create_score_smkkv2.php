<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScoreSmkkv2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('score_smkkv2', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('package_id')->unsigned();
            $table->bigInteger('evaluator_id')->unsigned();
            $table->bigInteger('stage_sub_indicator_id')->unsigned();
            $table->smallInteger('score')->default(0);
            $table->string('score_text');
            $table->text('file')->nullable();
            $table->text('note_ppk');
            $table->text('note_balai');
            $table->timestamps();
            $table->foreign('package_id')->references('id')->on('package');
            $table->foreign('evaluator_id')->references('id')->on('users');
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
        Schema::dropIfExists('score_smkkv2');
    }
}
