<?php
/**
 * Created by PhpStorm.
 * User: machao
 * Date: 2019-08-01
 * Time: 19:44
 */

namespace App\Queue;

use EasySwoole\Component\Singleton;
use EasySwoole\RedisPool\Redis;

class TestQueue
{
    use Singleton;

    protected $queueName;

    function __construct($queueName = 'default')
    {
        $this->queueName = $queueName;
    }

    private function getConn() {
        return Redis::getInstance()->pool('redis')::defer();
    }

    public function pop() {
        return $this->getConn()->rpop($this->queueName);
    }

    public function push($param) {
        return $this->getConn()->lpush($this->queueName, $param);
    }
}