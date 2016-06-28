<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataRegionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_regions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->comment('区域名');
            $table->bigInteger('parent_id')->comment('父区域ID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('data_regions');
    }
}
