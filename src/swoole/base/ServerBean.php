<?php

namespace swoole\base;
// +----------------------------------------------------------------------
// | title:ServerBean.php
// +----------------------------------------------------------------------
// | Copyright:光娱游戏
// +----------------------------------------------------------------------
// | Author: zhangmingyong
// +----------------------------------------------------------------------
// | Date: 2020-04-13
// +----------------------------------------------------------------------

class ServerBean
{


    /**+
     * server 配置
     * @var
     */
    private $setting;

    /***
     * 策略表
     * @var array
     */
    private $strategyTable = [
        "swoole\base\impl\BaseSwooleTcp" => "Swoole\Server",
        "swoole\base\impl\BaseSwooleUdp" => "Swoole\Server",
        "swoole\base\impl\BaseSwooleHttp" => "Swoole\Http\Server",
        "swoole\base\impl\BaseSwooleSocket" => "Swoole\WebSocket\Server",
    ];


    /**
     * 行为注册表
     * key：$eventName 事件名称
     * val：$funName 事务名称
     * @var array
     */
    public $registrationBehaviors;

    /**
     * 读取策略表
     * @param string $class
     * @return class
     */
    public function getStrategyTableByClass($class = "BaseHttp")
    {
        return $this->strategyTable[$class];
    }

    /**
     * ServerBean constructor.
     * @param $setting
     * @param $registrationBehaviors
     */
    public function __construct($setting, $registrationBehaviors)
    {
        $this->setting = $setting;
        $this->registrationBehaviors = $registrationBehaviors;
    }

    /**
     * 读取setting配置
     * @return mixed
     */
    public function getSetting()
    {
        return $this->setting;
    }

    /**
     * 更新setting配置
     * @param mixed $setting
     * @param bool $isRewrite
     */
    public function setSetting(array $setting, bool $isRewrite = false): void
    {
        $this->setting = $isRewrite ? $setting : array_merge($this->setting, $setting);

    }

    /**
     * 设置注册行为列表
     * @param mixed $registrationBehaviors
     */
    public function setRegistrationBehaviors($registrationBehaviors): void
    {
        $this->registrationBehaviors = $registrationBehaviors;
    }

}