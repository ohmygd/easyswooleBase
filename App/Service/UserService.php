<?php
/**
 * Created by PhpStorm.
 * User: machao
 * Date: 2019-08-01
 * Time: 09:56
 */
namespace App\Service;

use App\Dao\Mysql\UserDM;
use App\Exception\PEx;
use EasySwoole\Component\Singleton;
use EasySwoole\EasySwoole\Logger;

class UserService
{
    use Singleton;

    public function first($id) {
        $this->firstCheck($id);

        $randId  = rand(1,3);
        $user = UserDM::getInstance()->first($randId);

        Logger::getInstance()->info($randId .  $user . "---------\n");

        return $user;
    }

    private function firstCheck($id) {
        if (empty($id)) {
            throw new PEx(ERROR_PARAM);
        }
    }
}