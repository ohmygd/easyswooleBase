<?php
/**
 * Created by PhpStorm.
 * User: machao
 * Date: 2019-08-01
 * Time: 19:15
 */

namespace App\Dao\Redis;


use EasySwoole\Component\Singleton;
use EasySwoole\RedisPool\Redis;

class TestR
{
    use Singleton;

    private function getConn() {
        return Redis::getInstance()->pool('redis')::defer();
    }

    public function rpop() {
        return $this->getConn()->rpop('mc');
    }

    public function listInsert() {
        $conn = $this->getConn();
        $conn->lpush('mc', 1,2,3,4,5,6,7);
        $res = $conn->lrange('mc', 0, -1);
        return $res;
    }

    public function name() {
        $con = $this->getConn();
        $name = $con->get('name1');
        var_dump($name, '=====');

        $con->set('name1', 'mc2');
        $name = $con->get('name1');
        var_dump($name, '=====');
    }
}