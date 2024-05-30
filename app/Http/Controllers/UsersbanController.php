<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersbanController extends Controller
{
    public function index()
    {
            $users = User::all();
            return view('admin.Users', ['users' => $users]);
    }
}
