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

$captcha=['dragonfruit'=>'_9f4h399uytrtyuio98uytr.jpg',
    'orange'=>'_joi0dbg45owplttu2vbm.png',
    'pineapple'=>'_39hgwz10mrktkgui.png',
    'apple'=>'_30htif3biw2bbsjwtfr35weut8fh.png',
    'grapes'=>'_ke1dnvevtfrdc676dcr7.jpg',
    'tomato'=>'_8rhwdq0u4039nhfp0t59.png'];
    
?>

