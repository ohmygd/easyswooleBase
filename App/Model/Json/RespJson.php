<?php
/**
 * Created by PhpStorm.
 * User: machao
 * Date: 2019-08-01
 * Time: 18:51
 */

namespace App\Model\Json;


use EasySwoole\Spl\SplBean;

class RespJson extends SplBean
{
    protected $code;
    protected $msg;
    protected $data;

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     */
    public function setCode($code): void
    {
        $this->code = $code;
    }

    /**
     * @return mixed
     */
    public function getMsg()
    {
        return $this->msg;
    }

    /**
     * @param mixed $msg
     */
    public function setMsg($msg): void
    {
        $this->msg = $msg;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data): void
    {
        $this->data = $data;
    }

}