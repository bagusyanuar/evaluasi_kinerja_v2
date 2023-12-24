<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVendorPackage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('package', function (Blueprint $table) {
            //
            $table->bigInteger('vendor_id')->unsigned()->after('name');
            $table->bigInteger('ppk_id')->unsigned()->after('vendor_id');
            $table->foreign('vendor_id')->references('id')->on('users');
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
        Schema::table('package', function (Blueprint $table) {
            //
        });
    }
}
