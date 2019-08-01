<?php
/**
 * Created by PhpStorm.
 * User: machao
 * Date: 2019-07-31
 * Time: 18:09
 */
namespace App\Crontab;

use EasySwoole\EasySwoole\Crontab\AbstractCronTask;

class TaskOne extends AbstractCronTask
{
    public static function getRule(): string
    {
        // TODO: Implement getRule() method.
        return '* * * * *';
    }

    public static function getTaskName(): string
    {
        // TODO: Implement getTaskName() method.
        return 'taskOne';
    }

    public static function run(\swoole_server $server, int $taskId, int $fromWorkerId, $flags = null)
    {
        // TODO: Implement run() method.
        var_dump('020202020202020');
    }
}