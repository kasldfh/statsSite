<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
	
class SuperController extends Controller {

	public function __construct() {
    	$this->beforeFilter('super_auth');
	}

	public function create() {
		return View::make('admin.user.create');
	}

	public function manage() {
		$users = User::all();
		$other_users = CreateUser::all();
		return View::make('admin.user.manage', compact('users', 'other_users'));
	}

	public function store() {
		$email = Input::get('email');
		$name = Input::get('name');
		$user_create = new CreateUser;
		$user_create->email = $email;
		$user_create->name = $name;
		$user_create->admin = Input::get('super_admin') == 'yes';
		$token = md5(uniqid($email, true));
		$user_create->token = $token;
	
		Mail::send('emails.welcome', ['token' => $token, 'name' => $name], function($message) use ($email, $name)
		{
		    $message->to($email, $name)->subject('Welcome to the Team!');
		});	
		$user_create->save();
		return Redirect::action('AdminController@dashboard');
	}

	public function delete($id) {
		User::destroy($id);
		return Redirect::action('SuperController@manage');
	}

	public function deleteConfirm($id) {
		CreateUser::destroy($id);
		return Redirect::action('SuperController@manage');
	}
	
}
