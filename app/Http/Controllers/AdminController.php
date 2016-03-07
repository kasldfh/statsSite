<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Mail;
use View;
class AdminController extends Controller {
	public function __construct() {
        $this->middleware('auth');
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function dashboard() {
		return View::make('admin.dashboard');
	}
}
