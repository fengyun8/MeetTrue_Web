<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * users表的数据的生成
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'nickname' => 'kuker',
            'last_name' => '周',
            'first_name' => '继平',
            'phone' => '13666643039',
            'email' => 'zhoujiping@zhoujiping.com',
            'password' => bcrypt('123456'),
        ]);

        User::create([
            'nickname' => 'Ming',
            'last_name' => '王',
            'first_name' => '明',
            'phone' => '13666666666',
            'email' => 'ming@gmail.com',
            'password' => bcrypt('123456'),
        ]);

        User::create([
            'nickname' => 'leenty',
            'last_name' => '刘',
            'first_name' => '恩',
            'phone' => '18658888888',
            'email' => 'leenty@gmail.com',
            'password' => bcrypt('123456'),
        ]);

        User::create([
            'nickname' => 'zhanyu',
            'last_name' => '龙',
            'first_name' => '占宇',
            'phone' => '13777777777',
            'email' => 'zhanyu@gmail.com',
            'password' => bcrypt('123456'),
        ]);

        $this->command->info('users表用户信息数据成功生成');
    }
}
