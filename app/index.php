<?php require 'init.php';?>
<?php $page_title = 'Ghostmeme' ?>
<?php

                

    echo $twig->render('test.twig');

    if(!isset($_SESSION['user']) && !isset($_COOKIE['user'])){
        header('Location:' . $_ENV['BASE_URL'] . '/login.php');
    }


    use App\Database\User;
    use App\Database\Chat;
    $user = new User();
    $chat = new Chat();



    if(isset($_GET['search'])){
        $user_info = $user->getUserWithUsername($_GET['search']);

        if($user_info == 'server'){
            $error = 'Something Is Wrong. Please Try Again Later';
        } elseif(!$user_info){
            $error = 'No User Found';
        }

    }


if(isset($user_info)){
    //die(var_dump($_SESSION['user']));
    if($user_info['user']['user_id'] !== $_SESSION['user']['owner_id']){   
        if(isset($_SESSION['user'])){
            $chat->createChat($_SESSION['user']['id'], $user_info['user']['user_id'], $user_info['user']['username']);
        } elseif(isset($_COOKIE['user'])){
            $chat->createChat($_COOKIE['user']['id'], $user_info['user']['user_id'], $user_info['user']['username']);
        }
        
        echo
        '<ul class="list-group col-md-7">
        <a href="users.php?user=' . $user_info["user"]["user_id"] ."#bottomOfPage". '"class="list-group-item">' . $user_info["user"]["username"] . '</a>
        </ul>';
    } else{
        $error = 'No User Found';
    }
}
?>
<div class="container md-4">
         <div class="container bg-light">
             <?php
if ($error) {
    echo '<div class="alert alert-danger">' . $error . '</div>';
}


