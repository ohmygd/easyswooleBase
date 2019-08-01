<?php
/**
 * Created by PhpStorm.
 * User: machao
 * Date: 2019-07-31
 * Time: 15:10
 */
namespace App\Command;

use EasySwoole\EasySwoole\Command\CommandInterface;


/**
 * test 自定义命令
 */
class Test implements CommandInterface
{
    public function commandName(): string
    {
        return 'test';
    }

    public function exec(array $args): ?string
    {
        var_dump($args);

        return 'test exec';
    }

    public function help(array $args): ?string
    {
        return 'test help';
    }
}