<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SubIndicator extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_indicator', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('indicator_id')->unsigned();
            $table->timestamps();
            $table->foreign('indicator_id')->references('id')->on('indicator');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_indicator');
    }
}
