<?php
require 'init.php';

use App\Api\Meme;

$pageVariables = [
    'title' => 'Twig Templates',
];

echo $twig->render('test.twig', $pageVariables);



?>