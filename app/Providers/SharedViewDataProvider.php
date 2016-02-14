<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Http\Controllers\BaseController;

use App\Models\Event;
use App\Models\Team;

use View;
use Schema;

class SharedViewDataProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //this fixes php artisan complaining when this tries to use tables
        //that dont exist
        //if(Schema::hasTable('event') && Schema::hasTable('team')) {
        //    //get list of all events
        //    $events = BaseController::cacheRequest('event:all', function () {
        //        return Event::all();
        //    }, true);

        //    $teams = BaseController::cacheRequest('team:all', function () {
        //        return Team::all();
        //    }, true);
            $events = [];
            $teams = [];
            View::share('events', $events);
            View::share('teams', $teams);
        //}
        
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
