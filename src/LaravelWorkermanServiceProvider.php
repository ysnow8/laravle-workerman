<?php

namespace Ysnow\LaravelWorkerman;

use Illuminate\Support\ServiceProvider;
use Ysnow\LaravelWorkerman\consloe\LaravelWorkerman;


class LaravelWorkermanServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // 发布配置文件
        $this->publishes([
            __DIR__
            .'/../config/laravel-workerman.php' => config_path('laravel-workerman.php'),
        ]);
        
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