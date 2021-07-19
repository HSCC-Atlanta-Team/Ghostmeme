<?php require 'init.php';?>
<?php $page_title = 'Test' ?>
<?php

use App\Model\Meme;


$meme_info = [
    'owner' => '60f203599250410008724135',
    'reciever' => NULL,
    'description' => 'this is a test',
    'imageUrl' => 'https://api.memegen.link/images/buzz/memes/memes_everywhere.png',
];





$meme = new Meme($meme_info);

die(var_dump($meme->createMeme()));