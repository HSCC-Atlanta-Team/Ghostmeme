<?php
require 'vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/templates');
$twigConfig = [];
if (getenv('PRODUCTION')) {
    $twigConfig['cache'] = __DIR__ . '/cache';
}
$twig = new \Twig\Environment($loader, $twigConfig);

/*
include_once $_ENV['BASE_DIRECTORY'] . '/web-assets/app_nav/header.php';
include_once $_ENV['BASE_DIRECTORY'] . '/web-assets/app_nav/footer.php';
include_once $_ENV['BASE_DIRECTORY'] . '/web-assets/app_nav/nav.php';
*/
session_start();
?>