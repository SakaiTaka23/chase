<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlaceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $place = [
            '学内',
            '研究室',
            '家',
            '外出',
            '長期不在',
        ];

        foreach ($place as $p) {
            DB::table('place')->insert([
                'place' => $p,
            ]);
        }
    }
}
