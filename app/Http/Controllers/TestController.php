<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use View;
use App\Models\Event;

class TestController extends Controller {
    public function test() {
        $event = Event::find(1);
        return View::make('frontend.index', compact('event'));
    } 
}
