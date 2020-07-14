<?php
namespace swoole\base\impl;
// +----------------------------------------------------------------------
// | title:DemoWebSocket.php
// +----------------------------------------------------------------------
// | Copyright:光娱游戏
// +----------------------------------------------------------------------
// | Author: zhangmingyong
// +----------------------------------------------------------------------
// | Date: 2020-04-11
// +----------------------------------------------------------------------


use swoole\base\BaseSwoole;

abstract class BaseSwooleHttp extends BaseSwoole
{

    /**
     * 默认行为注册策略
     * @return array|mixed
     */
    public function __registrationBehaviors()
    {
        return array(
            "open" => "onOpen",
            "message" => "onMessage",
            "close" => "onClose",
        );
    }

    public function __construct()
    {
        parent::__construct(get_class());
    }

    abstract public function onOpen(\Swoole\WebSocket\Server $server, \Swoole\Http\Request $request);

    abstract public function onMessage(\Swoole\Websocket\Server $server, \Swoole\Websocket\Frame $frame);

    abstract public function onClose(\Swoole\Websocket\Server $server, $fd);

    /***
     * 配置
     * @return mixed
     */
    abstract public function __setting();
}

