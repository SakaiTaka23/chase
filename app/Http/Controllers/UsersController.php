<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Place;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::orderBy('updated_at', 'desc')->paginate(10);
        $auth = Auth::user();
        $count = User::count();

        return view('users.index', compact('users', 'auth', 'count'));
    }

    public function edit()
    {
        $auth = Auth::user();
        $places = Place::all();
        return view('edit.all', compact('auth', 'places'));
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

        $auth = User::find($id);
        $auth->fill($params)->update();

        return redirect('index')->with('message', '登録内容を変更しました！');
    }

    public function destroy($id)
    {
        User::destroy($id);

        $message = '退会しました';

        return view('welcome', compact('message'));
    }
}
