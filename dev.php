<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2019-01-01
 * Time: 20:06
 */

return [
    'SERVER_NAME'   => "Coupon",//服务名
    'MAIN_SERVER'   => [
        'LISTEN_ADDRESS' => '0.0.0.0',//监听地址
        'PORT'           => 9501,//监听端口
        'SERVER_TYPE'    => EASYSWOOLE_WEB_SERVER, //可选为 EASYSWOOLE_SERVER  EASYSWOOLE_WEB_SERVER EASYSWOOLE_WEB_SOCKET_SERVER
        'SOCK_TYPE'      => SWOOLE_TCP,//该配置项当为SERVER_TYPE值为TYPE_SERVER时有效
        'RUN_MODEL'      => SWOOLE_PROCESS,// 默认Server的运行模式
        'SETTING'        => [// Swoole Server的运行配置（ 完整配置可见[Swoole文档](https://wiki.swoole.com/wiki/page/274.html) ）
            'worker_num'       => 4,//运行的  worker进程数量
            'task_worker_num'  => 1,//运行的 task_worker 进程数量
            'task_enable_coroutine' => true, //开启后自动在onTask回调中创建协程
            'reload_async' => true, //设置异步重启开关。设置为true时，将启用异步安全重启特性，Worker进程会等待异步事件完成后再退出。
        ]
    ],
    'TEMP_DIR'      => null,//临时文件存放的目录
    'LOG_DIR'       => null,//日志文件存放的目录
    'CONSOLE'       => [//console控制台组件配置
        'ENABLE'         => true,//是否开启
        'LISTEN_ADDRESS' => '127.0.0.1',//监听地址
        'PORT'           => 9500,//监听端口
        'USER'           => 'root',//验权用户名
        'PASSWORD'       => '123456'//验权用户名
    ],
    'FAST_CACHE'    => [//fastCache组件
        'PROCESS_NUM' => 0,//进程数,大于0才开启
        'BACKLOG'     => 256,//数据队列缓冲区大小
    ],
    'DISPLAY_ERROR' => true,//是否开启错误显示
    'name' => 'mc',
    'age' => 20,

    /*--- MYSQL ---*/
    'MYSQL'         => [
        'host'                 => '127.0.0.1',
        'port'                 => 3306,
        'user'                 => 'root',
        'password'             => '123456',
        'database'             => 'mall',
        'timeout'              => 30,
        'charset'              => 'utf8mb4',
        'connect_timeout'      => '5',//连接超时时间
        'maxObjectNum' => 5,
        'minObjectNum' => 3,
        'maxIdleTime' => 15,
        'intervalCheckTime' => 30 * 1000,
    ],

    /*--- REDIS ---*/
    'REDIS' => [
        'host'          => '127.0.0.1',
        'port'          => '6379',
        'auth'          => '',
        'intervalCheckTime'    => 30 * 1000,//定时验证对象是否可用以及保持最小连接的间隔时间
        'maxIdleTime'          => 15,//最大存活时间,超出则会每$intervalCheckTime/1000秒被释放
        'maxObjectNum'         => 20,//最大创建数量
        'minObjectNum'         => 5,//最小创建数量 最小创建数量不能大于等于最大创建
    ],

    /*--- HTTP ---*/
    'HTTP_INFO' => [
        'mall' => [
            'url' => 'http://dev.mall.holly.com',
            'list' => [
                'attributeList' => '/admin/attribute/list',
            ]
        ]
    ]
];