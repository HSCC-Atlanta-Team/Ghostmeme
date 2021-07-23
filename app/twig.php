<?php
require 'init.php';

$pageVariables = [
    'title' => 'Twig Templates',
];

$twig->addGlobal('test', 'ok');

echo $twig->render('test.twig', $pageVariables);
?>