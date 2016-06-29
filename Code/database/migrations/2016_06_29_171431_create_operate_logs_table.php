<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOperateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operate_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('operator_id')->default(0)->comment('操作人id');
            $table->bigInteger('user_id')->default(0)->comment('用户id');
            $table->smallInteger('type')->default(0)->comment('Operate Log类型: 0:未知;1:登陆;2:退出;');
            $table->string('ip')->comment('操作ip');
            $table->string('extra')->comment('扩展列, 存储json类型数据');
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
        Schema::drop('operate_logs');
    }
}
