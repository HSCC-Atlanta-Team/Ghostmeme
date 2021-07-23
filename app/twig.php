<?php
require 'init.php';

$pageVariables = [
    'title' => 'Twig Templates',
];

echo $twig->render('test.twig', $pageVariables);
?>