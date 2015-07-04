<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTypeIdToSnippetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('snippets', function (Blueprint $table) {
            $table->bigInteger('type_id')->unsigned()->nullable();
            $table->foreign('type_id')->references('id')->on('snippet_types')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('snippets', function (Blueprint $table) {
            $table->dropForeign('snippets_type_id_foreign');
            $table->dropColumn('type_id');
        });
    }
}
