<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Redis;
use Auth;

class BaseController extends Controller {
    /* Cache key conventions 
     * player:{id}              -- player model, json encoded
     * player:all               -- player model all, json encoded

     * stat:{stat}:{all}:{all}      -- all events, all player kd's, sorted desc, json encoded
     * stat:{stat}:{all}:{playerid} --      player kd, for all events
     * stat:{stat}:{eventid}:{playerid} -- player kd at event
     */

    public function getCachedView($key) {
        if(Auth::guest())
            return Redis::get($key);
    }

    public function cacheView($key, $value) {
        if(Auth::guest())
            Redis::set($key, $value);
    }

    public function cacheGet($key) {
            return Redis::get($key);
    }

    public function cacheSet($key, $value) {
            Redis::set($key, $value);
    }

    public function cacheRequest($key, $closure, $json = false) {
        $cached = $this->cacheGet($key);
        if($cached)
            return $json ? json_decode($cached) : $cached;
        $cached = $json ? json_encode($closure()) : $closure();
        $this->cacheSet($key, $cached);
        return $json ? json_decode($cached) : $cached;
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
    }

    //not sure if this will be used 
    public function cacheClearCommon()
    {
        $this->cacheRemove(["stat*", "player*"]);
    }
}
