<?php
/**
 * Created by PhpStorm.
 * User: machao
 * Date: 2019-07-31
 * Time: 15:21
 */

namespace App\Process;


use EasySwoole\Component\Process\AbstractProcess;

class Test extends AbstractProcess
{
    protected function run($arg)
    {
        // TODO: Implement run() method.
        var_dump($this->getProcessName() . ". run");

        var_dump($arg);
    }
}