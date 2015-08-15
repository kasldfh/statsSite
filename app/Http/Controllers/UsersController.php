<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\CreateUser;
use App\Models\User;

use Hash;
use Session;
use Auth;
use View;
use Redirect;
use Input;
class UsersController extends Controller {
	public function __construct() {
    	$this->beforeFilter('csrf', array('on'=>'attempt'));
    	$this->beforeFilter('logged', array('on'=>'login'));
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function login() {
		if(Auth::check()) {
			return Redirect::action('AdminController@dashboard');
		}
		return View::make('users.login');
	}

	public function attempt() {
		if (Auth::attempt(Input::only('email', 'password'))) {
			return Redirect::to('admin/dashboard')->with('message', 'You are now logged in!');
		} else {
			Session::put('message', 'Your email/password combination was incorrect');
			return Redirect::to('users/login')->withInput();
		}
	}


	public function logout(){
		Auth::logout();
		return Redirect::action('UsersController@login');
	}
	public function create($token){
		if(count(CreateUser::where('token', $token)->get())) {
			$user = CreateUser::where('token', $token)->first();
			return View::make('users.register', compact('user'));
		} 
		App::abort(404);
	}

	public function store() {
		$user_create = CreateUser::where('token', Input::get('token'))->first();
		$user = new User;
		$user->name = Input::get('name');
		$user->email = Input::get('email');
		$user->admin = $user_create->admin;
		$user->password = Hash::make(Input::get('password'));
		$user->save();
		$user_create->delete();
		return Redirect::action('UsersController@login');

	}

}
