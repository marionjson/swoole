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
            "request" => "onRequest",
        );
    }

    public function __construct()
    {
        parent::__construct(get_class());
    }

    abstract public function onRequest(\Swoole\Http\Request $request, \Swoole\Http\Response $response);

    /***
     * 配置
     * @return mixed
     */
    abstract public function __setting();
}

