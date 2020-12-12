<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMetricsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('metrics', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('metric');
            $table->boolean('active')->default(1);
            $table->timestamps();
        });

        Schema::table('summaries', function ($table) {
            $table->string('name');
            $table->string('color', 7);
            $table->string('metrics');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('metrics');

        Schema::table('summaries', function ($table) {
            $table->dropColumn('name');
            $table->dropColumn('color');
            $table->dropColumn('metrics');

        });
    }
}
