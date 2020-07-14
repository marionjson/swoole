<?php

//创建websocket服务器对象，监听0.0.0.0:9502端口
$http = new Swoole\Http\Server("0.0.0.0",8813);

//设置配置
$http->set(array(
    "enable_static_handler"=>true,
    "document_root"=>"/media/sf_swoole/swoole_test/swoole/html"
));

//监听WebSocket连接打开事件
$http->on('request', function ($server, $response) {
});


$http->start();