<?php

//创建websocket服务器对象，监听0.0.0.0:9502端口
$server = new Swoole\WebSocket\Server("0.0.0.0",8812);
//设置配置
$server->set(array(
    "enable_static_handler"=>true,
    "document_root"=>"/media/sf_swoole/swoole_test/swoole/html"
));

$server->on('open', function (Swoole\WebSocket\Server $server, $request) {
    echo "server: handshake success with fd{$request->fd}\n";
});

$server->on('message', function (Swoole\WebSocket\Server $server, $frame) {
    echo "receive from {$frame->fd}:{$frame->data},opcode:{$frame->opcode},fin:{$frame->finish}\n";
    $server->push($frame->fd, "this is server");
});

$server->on('close', function ($ser, $fd) {
    echo "client {$fd} closed\n";
});

$server->start();