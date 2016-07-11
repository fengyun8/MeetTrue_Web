<?php

use Illuminate\Database\Seeder;

class MajorTableSeeder extends Seeder
{
   /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('majors')->truncate();
        $this->command->info('清空majors中的数据');

        $this->command->info('开始添加majors字典数据');
        DB::table('majors')->insert([
            'name' => '平面设计'
        ]);

        DB::table('majors')->insert([
            'name' => 'UI设计'
        ]);

        DB::table('majors')->insert([
            'name' => '摄影影视'
        ]);

        DB::table('majors')->insert([
            'name' => '游戏动画'
        ]);

        DB::table('majors')->insert([
            'name' => '工业产品'
        ]);

        DB::table('majors')->insert([
            'name' => '服装时尚'
        ]);

        DB::table('majors')->insert([
            'name' => '建筑景观'
        ]);

        DB::table('majors')->insert([
            'name' => '纯艺术'
        ]);  

        DB::table('majors')->insert([
            'name' => '插画漫画'
        ]);  

        $this->command->info('major字典表数据添加成功');
    }
}
