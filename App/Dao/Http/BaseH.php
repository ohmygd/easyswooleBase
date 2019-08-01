<?php
/**
 * Created by PhpStorm.
 * User: machao
 * Date: 2019-08-01
 * Time: 18:34
 */

namespace App\Dao\Http;

use App\Exception\PEx;
use App\Model\Json\RespJson;
use EasySwoole\EasySwoole\Config;
use EasySwoole\HttpClient\HttpClient;

class BaseH
{
    protected $url;

    protected $list;

    protected $client;

    function __construct(string $app)
    {
        $config = Config::getInstance()->getConf('HTTP_INFO')[$app] ?? null;
        if (empty($config)) {
            throw new PEx(ERROR_HTTP_CONFIG);
        }

        $this->url = $config['url'];

        $this->list = $config['list'];

        $this->client = new HttpClient();
    }

    private function getUrl($uriAlias) {
        $uri = $this->list[$uriAlias] ?? null;
        if (empty($uri)) {
            throw new PEx(ERROR_HTTP_CONFIG);
        }

        return $this->url . $this->list[$uriAlias];
    }

    protected function sendGet(string $uri, array $params): ?array {
        $url = $this->getUrl($uri);

        $url .= $this->getToParam($params);

        $this->client->setUrl($url);

        $resp = $this->client->get()->getBody();

        $resp = new RespJson(json_decode($resp, true));

        if (empty($resp)) {
            throw new PEx(ERROR_HTTP_POSTGET);
        }

        if ($resp->getCode() != ERROR_OK) {
            throw new PEx(ERROR_HTTP_POSTGET, $resp->getMsg());
        }

        return $resp->getData();
    }

    protected function sendPost(string $uri, array $params): ?array {
        $url = $this->getUrl($uri);

        $this->client->setUrl($url);
        $resp = $this->client->postJson($params)->getBody();

        $resp = new RespJson($resp);
        if (empty($resp)) {
            throw new PEx(ERROR_HTTP_POSTGET);
        }

        if ($resp->getCode() != ERROR_OK) {
            throw new PEx(ERROR_HTTP_POSTGET, $resp->getMsg());
        }

        return $resp->getData();
    }

    private function getToParam(array $array) {
        if (count($array)) {
            return '';
        }

        $arr = [];
        foreach($array as $k => $v) {
            array_push($arr, $k.'='.$v);
        }

        return implode('&', $arr);
    }


}