<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class UsersSearchController extends Controller
{
    public function index(Request $request)
    {
        $auth = Auth::user();

        $query = User::query();
        $id_name = $request->input('id_name');
        $place = $request->input('place');
        if (isset($id_name)) {
            $query->where('last_name', 'like', '%' . $id_name . '%')
                ->orWhere('first_name', 'like', '%' . $id_name . '%')
                ->orWhere('student_id', 'like', '%' . $id_name . '%');
        }
        if (isset($place)) {
            $query->where('place', 'like', '%' . $place . '%');
        }

        $users = $query->orderBy('updated_at', 'desc')->get();

        //dd($query->toSql(), $query->getBindings(), $users);

        return view('users.index', compact('users', 'auth'));
    }
}
