<?php
/**
 * Created by PhpStorm.
 * User: machao
 * Date: 2019-07-26
 * Time: 16:52
 */
namespace App\HttpController\Api;

use App\Exception\PEx;
use App\HttpController\Base;
use App\Task\TestTask;
use EasySwoole\Component\Timer;
use EasySwoole\EasySwoole\Config;
use EasySwoole\EasySwoole\Logger;
use EasySwoole\EasySwoole\Swoole\Task\TaskManager;

class TestApi extends Base
{
    public function index()
    {
        echo '222222';
    }

    function test1() {
        $config = Config::getInstance()->getConf();

        var_dump($config);

        $name = Config::getInstance()->getConf('name');
        $age = Config::getInstance()->getConf('age');

        var_dump($name, $age, '========');
    }

    public function test2() {
        $name = $this->request()->getRequestParam('name');
        $age = $this->request()->getRequestParam('age');
        $uid = $this->request()->getCookieParams('uid');

        var_dump($name, $age, $uid);

        return $this->writeJson(200, ['code' => 1001], 'success');
    }

    public function test3() {
        echo '123;';
        return $this->renderSuccess();
    }

    public function test4() {
        return $this->renderSuccData(123);
    }

    public function test5() {
        throw new PEx(ERROR_MYSQL_UPDATE);
    }

    public function test6() {
        throw new PEx(ERROR_OK, "hello mc");
    }

    public function test7() {
        TaskManager::async(function() {
            \Co::sleep(5);

            echo '123';
        });
    }

    public function test8() {
        Timer::getInstance()->loop(1000, function() {
            $a = 123;
            $b = 456;
            TaskManager::async(function() use ($a, $b) {
                echo $a, $b, '======';
                //todo 待测试是否可以调用service方法
            });
        });
    }

    public function test9() {
        TaskManager::async(new TestTask(['mc', 20]));
    }

    public function test10() {
        $tasks[] = function() {sleep(3); return 'this is 1';};
        $tasks[] = function() {sleep(4); return 'this is 2';};
        $tasks[] = function() {sleep(5); return 'this is 3';};
        $tasks[] = function() {sleep(6); return 'this is 4';};

        $result = TaskManager::barrier($tasks, 6);

        var_dump($result);

    }

    public function test11() {
        Logger::getInstance()->error("hello mc");
    }

    public function onRequest(?string $action): ?bool
    {
        $methodArr = ['test1'];
        if (in_array($action, $methodArr)) {
            echo '111111';
            return false;
        }

        return true;
    }
}