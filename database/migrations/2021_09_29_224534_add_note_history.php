<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNoteHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('score_history', function (Blueprint $table) {
            $table->text('note_after')->nullable()->after('file_after');
            $table->text('note_before')->nullable()->after('file_before');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('score_history', function (Blueprint $table) {
            $table->dropColumn('note_after');
            $table->dropColumn('note_befor');
        });
    }
}
