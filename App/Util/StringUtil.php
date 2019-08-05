<?php
/**
 * Created by PhpStorm.
 * User: machao
 * Date: 2019-08-02
 * Time: 09:48
 */

if (!function_exists('arrayToString')) {
    /**
     * arr 转 uri [a,b,c] => a&b&c
     * @param array $arr
     * @return string
     */
    function arrayToString($arr = [])
    {
        if (count($arr) == 0) {
            return '';
        }

        $buf = [];

        foreach ($arr as $k => $v) {
            array_push($buf, $k . '=' . $v);
        }

        return implode("&", $buf);

    }
}

if (!function_exists('pregMatch')) {
    /**
     * @param $pattern
     * @param $str
     * @return bool
     */
    function pregMatch($pattern, $str)
    {
        return preg_match($pattern, $str) ? true : false;
    }
}

if (!function_exists('mobileCheck')) {
    /**
     * @param $mobile
     * @return bool
     */
    function mobileCheck($mobile)
    {
        $isMobile = '/^1[3456789]{1}\d{9}$/';
        return preg_match($isMobile, $mobile) ? true : false;
    }
}

if (!function_exists('stringToArr')) {

    /**
     * string 转 stdObject
     * @param $json
     * @return mixed
     */
    function stringToArr($str)
    {
        $buf = json_decode($str, true);

        if (empty($buf) || !is_array($buf)) {
            return null;
        }

        return $buf;
    }
}

if (!function_exists('genSkey')) {
    /**
     * @return string
     */
    function genSkey()
    {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $randpwd = '';
        for ($i = 0; $i < 16; $i++) {
            $randpwd .= $chars[rand(0, strlen($chars) - 1)];
        }
        return $randpwd;
    }
}

if (!function_exists('strEnc')) {
    /**
     * @param $str
     * @return bool
     */
    function strEnc($str, $start, $len)
    {
        if (strlen($str) <= $len) {
            return '';
        }

        $buf = '';
        for ($i = 0; $i < $len; $i++) {
            $buf .= '*';
        }

        return substr($str, 0, $start) . $buf . substr($str, $start + $len);
    }
}