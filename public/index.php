<?php
/**
 * Created by PhpStorm.
 * User: Jaackie
 * Date: 2017/8/23
 * Time: 9:59
 */
define('ROOT', dirname(__DIR__));

require_once ROOT . '/app/app.php';

app($argv[1]);
