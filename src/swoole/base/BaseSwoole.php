<?php
namespace swoole\base;

// +----------------------------------------------------------------------
// | title:ws.基础类库
// +----------------------------------------------------------------------
// | Copyright:光娱游戏
// +----------------------------------------------------------------------
// | Author: zhangmingyong
// +----------------------------------------------------------------------
// | Date: 2020-04-11
// +----------------------------------------------------------------------


abstract class BaseSwoole
{
    private $host = '0.0.0.0';

    private $port = 8812;

    private $mode = SWOOLE_PROCESS;

    private $sockType = SWOOLE_SOCK_TCP;

    /***
     * @var  \Swoole\Server
     */
    private $server;

    public $serverBean;

    /**
     * ws constructor.
     * @param $baseClass
     */
    protected function __construct($baseClass)
    {
        $this->serverBean = $this->intServerBean();
        $this->server = $this->instantiationFactory($baseClass);
    }

    /***
     * 工厂实例化
     * @param $baseClass
     * @return mixed
     */
    private function instantiationFactory($baseClass)
    {
        if ($this->serverBean instanceof ServerBean) {
            $instantiationClass = !empty($this->serverBean->getStrategyTableByClass($baseClass))
                ? $this->serverBean->getStrategyTableByClass($baseClass) : $this->serverBean->getStrategyTableByClass();
            return new $instantiationClass($this->host, $this->port, $this->mode, $this->sockType);
        }
    }

    /**
     * 注册行为
     */
    public function run()
    {
        if ($this->serverBean instanceof ServerBean) {
            if(method_exists($this->server,"set")){
                //设置配置
                $this->server->set($this->serverBean->getSetting());
            }
            //执行注册行为
            if (!empty($this->serverBean->registrationBehaviors) && count($this->serverBean->registrationBehaviors) > 0) {
                array_walk($this->serverBean->registrationBehaviors, function ($funName, $eventName) {
                    $this->server->on($eventName, [$this, $funName]);
                });
            }
        }
    }

    public function __destruct()
    {
        // TODO: Implement __destruct() method.
        $this->server->start();
    }

    /**
     * 初始化服务配置Bean
     * @return ServerBean
     */
    public function intServerBean(): ServerBean
    {
        return $this->serverBean = new ServerBean($this->__setting(), $this->__registrationBehaviors());
    }



    /***
     * 初始化策略
     * @return mixed
     */
    abstract public function __registrationBehaviors();

}