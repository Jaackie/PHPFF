<?php
/**
 * Created by PhpStorm.
 * User: Jaackie
 * Date: 2017/8/23
 * Time: 16:00
 */

/**
 * 返回结果
 * @param $code
 * @param $result
 * @param string $msg
 */
function responseJson($code, $result = [], $msg = '')
{
    echo json_encode(['code' => $code, 'result' => $result, 'msg' => $msg], JSON_UNESCAPED_UNICODE);
}