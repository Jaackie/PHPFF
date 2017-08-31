<?php
/**
 * Created by PhpStorm.
 * User: Jaackie
 * Date: 2017/8/23
 * Time: 16:00
 */

const RESPONSE_HTML = 'html';
const RESPONSE_JSON = 'json';
const RESPONSE_CLI = 'cli';

function responseTypes()
{
    return [RESPONSE_HTML => 'text/html', RESPONSE_JSON => 'application/json', RESPONSE_CLI => 'text/html'];
}

function responseTypeDefault()
{
    return RESPONSE_HTML;
}

function responseType()
{
    static $response_type;

    if (!$response_type) {
        $response_type = server('response-type');
        if (!isset(responseTypes()[$response_type])) {
            $response_type = isCli() ? RESPONSE_CLI : responseTypeDefault();
        }
    }

    return $response_type;
}

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

/**
 * @param $code
 * @param array $result
 * @param string $msg
 */
function responseHtml($code, $result = [], $msg = '')
{
    dd($code . ':' . $msg, 'code');
    dd($result, 'result');
}

/**
 * @param $code
 * @param array $result
 * @param string $msg
 */
function responseCli($code, $result = [], $msg = '')
{
    dd($code . ':' . $msg, 'code');
    dd($result, 'result');
}

function error($codeMsg, $result = [])
{
    list($code, $msg) = explode(':', $codeMsg, 2);
    response($code, $result, $msg);
}

/**
 * @param $code
 * @param array $result
 * @param string $msg
 * @return bool
 */
function response($code, $result = [], $msg = '')
{
    $type = responseType();
    header('Content-Type:' . responseTypes()[$type]);
    switch ($type) {
        case RESPONSE_HTML:
            responseHtml($code, $result, $msg);
            break;
        case RESPONSE_JSON:
            responseJson($code, $result, $msg);
            break;
        case RESPONSE_CLI:
            responseCli($code, $result, $msg);
            break;
    }
    return false || exit();
}