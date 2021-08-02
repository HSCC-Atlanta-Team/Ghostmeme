<?php require 'init.php';?>
<?php $page_title = 'Ghostmeme' ?>
<?php

                

    echo $twig->render('test.twig');

    if(!isset($_SESSION['user']) && !isset($_COOKIE['user'])){
        header('Location:' . $_ENV['BASE_URL'] . '/login.php');
    }

    header('Location: stories.php');

