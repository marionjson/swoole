<?php
// +----------------------------------------------------------------------
// | title:DemoWebSocketService.php
// +----------------------------------------------------------------------
// | Copyright:光娱游戏
// +----------------------------------------------------------------------
// | Author: zhangmingyong
// +----------------------------------------------------------------------
// | Date: 2020-04-13
// +----------------------------------------------------------------------
namespace swoole\service;

use swoole\base\impl\BaseSwooleHttp;

class DemoWebHttpService extends BaseSwooleHttp
{

    public function __setting(): array
    {
        // TODO: Implement __setting() method.
        return array(
            //    "reactor_num"=>4, //设置启动的 Reactor 线程数
            //    "worker_num"=>4, //设置启动的 worker_num 进程数
            "enable_static_handler" => true,
            "document_root" => "/data/www/swoole_test/swoole/html"
        );
    }

    public function onOpen(\Swoole\WebSocket\Server $server, \Swoole\Http\Request $request)
    {
        // TODO: Implement onOpen() method.
        echo "server: handshake success with fd{$request->fd}\n";
    }

    public function onMessage(\Swoole\Websocket\Server $server, \Swoole\Websocket\Frame $frame)
    {
        echo "receive from {$frame->fd}:{$frame->data},opcode:{$frame->opcode},fin:{$frame->finish}\n";
        $server->push($frame->fd, "this is server");
    }

    public function onClose(\Swoole\Websocket\Server $server, $fd)
    {
        // TODO: Implement onClose() method.
        echo "client {$fd} closed\n";
    }

}

