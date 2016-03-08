<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Jobs\RefreshCache;

use App\Models\Event;
use App\Models\Team;
use App\Models\CacheItem;

use Redis;
use Auth;
use View;

class BaseController extends Controller {

    public function refresh_cache($event_id) {
        $this->dispatch(new RefreshCache($event_id));
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
            //return Redis::get($key);
        $item = CacheItem::where('name', $key)->first();
        if(isset($item)) {
            return json_decode($item->value);
        }
        else {
            return null;
        }
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
        //self::cacheRemove(["stat*", "player*"]);
    }
}
