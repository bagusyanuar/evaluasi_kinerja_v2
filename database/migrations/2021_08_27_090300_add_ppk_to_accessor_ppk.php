<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPpkToAccessorPpk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accessor_ppk', function (Blueprint $table) {
            $table->bigInteger('ppk_id')->unsigned();
            $table->foreign('ppk_id')->references('id')->on('ppk');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('accessor_ppk', function (Blueprint $table) {
            //
        });
    }
}
