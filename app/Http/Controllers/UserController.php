<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\User;

class UserController extends Controller
{
    public function index() {
        $user = new User;
        $users = $user->getUsers();
        return view('user.index',compact('users'));
    }
}
