<?php
require 'init.php';

use App\Api\Meme;

$pageVariables = [
    'title' => 'Story View',
];

$meme = new Meme();
$memes = $meme->searchMemes(['private' => false]); 
$data = json_decode($memes->getBody()->getContents(), true);
$pageVariables['memes'] = $data['memes'];
$pageVariables['nowTime'] = time() * 1000;
echo $twig->render('stories.twig', $pageVariables);
?>