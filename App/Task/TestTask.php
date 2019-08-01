<?php
/**
 * Created by PhpStorm.
 * User: machao
 * Date: 2019-07-31
 * Time: 15:50
 */
namespace App\Task;

use EasySwoole\EasySwoole\Swoole\Task\AbstractAsyncTask;

class TestTask extends AbstractAsyncTask
{
    protected function run($taskData, $taskId, $fromWorkerId, $flags = null)
    {
        // TODO: Implement run() method.
        var_dump($taskData, $taskId, $fromWorkerId, "---------");

    }

    protected function finish($result, $task_id)
    {
         echo 'finish';
    }
}