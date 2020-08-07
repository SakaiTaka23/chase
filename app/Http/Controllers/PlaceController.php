<?php

namespace App\Http\Controllers;

use App\User;
use App\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class PlaceController extends Controller
{
    public function index()
    {
        $auth = Auth::user();
        //出力：キーワード、それらの総数 (大きい順でソート)
        $counts = [];
        $key = DB::table('places')->pluck('place');
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
        return view('chart', compact('keys', 'counts', 'auth'));
    }

    public function edit()
    {
        $auth = Auth::user();
        $places = Place::all();
        return view('edit.place', compact('auth', 'places'));
    }

    public function update(Request $request, $id)
    {
        $params = $request->validate([
            'place' => 'required|string|max:10',
        ]);

        $auth = User::find($id);
        $auth->fill($params)->update();

        return redirect('index')->with('message', '場所を更新しました！');
    }
}
