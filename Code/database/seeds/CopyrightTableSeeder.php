<?php

use Illuminate\Database\Seeder;

class CopyrightTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('copyrights')->truncate();
        $this->command->info('清空copyrights中的数据');

        $this->command->info('开始添加copyrights字典数据');
        DB::table('copyrights')->insert([
            'name' => '不使用原创授权'
        ]);

        DB::table('copyrights')->insert([
            'name' => '署名－非商业性使用－禁止演绎'
        ]);

        DB::table('copyrights')->insert([
            'name' => '署名－非商业性使用－相同方式共享'
        ]);

        DB::table('copyrights')->insert([
            'name' => '署名－非商业性使用'
        ]);

        DB::table('copyrights')->insert([
            'name' => '署名－禁止演绎'
        ]);

        DB::table('copyrights')->insert([
            'name' => '署名－相同方式共享'
        ]);

        DB::table('copyrights')->insert([
            'name' => '署名'
        ]);
        
        $this->command->info('copyrights字典表数据添加成功');    }
}
