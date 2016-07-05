<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataDictTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('data_dicts')->truncate();
        $this->command->info('清空data_dicts中的数据');

        $this->command->info('开始添加性别字典数据');
        DB::table('data_dicts')->insert([
            'dd_type' => 'gender',
            'dd_code' => 0,
            'dd_value' => '女',
            'dd_desc' => '性别',
        ]);

        DB::table('data_dicts')->insert([
            'dd_type' => 'gender',
            'dd_code' => 1,
            'dd_value' => '男',
            'dd_desc' => '性别',
        ]);

        DB::table('data_dicts')->insert([
            'dd_type' => 'gender',
            'dd_code' => 2,
            'dd_value' => '保密',
            'dd_desc' => '性别',
        ]);

        $this->command->info('性别字典数据添加成功');

        $this->command->info('开始添加专业字典数据');
        DB::table('data_dicts')->insert([
            'dd_type' => 'major',
            'dd_code' => 1,
            'dd_value' => '平面设计',
            'dd_desc' => '专业',
        ]);

        DB::table('data_dicts')->insert([
            'dd_type' => 'major',
            'dd_code' => 2,
            'dd_value' => 'UI设计',
            'dd_desc' => '专业',
        ]);

        DB::table('data_dicts')->insert([
            'dd_type' => 'major',
            'dd_code' => 3,
            'dd_value' => '摄影影视',
            'dd_desc' => '专业',
        ]);

        DB::table('data_dicts')->insert([
            'dd_type' => 'major',
            'dd_code' => 4,
            'dd_value' => '游戏动漫',
            'dd_desc' => '专业',
        ]);

        DB::table('data_dicts')->insert([
            'dd_type' => 'major',
            'dd_code' => 5,
            'dd_value' => '工业产品',
            'dd_desc' => '专业',
        ]);

        DB::table('data_dicts')->insert([
            'dd_type' => 'major',
            'dd_code' => 6,
            'dd_value' => '服装时尚',
            'dd_desc' => '专业',
        ]);

        DB::table('data_dicts')->insert([
            'dd_type' => 'major',
            'dd_code' => 7,
            'dd_value' => '建筑景观',
            'dd_desc' => '专业',
        ]);

        DB::table('data_dicts')->insert([
            'dd_type' => 'major',
            'dd_code' => 8,
            'dd_value' => '纯艺术',
            'dd_desc' => '专业',
        ]);  

        $this->command->info('专业字典表数据添加成功');
    }
}
