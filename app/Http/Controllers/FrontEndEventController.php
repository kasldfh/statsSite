<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
	
class FrontEndEventController extends Controller {

	public function viewEvent($id) {
		return View::make('events.view');
	}


}
