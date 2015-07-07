<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTweetedToBinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bins', function (Blueprint $table) {
            $table->boolean('tweeted')->default(0);
        });

        DB::table('bins')->where('visibility', 1)->update(['tweeted' => 1]); // where has to come first
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bins', function (Blueprint $table) {
            $table->dropColumn('tweeted');
        });
    }
}
