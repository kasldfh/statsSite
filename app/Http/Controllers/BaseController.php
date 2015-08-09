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

    public function getCached($key)
    {
        if(Auth::guest())
            return Redis::get($key);
    }

    public function cache($key, $value)
    {
        if(Auth::guest())
            Redis::set($key, $value);
    }

    //remove keys by prefix, can be array or str
    //make sure to use double quotes for inputs
    public function cacheRemove($input)
    {
        //if there's just one thing
        if(!is_array($input))
            $input = [$input];

        foreach($input as $str)
        {
            $keys = Redis::keys($str);
            foreach($keys as $key)
            { 
                Redis::del($key);
            }
        }
        dd($input);
    }
}
