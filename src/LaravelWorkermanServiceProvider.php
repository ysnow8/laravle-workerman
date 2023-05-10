<?php

namespace Ysnow\LaravelWorkerman;

use Illuminate\Support\ServiceProvider;
use Ysnow\LaravelWorkerman\consloe\LaravelWorkerman;


class LaravelWorkermanServiceProvider extends ServiceProvider
{


    public function boot()
    {


        if ($this->app->runningInConsole()) {
            $this->commands([
                LaravelWorkerman::class
            ]);
        }

    }


    public function register()
    {

    }
}