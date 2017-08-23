<?php
/**
 * Created by PhpStorm.
 * User: Jaackie
 * Date: 2017/8/23
 * Time: 11:34
 */


/**
 * 获取路由
 * @param $uri
 * @return mixed
 */
function getRoute($uri = null)
{
    static $route;
    if (!$route) {
        $route = router($uri);
    }
    return $route;
}

/**
 * 路由解析
 * @param $uri
 * @return array
 */
function router($uri)
{
    runInfo('router');
    $uri_arr = explode('/', substr($uri, 0, 1) == '/' ? substr($uri, 1) : $uri);

    if (count($uri_arr) > 3) {
        $row_params = array_slice($uri_arr, 3);
        $c = count($row_params);
        for ($i = 0; $i < $c; $i += 2) {
            $_GET[$row_params[$i]] = $row_params[$i + 1];
        }
    }
    $m = $uri_arr[0] ?: 'index';
    $c = $uri_arr[1] ?: 'index';
    $a = $uri_arr[2] ?: 'index';
    return [
        'module' => $m,
        'controller' => $c,
        'action' => $a,
        'uri' => "/$m/$c/$a",
    ];
}