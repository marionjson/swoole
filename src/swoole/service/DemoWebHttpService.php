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
        return array(
            "enable_static_handler" => true,
            "document_root"=>"/media/sf_swoole/swoole_test/swoole/html"
        );
    }


    public function onRequest(\Swoole\Http\Request $request, \Swoole\Http\Response $response)
    {
        $response->end("<h1>Hello Swoole. #".rand(1000, 9999)."</h1>");
    }
}

