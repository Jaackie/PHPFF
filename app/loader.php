<?php
/**
 * Created by PhpStorm.
 * User: Jaackie
 * Date: 2017/8/23
 * Time: 11:18
 */

define('APP', ROOT . '/app');
define('MODULES', ROOT . '/modules');

/**
 * 动态载入脚本
 * @param $filename
 * @return bool
 */
function load($filename)
{
    $file = '/' . $filename . '.php';
    if (is_file($file)) {
        include_once $file;
        return true;
    }
    return false;
}

/**
 * 载入app部分文件
 * @param $filename
 */
function loadApp($filename)
{
    load(APP . '/' . $filename);
}

/**
 * 载入控制器
 * @param $controllerName
 * @param $module
 * @throws runException
 */
function loadController($controllerName, $module)
{
    if (!load(MODULES . '/' . $module . '/controllers/' . $controllerName)) {
        ee('unknown controller');
    }
}