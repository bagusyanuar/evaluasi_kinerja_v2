<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('score_history', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('package_id')->unsigned();
            $table->bigInteger('author_id')->unsigned();
            $table->bigInteger('sub_indicator_id')->unsigned();
            $table->enum('type', ['office', 'ppk', 'vendor']);
            $table->integer('score_before')->default(0);
            $table->string('text_before')->default('bad');
            $table->string('file_before')->nullable();
            $table->integer('score_after')->default(0);
            $table->string('text_after')->default('bad');
            $table->string('file_after')->nullable();
            $table->float('score_total_before')->default(0);
            $table->float('score_total_after')->default(0);
            $table->timestamps();
            $table->foreign('package_id')->references('id')->on('package');
            $table->foreign('author_id')->references('id')->on('users');
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
        Schema::dropIfExists('score_history');
    }
}
