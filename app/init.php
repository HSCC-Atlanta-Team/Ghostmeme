<?php
// Composer autoload
require 'vendor/autoload.php';

// Initialize Dotenv library
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// initialize Twig template engine
$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/templates');
$twigConfig = [];

// If we're in production env, use cache
if ($_ENV['PRODUCTION'] === true) {
    $twigConfig['cache'] = __DIR__ . '/cache';
} else {
    // if not production, use debug extension
    $twigConfig['debug'] = true;
}

$twig = new \Twig\Environment($loader, $twigConfig);
$twig->addExtension(new \Twig\Extension\DebugExtension());

// start a session
session_start();

// add our Dotenv variables to the Twig 'ENV' variable
$twig->addGlobal('ENV', $_ENV);
// add our Dotenv variables to the Twig 'ENV' variable
$twig->addGlobal('SESSION', $_SESSION);


?>
