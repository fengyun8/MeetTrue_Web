<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nickname')->comment('用户昵称');
            $table->string('last_name')->nullable()->comment('姓');
            $table->string('first_name')->nullable()->comment('名');
            $table->string('email')->unique()->nullable()->comment('邮箱');
            $table->string('phone')->unique()->nullable()->comment('手机号');
            $table->string('password', 60)->comment('密码');
            $table->string('avatar')->default('')->comment('用户头像');
            $table->smallInteger('gender')->default(2)->comment('性别：0-女,1-男,2-保密');
            $table->bigInteger('province_id')->default(0)->comment('省,对应data_regions.id');
            $table->bigInteger('city_id')->default(0)->comment('市');
            $table->Integer('major_id')->default(0)->comment('专业,对应data_dicts.type=major对应code字段');
            $table->bigInteger('school_id')->default(0)->comment('毕业学校，对应data_schools.id');
            $table->string('identify_info')->default(0)->comment('认证信息-json格式');
            $table->smallInteger('group')->default(0)->comment('用户身份');
            $table->rememberToken();
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
        Schema::drop('users');
    }
}
