<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Redis;
use Auth;

class BaseController extends Controller {

    public function getCachedView($key)
    {
        if(Auth::guest())
            return Redis::get($key);
    }

    public function cacheView($key, $value)
    {
        if(Auth::guest())
            Redis::set($key, $value);
    }
}
