<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2018/5/28
 * Time: 下午6:33
 */

namespace EasySwoole\EasySwoole;


use App\Crontab\TaskOne;
use App\Exception\ExceptionHandler;
use App\Pool\Mysql\MysqlPool;
use App\Process\Consumer;
use App\Process\HotReload;
use App\Process\Test;
use App\Utility\TrackerManager;
use EasySwoole\Component\AtomicManager;
use EasySwoole\Component\Di;
use EasySwoole\Component\Pool\PoolManager;
use EasySwoole\EasySwoole\Crontab\Crontab;
use EasySwoole\EasySwoole\Swoole\EventRegister;
use EasySwoole\EasySwoole\AbstractInterface\Event;
use EasySwoole\Http\Message\Status;
use EasySwoole\Http\Message\Stream;
use EasySwoole\Http\Request;
use EasySwoole\Http\Response;
use EasySwoole\MysqliPool\Mysql;
use EasySwoole\RedisPool\Redis;
use EasySwoole\Trace\Bean\Tracker;

class EasySwooleEvent implements Event
{

    public static function initialize()
    {
        date_default_timezone_set('Asia/Shanghai');

        Di::getInstance()->set(SysConst::HTTP_EXCEPTION_HANDLER, [ExceptionHandler::class, 'handle']);

        $config = Config::getInstance()->getConf("MYSQL");
        $c = new \EasySwoole\Mysqli\Config($config);

        $poolConf = Mysql::getInstance()->register('mysql', $c);
        $poolConf->setMinObjectNum(5)->setMaxObjectNum(10);

        $rConfig = Config::getInstance()->getConf('REDIS');
        $r = new \EasySwoole\RedisPool\Config($rConfig);

        $rPoolConf = Redis::getInstance()->register('redis', $r);
        $rPoolConf->setMinObjectNum(4)->setMaxObjectNum(6);

        AtomicManager::getInstance()->add('second');
    }

    public static function mainServerCreate(EventRegister $register)
    {
        $swooleServer = ServerManager::getInstance()->getSwooleServer();
        $swooleServer->addProcess((new HotReload('HotReload', ['disableInotify' => false]))->getProcess());

//        $tpConfig = new \EasySwoole\Component\Process\Config();
//        $tpConfig->setProcessName("testProcess");
//
//        $tpConfig->setArg([
//                'name' => 'mc',
//                'age' => 20
//            ]);
//
//        $swooleServer->addProcess((new Test($tpConfig))->getProcess());

        // 定时任务
//        Crontab::getInstance()->addTask(TaskOne::class);


        // 队列 自定义进程
        //$allNum = 3;
//        for($i=0;$i<$allNum;$i++) {
//            ServerManager::getInstance()->getSwooleServer()->addProcess((new Consumer("consumer_{$i}"))->getProcess());
//        }

        $register->add($register::onWorkerStart,function (\swoole_server $server,int $workerId){
            Di::getInstance()->set('workerId', $workerId);
        });
    }

    public static function onRequest(Request $request, Response $response): bool
    {
        $response->withHeader('Access-Control-Allow-Origin', '*');
        $response->withHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS');
        $response->withHeader('Access-Control-Allow-Credentials', 'true');
        $response->withHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With');
        if ($request->getMethod() === 'OPTIONS') {
            $response->withStatus(Status::CODE_OK);
            return false;
        }

        return true;
    }

    public static function afterRequest(Request $request, Response $response): void
    {

    }
}