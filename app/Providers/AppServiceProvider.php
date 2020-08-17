<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;


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
        if ($this->app->isLocal())
        {
            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        \View::composer('*', function($view){
            // $channels = Channel::all();
            $channels = \Cache::rememberForever('channels', function(){
                return Channel::all();
            });

            $view->with('channels', $channels);

        });

//        send variable to all views but after the view is loaded
//        \View::share('channels', Channel::all());

        Validator::extend('spamfree', 'App\Rules\SpamFree@passes');



        // send variable to the choosen view
        // \View::composer('threads.create', function($view){
        //     $view->with('channels', \App\Channel::all());
        // });



    }
}
