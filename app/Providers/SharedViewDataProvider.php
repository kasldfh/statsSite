<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Http\Controllers\BaseController;

use View;

class SharedViewDataProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //get list of all events
        $events = BaseController::cacheRequest('event:all', function () {
            return Event::all();
        }, true);

        $teams = BaseController::cacheRequest('team:all', function () {
            return Team::all();
        }, true);
        View::share('events', $events);
        View::share('teams', $teams);
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
