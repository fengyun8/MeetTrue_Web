<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGalleriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('galleries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->index()->comment('作者id');
            $table->string('title')->comment('作品集名称');
            $table->text('description')->comment('作品集描述');
            $table->smallInteger('visibility')->default(0)->comment('是否可见: 0,所有人可见;1,仅关注我的人可见;2,仅我自己可见');
            $table->bigInteger('cover_id')->default(0)->comment('封面图片id');
            $table->integer('competition_id')->default(0)->comment('比赛id');
            $table->smallInteger('type_id')->default(0)->comment('作品分类(data_dict表)');
            $table->smallInteger('cp_version_id')->default(0)->comment('作品版权说明(data_dict表)');
            $table->smallInteger('sort')->default(0)->comment('作品排序(置顶用 9999递减)');
            $table->integer('star_count')->default(0)->comment('点赞数量');
            $table->integer('comment_count')->default(0)->comment('评论数量');
            $table->integer('forward_count')->default(0)->comment('转发数量');
            $table->integer('view_count')->default(0)->comment('浏览数量');

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
        Schema::drop('galleries');
    }
}
