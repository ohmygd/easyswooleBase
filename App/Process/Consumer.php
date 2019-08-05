<?php
/**
 * Created by PhpStorm.
 * User: machao
 * Date: 2019-08-01
 * Time: 19:23
 */

namespace App\Process;


use App\Dao\Redis\TestR;
use EasySwoole\Component\Process\AbstractProcess;

class Consumer extends AbstractProcess
{
    private $isRun = false;

    protected function run($arg)
    {
        $this->addTick(5 * 1000, function() {
            if (! $this->isRun) {
                $this->isRun = true;

                while(true) {
                    try {
                        $res = TestR::getInstance()->rpop();
                        if (! $res) {
                            break;
                        }
                        var_dump($res);
                    } catch (\Exception $e) {
                        break;
                    }
                }

                $this->isRun = false;

                var_dump($this->getProcessName()." task run check\n");
            }
        });
    }
}