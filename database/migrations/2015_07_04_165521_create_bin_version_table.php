<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBinVersionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bin_version', function (Blueprint $table) {
            $table->bigInteger('bin_id')->unsigned();
            $table->foreign('bin_id')->references('id')->on('bins')->onUpdate('cascade')->onDelete('cascade');
            $table->bigInteger('version_id')->unsigned();
            $table->foreign('version_id')->references('id')->on('versions')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('bin_version');
    }
}
