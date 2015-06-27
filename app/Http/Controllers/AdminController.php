<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mail;
use View;
class AdminController extends Controller {
	public function __construct() {
    	$this->beforeFilter('auth');
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function dashboard() {
		return View::make('admin.dashboard');
	}
	public function test() {
		Mail::send('emails.welcome', [], function($message)
		{
		    $message->to('mgladfelter@gmail.com', 'Matt Gladfelter')->subject('Welcome!');
		});
	}
	public function create(){
	}
	public function manage() {
		
	}
}
	
	
