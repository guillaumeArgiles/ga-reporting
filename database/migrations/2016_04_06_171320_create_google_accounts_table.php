<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoogleAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('google_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('email');
            $table->string('account_name');
            $table->integer('account_id');
            $table->string('webProperty_id');
            $table->string('webProperty_name');
            $table->integer('internalWebProperty_id');
            $table->integer('profile_id');
            $table->string('profile_name');
            $table->string('profile_type');
            $table->string('access_token');
            $table->string('refresh_token');
            $table->integer('refresh_token_expire');
            $table->boolean('active')->default(1);
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
        Schema::drop('google_accounts');
    }
}
