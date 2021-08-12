<?php require 'init.php';?>
<?php $page_title = 'Ghostmeme' ?>
<?php

                

    echo $twig->render('test.twig');

    if(!isset($_SESSION['user']) && !isset($_COOKIE['user'])){
        header('Location:' . $_ENV['BASE_URL'] . '/spotlight.php');
    }else {
        header('Location: stories.php');
    }

    #

