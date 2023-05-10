<?php

namespace Ysnow\LaravelWorkerman\consloe;

use App\Events\WorkerManEvent;
use Illuminate\Console\Command;
use Workerman\Worker;

class LaravelWorkerman extends Command
{
    protected $signature   = 'Workerman {action} {--daemonize}';
    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        global $argv;                          //定义全局变量
        $arg     = $this->argument('action');
        $argv[1] = $arg;
        $argv[2] = $this->option('daemonize') ? '-d' : '';
        switch ($arg) {
            case 'start':
                $this->start();
                break;
            case 'stop':
                $this->stop();
                break;
        }
    }


    protected function start()
    {
        global $text_worker;
        $text_worker = new Worker("websocket://0.0.0.0:7788");
        /// 进程数量
        $text_worker->count = 1;
        $text_worker->name  = 'workerman';
        // 运行worker
        $this->worker_bind($text_worker, WorkerManEvent::class);
        Worker::runAll();
    }

    protected function stop()
    {
        $argv = 'stop';
        Worker::runAll();
    }

    protected function status()
    {
        $status = Worker::getStatus();
        $this->info($status);
    }

    protected function worker_bind($worker, $class)
    {
        $callback_map = [
            'onWorkerStart',
            'onConnect',
            'onMessage',
            'onClose',
            'onError',
            'onBufferFull',
            'onBufferDrain',
            'onWorkerStop',
            'onWebSocketConnect'
        ];
        foreach ($callback_map as $name) {
            if (method_exists($class, $name)) {
                $worker->$name = [$class, $name];
            }
        }
    }
}