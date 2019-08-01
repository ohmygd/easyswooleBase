<?php
/**
 * Created by PhpStorm.
 * User: machao
 * Date: 2019-08-01
 * Time: 09:58
 */
namespace App\Dao\Mysql;

use App\Model\Mysql\UserM;
use EasySwoole\Component\Singleton;
use EasySwoole\MysqliPool\Mysql;

class UserDM
{
    use Singleton;

    function getConn()
    {
        return Mysql::getInstance()->pool('mysql')::defer();
    }

    protected $table = 'user';

    public function first($id): UserM {
        $user = $this->getConn()->where('id', $id)->getOne('user', '*');

        return new UserM($user);
    }
}