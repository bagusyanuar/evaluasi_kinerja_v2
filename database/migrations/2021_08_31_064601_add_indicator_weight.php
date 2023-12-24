<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndicatorWeight extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('indicator', function (Blueprint $table) {
            $table->float('weight')->default(0);
        });

        Schema::table('score', function (Blueprint $table) {
            $table->string('file')->after('type')->nullable();
            $table->bigInteger('author_id')->after('file')->unsigned();
            $table->foreign('author_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('indicator', function (Blueprint $table) {
            $table->dropColumn('weight');
        });

        Schema::table('score', function (Blueprint $table) {
            $table->dropColumn('file');
            $table->dropForeign('score_author_id_foreign');
            $table->dropColumn('author_id');
        });
    }
}
