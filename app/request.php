<?php
/**
 * Created by PhpStorm.
 * User: Jaackie
 * Date: 2017/8/31
 * Time: 10:09
 */

/**
 * 整数过滤
 */
const F_INT = 1;
/**
 * 字符串过滤
 */
const F_STRING = 2;
/**
 * 非空过滤
 */
const F_NOT_EMPTY = -1;


/**
 * @param $key
 * @param null $default
 * @param array $filters
 * @return int|string
 */
function post($key, $default = null, $filters = [])
{
    $value = isset($_POST[$key]) ? $_POST[$key] : $default;

    return filters($value, $filters);
}

/**
 * @param $key
 * @param null $default
 * @param array $filters
 * @return int|string
 */
function get($key, $default = null, $filters = [])
{
    $value = isset($_GET[$key]) ? $_GET[$key] : $default;

    return filters($value, $filters);
}

/**
 * @param $key
 * @param null $default
 * @param array $filters
 * @return int|string
 */
function server($key, $default = null, $filters = [])
{
    $key = 'HTTP_' . str_replace('-', '_', strtoupper($key));
    $value = isset($_SERVER[$key]) ? $_SERVER[$key] : $default;

    return filters($value, $filters);
}

/**
 * @return mixed
 */
function getRequestUri()
{
    return $_SERVER['PHP_SELF'] ?: $_SERVER['REQUEST_URI'];
}

/**
 * 过滤集合
 * @param $value
 * @param array $filters
 * @return int|string
 * @throws runException
 */
function filters($value, $filters = [])
{
    if (!$filters) return $value;

    if (is_array($filters)) {
        foreach ($filters as $filter) {
            $value = filter($value, $filter);
        }
    } else {
        $value = filter($value, $filters);
    }

    return $value;
}


/**
 * @param $value
 * @param $filter
 * @return int|string
 * @throws runException
 */
function filter($value, $filter)
{
    switch ($filter) {
        case F_INT:
            $value = intval($value);
            break;
        case F_STRING:
            $value = strval($value);
            break;
        case F_NOT_EMPTY:
            if (empty($value)) {
                ee('请求参数错误!', -1);
            }
            break;
    }
    return $value;
}