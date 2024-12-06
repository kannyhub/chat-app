<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\User;
use App\Traits\DatabaseOperationsTrait;

class UserController extends Controller
{
    use DatabaseOperationsTrait;

    public function index(User $user) {
        $users = $this->getRecords($user);
        return view('user.index',compact('users'));
    }
}
