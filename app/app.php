<?php
/**
 * Created by PhpStorm.
 * User: Jaackie
 * Date: 2017/8/23
 * Time: 10:05
 */

include_once ROOT . '/app/loader.php';
loadApp('tool');
loadApp('router');
loadApp('exception');
loadApp('response');
loadApp('request');

/**
 * 运行app
 * @param string|null $uri
 */
function app($uri = null)
{
    runInfo('---------new app----------');
    runBefore();
    run($uri);
    runAfter();
}

/**
 * app运行前
 */
function runBefore()
{
    runInfo('run before');
}

/**
 * app运行时
 * @param null $uri
 */
function run($uri = null)
{
    runInfo('running...');
    $uri = $uri == null ? getRequestUri() : $uri;
    $route = getRoute($uri);

    try {
        if (!is_dir(MODULES . '/' . $route['module'])) {
            ee('unknown module');
        }
        loadController($route['controller'], $route['module']);
        $action = $route['action'] . 'Action';
        if (!function_exists($action)) {
            ee('unknown action');
        }
        call_user_func($action);
    } catch (runException $e) {
        $e->response();
    }
}

/**
 * app运行后
 */
function runAfter()
{
    runInfo('run after');
}

/**
 * 运行信息调试
 * @param $msg
 */
function runInfo($msg)
{
    ff($msg, 'run info');
}

