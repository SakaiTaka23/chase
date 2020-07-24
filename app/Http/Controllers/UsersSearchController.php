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

        $users = $query->orderBy('updated_at', 'desc')->paginate(10);
        $count = $query->count();

        return view('users.index', compact('users', 'auth', 'count', 'id_name', 'place'));
    }
}
