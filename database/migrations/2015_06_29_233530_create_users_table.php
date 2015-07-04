<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('is_admin')->default(false);
            $table->boolean('verified')->default(false); // Email verified?
            $table->string('name');
            $table->string('username')->index();
            $table->string('email')->nullable()->index();
            $table->string('password', 60)->nullable();
            $table->string('github_token')->nullable()->unique();
            $table->string('website')->nullable();
            $table->string('github_username')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
