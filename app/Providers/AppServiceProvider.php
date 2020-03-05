<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Channel;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        // send variable to the choosen view
        // \View::composer('threads.create', function($view){
        //     $view->with('channels', \App\Channel::all());
        // });

        //send variable to all views before the view is loaded
        \View::composer('*', function($view){
            $view->with('channels', \App\Channel::all());
        });

        //send variable to all views but after the view is loaded
        // \View::share('channels', Channel::all());
    }
}
