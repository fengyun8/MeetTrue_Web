<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->comment('标签名');
            $table->smallInteger('source')->default(0)->comment('标签来源: 1,系统;2,用户自定义');
            $table->smallInteger('type')->default(0)->comment('标签种类: 1,作品;2,用户');
            $table->timestamps();

            // name 和 type唯一
            $table->unique(['name', 'type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tags');
    }
}
