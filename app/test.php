<?php require __DIR__  . '/init.php'; ?>
<?php $page_title = 'Flights' ?>
<?php include_once $_ENV['BASE_DIRECTORY'] . '/web-assets/app_nav/header.php'; ?>
<?php

use App\Database\User;



$user = new User();

$user->login('test', 'test', TRUE);
