<?php
/**
 * Created by PhpStorm.
 * User: machao
 * Date: 2019-08-02
 * Time: 09:47
 */

if (!function_exists('snGen')) {

    /**
     * @param bool $refund
     * @return string
     */
    function snGen($refund = false)
    {
        $prefix = "HY";

        // 毫秒级时间
        $mtime = microtime(true) * 10000;

        $last = rand(1000, 9999);

        return $prefix . ($refund ? 'R' : '') . $mtime . $last;
    }
}

if (!function_exists('SixIntFormat')) {

    function SixIntFormat($param)
    {
        $paramPreg = "/^[0-9]{6}$/i";
        return preg_match($paramPreg, $param);
    }
}

if (!function_exists('arrayUnique')) {

    /**
     * @param $arr
     * @return array
     */
    function arrayUnique($arr)
    {
        if (empty($arr)) {
            return [];
        }

        return array_values(array_unique($arr));
    }
}

if (!function_exists('isDate')) {

    function isDate($dateString)
    {
        return strtotime(date('Y-m-d', strtotime($dateString))) === strtotime($dateString);
    }
}

if (!function_exists('encrypt')) {

    function encrypt($param)
    {
        $openssl = new \EasySwoole\Component\Crypto\AES('mcholly');

        return $openssl->encrypt($param);
    }
}

if (!function_exists('decrypt')) {

    function decrypt($param)
    {
        $openssl = new \EasySwoole\Component\Crypto\AES('mcholly');

        return $openssl->decrypt($param);
    }
}