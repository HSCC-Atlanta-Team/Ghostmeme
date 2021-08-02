<?php

require_once 'init.php';

use App\Api\Users;
use App\Model\User;
use App\Model\ApiModelFactory;
use App\Model\ApiResultSetFactory;

$api = new Users();

$users = ApiResultSetFactory::createFromApiResponse(
    $api->getUsers(),
    User::class,
    'users'
);

$first = $users[0];

$user = ApiModelFactory::createFromApiResponse(
    $api->getUser($first->getUserId()),
    User::class,
    'user'
);

echo $twig->render('users.twig', ['first_user' => $user, 'users' => $users]);
