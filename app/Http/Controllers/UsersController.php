<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
class UsersController extends Controller
{
    //
    public function index()
    {
        $users = User::all();
        //return $users;
        return view('users.index')->with('users', $users);
    }
}
