<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataDictsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_dicts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('dd_type', 50)->comment('数据字典类型');
            $table->integer('dd_code')->comment('数据字典码');
            $table->string('dd_value', 200)->comment('数据字典值');
            $table->string('dd_desc', 200)->nullable()->comment('数据字典描述');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('data_dicts');
    }
}
