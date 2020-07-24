<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class PlaceController extends Controller
{
    public function index()
    {
        //出力：キーワード、それらの総数 (大きい順でソート)
        $counts = [];
        $key = DB::table('place')->pluck('place');
        $keys = [];
        foreach ($key as $k) {
            array_push($keys, $k);
        }

        foreach ($keys as $key) {
            $count = DB::table('users')
                ->where('place', 'like', "%{$key}%")
                ->count();
            array_push($counts, $count);
        }

        $sum = array_sum($counts);
        $all_sum = DB::table('users')->count();
        $others = $all_sum - $sum;
        array_push($counts, $others);
        array_push($keys, 'その他');

        $sort = array_combine($keys, $counts);
        arsort($sort);
        [$keys, $counts] = Arr::divide($sort);
        return view('test');
    }
}
