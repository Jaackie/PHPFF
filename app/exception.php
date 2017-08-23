<?php

/**
 * Created by PhpStorm.
 * User: Jaackie
 * Date: 2017/8/23
 * Time: 15:00
 */
class runException extends Exception
{
    public function response()
    {
        responseJson($this->getCode(), [], $this->getMessage());
    }
}