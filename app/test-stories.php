<?php
require 'init.php';

$pageVariables = [
    'title' => 'Twig Templates',
];

echo $twig->render('stories.twig', $pageVariables);
?>