<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScore extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('score', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('package_id')->unsigned();
            $table->bigInteger('evaluator_id')->unsigned();
            $table->bigInteger('sub_indicator_id')->unsigned();
            $table->float('score')->default(0);
            $table->string('text')->default('bad');
            $table->timestamps();
            $table->foreign('package_id')->references('id')->on('package');
            $table->foreign('evaluator_id')->references('id')->on('users');
            $table->foreign('sub_indicator_id')->references('id')->on('sub_indicator');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('score');
    }
}
