<?php
/**
 * Created by PhpStorm.
 * User: Jaackie
 * Date: 2017/8/23
 * Time: 15:46
 */
loadModel('user');

function indexAction()
{
    $id = get('id', 0, F_INT);

    $user = getUserById($id);
    if (!$user) {
        error('0:user not found!');
    }

    response(200, 'Hello ' . $user['username'] . '!', 'OK');
}