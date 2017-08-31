<?php
/**
 * Created by PhpStorm.
 * User: Jaackie
 * Date: 2017/8/31
 * Time: 15:21
 */

/**
 * @param $userId
 * @return array
 */
function getUserById($userId)
{
    $users = [
        1 => ['user_id' => 1, 'username' => 'jaackie1', 'age' => 26],
        2 => ['user_id' => 2, 'username' => 'jaackie2', 'age' => 27],
        3 => ['user_id' => 3, 'username' => 'jaackie3', 'age' => 28],
        4 => ['user_id' => 4, 'username' => 'jaackie4', 'age' => 29],
        5 => ['user_id' => 5, 'username' => 'jaackie5', 'age' => 20],
    ];

    return isset($users[$userId]) ? $users[$userId] : [];
}