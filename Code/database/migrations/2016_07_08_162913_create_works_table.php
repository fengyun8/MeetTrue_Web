<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('works', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->BigInteger('user_id')->commnet('作品所属用户');
            $table->string('title')->comment('作品集标题');
            $table->string('description')->default('')->comment('作品集描述');
            $table->smallInteger('visibility')->default(0)
                ->comment('是否可见：0:公开，1，关注我的人可见，2:仅自己可见');
            $table->smallInteger('cover_id')->default(0)->comment('作品集封面');
            $table->smallInteger('copyright_id')->default(0)->comment('署名方式');
            $table->bigInteger('star_count')->default(0)->comment('作品点赞次数');
            $table->bigInteger('comment_count')->default(0)->comment('作品评论次数');
            $table->bigInteger('view_count')->default(0)->comment('作品浏览次数');
            $table->smallInteger('badge')->default(0)->comment('作品是否带徽章：0，不带，1，带');
            $table->integer('competition_id')->default(0)->comment('大赛作品：1，参加，0，未参加');
            $table->integer('sort')->default(0)->comment('作品集排序：99999倒序');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('works');
    }
}
