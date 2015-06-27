<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use View;
	
class FrontEndEventController extends Controller {

	public function viewEvent($id) {
        dd('made it here');
		return View::make('events.view');
	}


}
