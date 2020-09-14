<?php

use Illuminate\Database\Seeder;

class FiscalYearsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fiscal_years')->truncate();
        $rows = [
            [
                'fy_name'=>'2017',
                'fy_start_date' => '2017-1-1',
                'fy_end_date' => '2017-12-30',
               

            ],
            [
                'fy_name'=>'2018',
                'fy_start_date' => '2018-1-1',
                'fy_end_date' => '2018-12-30',
               

            ],

            [
                'fy_name'=>'2019',
                'fy_start_date' => '2019-1-1',
                'fy_end_date' => '2019-12-30',
               

            ],
            [
                'fy_name'=>'2020',
                'fy_start_date' => '2020-1-1',
                'fy_end_date' => '2020-12-30',
               

            ],
            [
                'fy_name'=>'2021',
                'fy_start_date' => '2021-1-1',
                'fy_end_date' => '2021-12-30',
               

            ],



        ];
        DB::table('fiscal_years')->insert($rows);
    }
}
