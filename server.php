<?php

//创建websocket服务器对象，监听0.0.0.0:9502端口
$server = new Swoole\WebSocket\Server("0.0.0.0",8812);

//设置配置
$server->set(array(
//    "reactor_num"=>4, //设置启动的 Reactor 线程数
//    "worker_num"=>4, //设置启动的 worker_num 进程数
    "enable_static_handler"=>true,
    "document_root"=>"/data/www/swoole_test/websocket/html"
));

//监听WebSocket连接打开事件
$server->on('open', function (Swoole\WebSocket\Server $server,Swoole\Http\Request $request) {
    echo "server: handshake success with fd{$request->fd}\n";
});


//监听WebSocket消息事件
$server->on('message', function (Swoole\WebSocket\Server $server, $frame) {
    echo "receive from {$frame->fd}:{$frame->data},opcode:{$frame->opcode},fin:{$frame->finish}\n";
    $server->push($frame->fd, "this is server");
});

//监听WebSocket连接关闭事件
$server->on('close', function ($ser, $fd) {
    echo "client {$fd} closed\n";
});

$server->start();