<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKualifikasiDll extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vendor', function (Blueprint $table) {
            $table->string('phone')->after('name')->nullable();
            $table->string('kualifikasi')->after('phone')->nullable();
            $table->string('npwp')->after('kualifikasi')->nullable();
            $table->string('iujk')->after('npwp')->nullable();
            $table->string('address')->after('iujk')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vendor', function (Blueprint $table) {
            $table->dropColumn('phone');
            $table->dropColumn('kualifikasi');
            $table->dropColumn('npwp');
            $table->dropColumn('iujk');
            $table->dropColumn('address');
        });
    }
}
