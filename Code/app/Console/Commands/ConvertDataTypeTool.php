<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ConvertDataTypeTool extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'convert:dataType';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '转换数据类型(生成JSON)';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $flag = true;

        do {
            $which = $this->ask('which( region )');
            switch ($which)
            {
                case 'region':
                    $this->covertRegion();
                    $flag = false;
                    break;
                default:
                    $this->error('请输入提示的字符!');
            }
        } while ($flag);
    }

    /**
     * Convert Region Data
     */
    private function covertRegion()
    {
        $returnArr = [];

        // Get Provinces
        $arr = \App\DataRegion::where('parent_id', '=', '0')->get();

        // Convert data type
        foreach ($arr as $value) {
            $tmp = [];
            $tmp['name'] = $value['id'];
            $tmp['value'] = $value['name'];

            // Get cities
            $cities = \App\DataRegion::where('parent_id', '=', $value['id'])->get();
            foreach ($cities as $valSecond) {
                $tmp2 = [];
                $tmp2['name'] = $valSecond['id'];
                $tmp2['value'] = $valSecond['name'];
                $tmp['cities'][] = $tmp2;
            }

            $returnArr [] = $tmp;
        }

        $t = json_encode($returnArr, JSON_UNESCAPED_UNICODE);
        dd($t);
    }
}
