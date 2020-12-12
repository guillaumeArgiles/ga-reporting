<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSummariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('summaries', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->integer('channel_id')->unsigned();
            $table->foreign('channel_id')->references('id')->on('channels');

            $table->integer('google_account_id')->unsigned();
            $table->foreign('google_account_id')->references('id')->on('google_accounts');

            $table->string('datas');
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
        Schema::drop('summaries');
    }
}
