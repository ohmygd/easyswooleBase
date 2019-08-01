<?php
/**
 * Created by PhpStorm.
 * User: machao
 * Date: 2019-07-31
 * Time: 14:11
 */

namespace App\Exception;

use EasySwoole\EasySwoole\Logger;
use EasySwoole\Http\Request;
use EasySwoole\Http\Response;
class ExceptionHandler
{
    public static function handle( \Throwable $e, Request $request, Response $response )
    {
        if ($e instanceof PEx) {
            $data = Array(
                "code" => $e->getCode(),
                "msg" => empty($e->getMsg()) ? getErrorMsg($e->getCode()) : $e->getMsg(),
                "data" => ""
            );

            $response->write(json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
            $response->withHeader('Content-type', 'application/json;charset=utf-8');
            $response->withStatus(200);
            return true;
        }

        // 非系统错误, 记录错误信息
        Logger::getInstance()->error($e->getMessage());
        Logger::getInstance()->error($e->getTraceAsString());

        $data = Array(
            "code" => ERROR_SYSTEM,
            "msg" => empty($msg) ? getErrorMsg(ERROR_SYSTEM) : $msg,
            "data" => ""
        );

        $response->write(json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
        $response->withHeader('Content-type', 'application/json;charset=utf-8');
        $response->withStatus(200);

        return true;
    }
}