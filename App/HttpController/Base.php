<?php
/**
 * Created by PhpStorm.
 * User: Tioncico
 * Date: 2019/3/18 0018
 * Time: 10:45
 */

namespace App\HttpController;


use App\Exception\PEx;
use EasySwoole\Http\AbstractInterface\Controller;
use EasySwoole\Http\Message\Status;
use EasySwoole\EasySwoole\Trigger;

abstract class Base extends Controller
{
    function index()
    {
        $this->actionNotFound('index');
    }

    public function renderSuccData($data = '') {
        return $this->renderBase(ERROR_OK, '', $data);
    }

    public function renderSuccess() {
        return $this->renderBase(ERROR_OK);
    }

    private function renderBase($code, string $msg = '', $data = '') {
        if (!$this->response()->isEndResponse()) {
            $data = Array(
                "code" => $code,
                "msg" => empty($msg) ? getErrorMsg($code) : $msg,
                "data" => $data
            );
            $this->response()->write(json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
            $this->response()->withHeader('Content-type', 'application/json;charset=utf-8');
            $this->response()->withStatus(200);
            return true;
        } else {
            return false;
        }
    }

    protected function onRequest(?string $action): ?bool
    {
        // 参数校验
        $v = $this->validateRule($action);
        if( $v ){
            $ret = $this->validate($v);
            if($ret == false){
                throw new PEx(ERROR_PARAM, $v->getError()->__toString());
            }
        }
        return true;
    }
}