<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

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
        //dd($keys, $counts);
        return view('chart', compact('keys', 'counts'));
    }

    public function edit()
    {
        $auth = Auth::user();
        return view('edit.place', compact('auth'));
    }

    public function update(Request $request, $id)
    {
        $params = $request->validate([
            'place' => 'required|string|max:10',
        ]);

        $auth = User::find($id);
        $auth->fill($params)->update();

        $message = '場所を更新しました！';

        return view('message', compact('message'));
    }
}
