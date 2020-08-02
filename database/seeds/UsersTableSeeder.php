<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $last = [
            '佐藤',
            '鈴木',
            '高橋',
            '田中',
            '伊藤',
            '渡辺',
            '山本',
            '中村',
            '小林',
            '加藤',
        ];

        $first = [
            '悠真',
            '悠人',
            '陽翔',
            '蓮',
            '湊',
            '凛',
            '陽葵',
            '結愛',
            '咲良',
            '紬',
        ];

        $place = [
            '学内',
            '研究室',
            '家',
            '外出',
            '長期不在',
        ];

        $data_want = 30;
        for ($i = 1; $i <= $data_want; $i++) {
            $rand_m = str_pad(rand(6, 7), 2, 0, STR_PAD_LEFT);
            $rand_d = str_pad(rand(1, 31), 2, 0, STR_PAD_LEFT);
            $rand_H = str_pad(rand(1, 23), 2, 0, STR_PAD_LEFT);
            $rand_i = str_pad(rand(0, 59), 2, 0, STR_PAD_LEFT);
            DB::table('users')->insert([
                'last_name' => Arr::random($last),
                'first_name' => Arr::random($first),
                'student_id' => Str::random(1) . rand(10, 20) . str_pad(rand(1, 110), 3, 0, STR_PAD_LEFT),
                'password' => Hash::make('password'),
                'place' => Arr::random($place),
                'created_at' => now(),
                'updated_at' => date('Y-' . $rand_m . '-' . $rand_d . ' ' . $rand_H . ':' . $rand_i . ':s'),
            ]);
        }
    }
}
