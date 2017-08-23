<?php
/**
 * Created by PhpStorm.
 * User: Jaackie
 * Date: 2017/8/23
 * Time: 10:32
 */

/**
 * 打印输出
 * @param $data
 * @param null $title
 * @param bool $exist
 */
function dd($data, $title = null, $exist = false)
{
    $is_cli = isCli();
    echo $is_cli ? "----------$title----------\n" : "$title:<br/><pre>";

    var_export($data);

    echo $is_cli ? "\n" : "</pre>";
    if ($exist) {
        exit();
    }
}

/**
 * 文件输出
 * @param $data
 * @param null $title
 * @param bool $exist
 */
function ff($data, $title = null, $exist = false)
{
    $title = $title ? $title . ':' : date('[Y-m-d H:i:s]');

    $data = is_array($data) ? json_encode($data, JSON_UNESCAPED_UNICODE) : $data;
    $data = sprintf("%s %s\n", $title, $data);
    file_put_contents('/tmp/ff.log', $data, FILE_APPEND);
    if ($exist) {
        exit();
    }
}

/**
 * 意外
 * @param $msg
 * @param int $code
 * @throws Exception
 */
function ee($msg, $code = 0)
{
    throw new runException($msg, $code);
}

/**
 * 是否命令行客户端
 * @return bool
 */
function isCli()
{
    static $is_cli;
    if ($is_cli === null) {
        $is_cli = php_sapi_name() == 'cli';
    }
    return $is_cli;
}

/**
 * 循环时间调试
 * @param callable $call
 * @param int $times
 * @param array $params
 */
function loopTime(callable $call, $times = 1000, $params = [])
{
    $t = microtime(1);
    for ($i = 0; $i < $times; $i++) {
        call_user_func_array($call, $params);
    }
    dd(sprintf("%.3f", (microtime(1) - $t) * 1000), 'run time');
}