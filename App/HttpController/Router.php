<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2018/8/15
 * Time: 上午10:39
 */
namespace App\HttpController;

use EasySwoole\Http\AbstractInterface\AbstractRouter;
use EasySwoole\Http\Request;
use EasySwoole\Http\Response;
use FastRoute\RouteCollector;

class Router extends AbstractRouter
{
    function initialize(RouteCollector $routeCollector)
    {
//        $this->setGlobalMode(true);

//        $this->setMethodNotAllowCallBack(function (Request $request,Response $response){
//            $response->write('未找到处理方法');
//        });
//        $this->setRouterNotFoundCallBack(function (Request $request,Response $response){
//            $response->write('未找到路由匹配');
//        });

        // TODO: Implement initialize() method.
        $routeCollector->get('/test','/Api/TestApi/index');
        $routeCollector->get('/test1','/Api/TestApi/test1');
    }
}