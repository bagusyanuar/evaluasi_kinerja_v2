<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddValueSubIndicator extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sub_indicator', function (Blueprint $table) {
            //
            $table->float('bad')->default(0);
            $table->float('medium')->default(0);
            $table->float('good')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sub_indicator', function (Blueprint $table) {
            //
            $table->dropColumn('bad');
            $table->dropColumn('medium');
            $table->dropColumn('good');
        });
    }
}
