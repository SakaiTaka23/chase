<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

use App\User;
use App\Place;
use App\Admin;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::orderBy('updated_at', 'desc')->paginate(10);
        $count = User::count();
        return view('admin.index', compact('users', 'count'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        $places = Place::all();
        return view('edit.adminedit', compact('user', 'places'));
    }

    public function update(Request $request, $id)
    {
        $params = $request->validate([
            'last_name' => 'required|string|max:10',
            'first_name' => 'required|string|max:10',
            'student_id' => 'required|string|max:6|regex:/^[a-z]\d{5}$/',
            'password' => 'required|string|min:5|max:10|confirmed',
            'place' => 'required|string|max:10',
        ]);
        $params['password'] = Hash::make($params['password']);

        $user = User::find($id);
        $user->fill($params)->update();

        return redirect('/admin/index')->with('message', '登録情報を更新しました！');
    }

    public function appoint($id)
    {
        $user = User::find($id);
        $exists = DB::table('admins')->where('student_id', $user->student_id)->exists();
        if ($exists) {
            return redirect('/admin/index')->with('message', 'このユーザーは既に任命済みです！');
        }
        Admin::create([
            'student_id' => $user->student_id,
            'password' => $user->password,
        ]);

        return redirect('/admin/index')->with('message', 'ユーザーを任命しました!');
    }

    public function destroy($id)
    {
        User::destroy($id);

        return redirect('/admin/index')->with('message', '退会させました!');
    }

    public function search(Request $request)
    {
        // dd($request);
        $query = User::query();
        $id_name = $request->input('id_name');
        $place = $request->input('place');

        if (isset($id_name) && isset($place)) {
            $query->where('place', 'like', '%' . $place . '%')
                ->where('last_name', 'like', "%{$id_name}%")
                ->orwhere('first_name', 'like', "%{$id_name}%")
                ->orwhere('student_id', 'like', "%{$id_name}%");
        } else {
            if (isset($id_name)) {
                $query->where('last_name', 'like', "%{$id_name}%")
                    ->orwhere('first_name', 'like', "%{$id_name}%")
                    ->orwhere('student_id', 'like', "%{$id_name}%");
            }
            if (isset($place)) {
                $query->where('place', 'like', '%' . $place . '%');
            }
        }

        //dd($query->toSql(), $query->getBindings());

        $count = $query->count();
        $users = $query->orderBy('updated_at', 'desc')->paginate(10);

        return view('admin.index', compact('users', 'count', 'id_name', 'place'));
    }

    public function percent()
    {
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
        return view('admin.chart', compact('keys', 'counts'));
    }
}
