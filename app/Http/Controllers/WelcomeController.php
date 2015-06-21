<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class WelcomeController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function index()
    {
        return "Hello World!";
        //return view('user.profile', ['user' => User::findOrFail($id)]);
    }
}
