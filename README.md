# <center>laravle-workerman</center>
laravel集成workerman实现websocket

安装
~~~
composer require ysnow/laravel-workerman
~~~
发布配置文件
~~~
php artisan vendor:publish --provider="Ysnow\LaravelWorkerman\LaravelWorkermanServiceProvider"
~~~
创建监听文件 app\Events\WorkerManEvent.php
~~~
<?php

namespace App\Events;

class WorkerManEvent
{
    public static function onConnect($client_id)
    {
    }

    public static function onWebSocketConnect($client_id, $data)
    {
    }

    // 这里写自己的逻辑
    public static function onMessage($client_id, $message)
    {
        return $client_id->send(json_encode([
            'code' => 200, 'data' => json_decode($message)
        ]));;
    }

    public static function onClose($client_id)
    {
    }
}
~~~
启动命令
~~~
php artisan workerman start --daemonize（进程守护）
~~~
停止命令
~~~
php artisan workerman stop
~~~
