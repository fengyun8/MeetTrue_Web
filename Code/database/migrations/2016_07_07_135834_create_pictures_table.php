<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePicturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pictures', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('path')->comment('图像地址');
            $table->text('description')->comment('描述');
            $table->morphs('imageable'); //关联内容id和类型
            $table->smallInteger('sort')->default(0)->comment('显示顺序');
            $table->timestamps();
            $table->softDeletes()->comment('软删除字段');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pictures');
    }
}
