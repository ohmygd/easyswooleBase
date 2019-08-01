<?php
/**
 * Created by PhpStorm.
 * User: machao
 * Date: 2019-07-31
 * Time: 14:09
 */
namespace App\Exception;

class PEx extends \Exception
{
    protected $code;

    protected $msg;

    function __construct(int $code, string $msg = '') {
        $this->code = $code;
        $this->msg = $msg;
    }

    function getMsg() {
        return $this->msg;
    }
}