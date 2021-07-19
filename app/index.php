<?php require 'init.php';?>
<?php $page_title = 'Ghostmeme' ?>
<?php

    if(!isset($_SESSION['user']) && !isset($_COOKIE['user'])){
        header('Location:' . $_ENV['BASE_URL'] . '/login.php');
    }


    use App\Database\User;
    $user = new User();



    if(isset($_GET['search'])){
        $user_info = $user->getUserWithUsername($_GET['search']);

        if($user_info == 'server'){
            $error = 'Something Is Wrong. Please Try Again Later';
        } elseif(!$user_info){
            $error = 'No User Found';
        } else{
            //var_dump($user_info);
        }

    }

?>
<div class="container md-4">
         <div class="container bg-light">
             <?php
if ($error) {
    echo '<div class="alert alert-danger">' . $error . '</div>';
}

if(isset($user_info)){
    echo
'<ul class="list-group col-md-7">
  <a href="users.php?user=' . $user_info["user"]["user_id"] ."#bottomOfPage". '"class="list-group-item">' . $user_info["user"]["username"] . '</a>
</ul>';
}
