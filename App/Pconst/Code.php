<?php
/**
 * Created by PhpStorm.
 * User: machao
 * Date: 2019-07-31
 * Time: 10:59
 */

const ERROR_OK = 1001; // 成功
const ERROR_AUTH = 2000; // 未登录
const ERROR_PARAM = 1008; // 参数有误

const ERROR_SYSTEM = 10000; // 系统异常
const ERROR_LOCK_GET = 10001; // 获取锁失败

const  ERROR_MYSQL_INSERT = 10101; // 数据库插入异常
const  ERROR_MYSQL_SELECT = 10102; // 数据库查询异常
const  ERROR_MYSQL_UPDATE = 10103; // 数据库更新异常
const  ERROR_MYSQL_DELETE = 10104; // 数据库删除异常
const  ERROR_MYSQL_FIRST = 10105; // 数据库查询异常
const  ERROR_MYSQL_COUNT = 10106; // 数据库查询异常

const ERROR_REDIS_INIT_ADDRESS = 10301; // redis地址有误
const ERROR_REDIS_POOL_NULL = 10302; // redis连接池为空
const ERROR_REDIS_POOL_GET = 10303; // redis连接池获取异常
const ERROR_REDIS_POOL_EMPTY = 10304; // redis连接池为空
const ERROR_REDIS_POOL_REDIAL = 10305; // redis
const ERROR_REDIS_SET_DO = 10307; // redis设置异常
const ERROR_REDIS_MSET_DO = 10310; // redis 批量设置异常
const ERROR_REDIS_GET_DO = 10311; // redis获取异常
const ERROR_REDIS_MGET_DO = 10314; // redis批量获取异常
const ERROR_REDIS_INCR_DO = 10315; // redis自增异常
const ERROR_REDIS_DEL_DO = 10317; // redis删除异常
const ERROR_REDIS_EXPIRE_DO = 10318; //redis设置超时异常
const ERROR_REDIS_PIPE_SEND = 10321; // redis管道发送异常

const ERROR_HTTP_CONFIG = 10501; // http配置异常
const ERROR_HTTP_POSTFORM = 10502; // http请求异常
const ERROR_HTTP_POSTFORM_RESPONSE = 10503; // http返回异常
const ERROR_HTTP_POSTGET = 10504; // http请求异常
const ERROR_HTTP_POSTGET_RESPONSE = 10505; // http返回异常
const ERROR_HTTP_UNMARSHAL = 10507; // http解析异常


const ERROR_MONGO_CREATE = 10601; // mongo新增异常
const ERROR_MONGO_SELECT = 10602; // mongo选择异常
const ERROR_MONGO_UPDATE = 10603; // mongo更新异常
const ERROR_MONGO_DELETE = 10604; // mongo删除异常

const MSGS = [
    '1001' => 'success',
    '2000' => '未登录',
    '1008' => '参数有误',
    '10000' => '系统异常',
    '10001' => '获取锁失败',
    '10101' => '数据库插入异常',
    '10102' => '数据库查询异常',
    '10103' => '数据库更新异常',
    '10104' => '数据库删除异常',
    '10105' => '数据库查询异常',
    '10106' => '数据库查询异常',
    '10301' => 'redis地址有误',
    '10302' => 'redis连接池为空',
    '10303' => 'redis连接池获取异常',
    '10304' => 'redis连接池为空',
    '10305' => 'redis',
    '10307' => 'redis设置异常',
    '10310' => 'redis 批量设置异常',
    '10311' => 'redis获取异常',
    '10314' => 'redis批量获取异常',
    '10315' => 'redis自增异常',
    '10317' => 'redis删除异常',
    '10318' => 'redis设置超时异常',
    '10321' => 'redis管道发送异常',
    '10501' => 'http配置异常',
    '10502' => 'http请求异常',
    '10503' => 'http返回异常',
    '10504' => 'http请求异常',
    '10505' => 'http返回异常',
    '10507' => 'http解析异常',
    '10601' => 'mongo新增异常',
    '10602' => 'mongo查询异常',
    '10603' => 'mongo更新异常',
    '10604' => 'mongo删除异常',
];

function getErrorMsg(int $code) {
    return MSGS[$code] ?? '未定义错误类型';
}
