<?php
require 'vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

include_once $_ENV['BASE_DIRECTORY'] . '/web-assets/app_nav/header.php';
include_once $_ENV['BASE_DIRECTORY'] . '/web-assets/app_nav/footer.php';
include_once $_ENV['BASE_DIRECTORY'] . '/web-assets/app_nav/nav.php';

session_start();
?>