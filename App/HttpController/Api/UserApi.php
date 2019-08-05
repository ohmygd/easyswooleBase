<?php
/**
 * Created by PhpStorm.
 * User: machao
 * Date: 2019-08-01
 * Time: 10:16
 */

namespace App\HttpController\Api;


use App\Dao\Http\AttributeH;
use App\Dao\Redis\TestR;
use App\Enum\MonthE;
use App\Exception\PEx;
use App\HttpController\Base;
use App\Service\UserService;
use EasySwoole\Component\AtomicManager;
use EasySwoole\Component\Di;
use EasySwoole\HttpClient\HttpClient;
use EasySwoole\MysqliPool\Mysql;
use EasySwoole\RedisPool\Redis;
use EasySwoole\Utility\Hash;
use EasySwoole\Utility\Random;
use EasySwoole\Validate\Validate;
use Swoole\Lock;

class UserApi extends Base
{
    public function first() {
        $user = UserService::getInstance()->first(1);

        return $this->renderSuccData($user);
    }

    public function test4() {
        $db = Mysql::getInstance()->pool('mysql')::defer();

        $data = $db->where('id', 1)->getOne('user', '*');

        return $this->renderSuccData($data);
    }

    public function test5() {
        $redis = Redis::getInstance()->pool('redis')::defer();
        echo '123';
        $redis->set('name', 'mc');
        echo '456';
        $data = $redis->get('name');
        echo '789';
        return $this->renderSuccData($data);
    }

    public function test6() {
        $data = [
            'name' => 'mc',
            'age' => 10
        ];

        $validate = new Validate();
        $validate->addColumn('name', '姓名')->required('名字为空');
        $validate->addColumn('age', '年龄')->integer('年龄不能为空');

        if (! $validate->validate($data)) {
            throw new PEx(ERROR_PARAM, $validate->getError()->__toString());
        }
    }

    public function test7() {
        $month = new MonthE(1);

        var_dump(MonthE::FEBRUARY == 2); // true
        var_dump($month->getName(), $month->getValue());
    }

    public function test8() {
        for($i=0;$i<100;$i++) {
            $url = "http://dev.mall.holly.com/admin/attribute/list";

            $test = new HttpClient();
            $test->setUrl($url);
            $res = $test->get();
        }

    }

    public function test9() {
        $res = AttributeH::getInstance()->attributeList();

        return $this->renderSuccData($res);
    }

    public function test10() {
        TestR::getInstance()->name();
    }

    // 参数规则
    protected function validateRule(?string $action): ?Validate
    {
        $v = new Validate();
        switch ($action){
            case 'test6':{
                $v->addColumn('name', '名字不能为空')->required('名字为空');
                $v->addColumn('age')->integer('年龄不是数字');
                break;
            }
        }
        return $v;
    }

    public function test11() {
        $res = TestR::getInstance()->listInsert();

        return $this->renderSuccData($res);
    }

    public function test12() {
        //todo openssl等待问题解决
        $str = 'mc';
        $res1 = encrypt($str);
        var_dump($res1);
        $res2 = decrypt($res1);
        var_dump($res2);
    }

    public function test13() {
        $dd = AtomicManager::getInstance()->get('second');
        var_dump($dd->get(), '--------' . Di::getInstance()->get('workerId'));

        for($i=0;$i<10;$i++) {
            $dd->add(1);
        }

        $dd->get('second');
        var_dump($dd->get(), '----111111111111111----' . Di::getInstance()->get('workerId'));

        $dd->set(0);
        var_dump($dd->get(), '--------' . Di::getInstance()->get('workerId'));
    }

    // hash哈希
    public function test14() {
        $pwd = '123456';

        $hash = Hash::makePasswordHash($pwd);
        var_dump($hash);

        $res = Hash::validatePasswordHash($pwd, $hash);
        var_dump($res);
    }

    // 随机数
    public function test15() {
        $a = Random::character(7);
        $b = Random::number(4);
        $c = Random::arrayRandOne(['a', 'b']);

        var_dump($a, $b, $c);

    }
}