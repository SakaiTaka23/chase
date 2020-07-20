<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::orderBy('updated_at', 'desc')->get();
        $auth = Auth::user();

        return view('users.index', compact('users', 'auth'));
    }

    public function edit()
    {
        $auth = Auth::user();
        return view('editinfo', compact('auth'));
    }

    public function update()
    {
        return view('test');
    }
}
