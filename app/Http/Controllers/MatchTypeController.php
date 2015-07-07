<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\MatchType;
use View;
class MatchTypeController extends Controller {
	public function __construct() {
    	$this->beforeFilter('auth');
	}

	public function create() {
		return View::make('admin.match_type.create');
	}

	public function store() {
		$match_type = new MatchType;
		$match_type->name = Input::get('match_type');
		$match_type->save();
		return Redirect::action('AdminController@dashboard');
	}

	public function manage() {
		$match_types = MatchType::all();
		return View::make('admin.match_type.manage', compact('match_types'));
	}

	public function delete($id) {
		MatchType::destroy($id);
		return Redirect::action('MatchTypeController@manage');
	}
}

	
