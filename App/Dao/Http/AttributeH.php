<?php
/**
 * Created by PhpStorm.
 * User: machao
 * Date: 2019-08-01
 * Time: 18:55
 */

namespace App\Dao\Http;


use EasySwoole\Component\Singleton;

class AttributeH extends BaseH
{
    use Singleton;

    function __construct()
    {
        parent::__construct('mall');
    }

    public function attributeList() {
        $param = [
            'age' => 1,
            'size' => 10
        ];

        $res = $this->sendGet('attributeList', $param);

        return $res;
    }
}