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
    }
}
