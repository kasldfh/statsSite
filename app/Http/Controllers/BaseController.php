<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Event;
use App\Models\Team;

use Redis;
use Auth;
use View;

class BaseController extends Controller {
    /* Cache key conventions 
     * player:{id}              -- player model, json encoded
     * player:all               -- player model all, json encoded
     * event:all                -- all events, json encoded
     * rosplay:all              -- roster with playermap, json encoded

     * stat:{stat}:{all}:{all}      -- all events, all player kd's, sorted desc, json encoded
     * stat:{stat}:{all}:{playerid} --      player kd, for all events
     * stat:{stat}:{eventid}:{playerid} -- player kd at event
     *
     */

    public function __construct()
    {
    }

    public static function getCachedView($key) {
        if(Auth::guest())
            return Redis::get($key);
    }

    public static function cacheView($key, $value) {
        if(Auth::guest())
            Redis::set($key, $value);
    }

    public static function cacheGet($key) {
            return Redis::get($key);
    }

    public static function cacheSet($key, $value) {
            Redis::set($key, $value);
    }

    public static function cacheRequest($key, $closure, $json = false) {
        $cached = self::cacheGet($key);
        if($cached)
            return $json ? json_decode($cached) : $cached;
        $cached = $json ? json_encode($closure()) : $closure();
        self::cacheSet($key, $cached);
        return $json ? json_decode($cached) : $cached;
    }

    //remove keys by prefix, can be array or str
    //make sure to use double quotes for inputs
    public static function cacheRemove($input)
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
    public static function cacheClearCommon()
    {
        self::cacheRemove(["stat*", "player*"]);
    }
}
