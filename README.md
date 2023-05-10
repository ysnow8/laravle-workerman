<p align="center">
    Laravel-Workerman
    这是一个用于在 Laravel 中集成 Workerman 的库。它提供了一个简单的方法来创建实时应用程序，如聊天应用程序、在线游戏、实时协作工具等。
</a>
<p align="center">
    <a><img src="https://img.shields.io/badge/php-7.1+-59a9f8.svg?style=flat" /></a> 
    <a><img src="https://img.shields.io/badge/laravel-9.0+-59a9f8.svg?style=flat" ></a>
    <a><img src="https://img.shields.io/packagist/dt/ysnow/laravel-workerman.svg?style=flat-square"></a>
</p>

## 安装

您可以使用 Composer 安装这个库。在您的 Laravel 项目根目录下，运行以下命令：

```bash
composer require ysnow/laravel-workerman
```

## 发布资源配置文件
```bash
php artisan vendor:publish --provider="YSnow\Laravel\Workerman\WorkermanServiceProvider"
```
## 创建监听文件 app\Events\WorkerManEvent.php
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
您可以使用 Artisan 命令启动 Workerman 服务：

```bash
php artisan workerman:start
```

## 示例

如果适用，您可以提供一些示例代码或演示来展示您的项目的功能。

## 贡献

欢迎贡献！如果您想为这个项目做出贡献，请先阅读 [贡献指南](CONTRIBUTING.md)。

## 版权和许可证

这个项目是根据 [MIT 许可证](LICENSE.md) 分发的。

## 问题和反馈

如果您发现了任何问题，或者有任何建议或反馈，请在 GitHub 存储库中提出一个 issue。我们很乐意听到您的声音！

## 参考资料 
- [Workerman 官方网站](http://www.workerman.net/)
- [Workerman GitHub 存储库](https://github.com/walkor/Workerman) 
