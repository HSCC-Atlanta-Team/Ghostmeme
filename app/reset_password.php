<?php require 'init.php';?>
<?php $page_title = 'Reset Password' ?>
<?php
    echo $twig->render('layouts/basic.layout.twig');
    use App\Database\User;
    $user = new User();

    if(isset($_SESSION['user']) || isset($_COOKIE['user'])){
        header('Location:' . $_ENV['BASE_URL']);
    }

    $user = new User();

    

?>

<div class="container mt-4">
         <h1 class="text-center"> Forgot Password </h1>
         <div class="container bg-light">
<?php

?>
<?php
    if(!$user->checkForgot($_GET['code'])) {
            $error = 'Invalid Link Please Try Again';
    }
    elseif($user->checkForgotPassCode($_GET['code'])){
        echo '<form action="reset_password.php?code=' . $_GET["code"] . '" method="post">
            <div class="row justify-content-center"> <!-- Start Row -->
                <div class="w-100"></div>
                 <div class="w-100"></div>
                 <div class="col-md-4 justify-content-center p-3">
                     <label for="password">Password</label>
                     <input type="password" placeholder="Enter New Password"class="form-control" id="password" name="password" minlength="10">
                 </div>
            </div>
            <div class="row justify-content-center"> <!-- Start Row -->
                <div class="w-100"></div>
                 <div class="w-100"></div>
                 <div class="col-md-4 justify-content-center">
                     <label for="password">Confirm Password</label>
                     <input type="password" placeholder="Confirm Password"class="form-control" id="password2" name="password2">
                 </div>
            </div>
            <div class="row justify-content-center">
                <div class="w-100"></div>
                    <div class="col-md-4 justify-content-center p-3">
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </div>
                <div class="w-100"></div>
            </div>';

        if(isset($_POST['submit'])) {
            if($_POST['password'] == null){
                $error = 'Please Enter A Passord';
            }elseif(strlen($_POST['password']) < 10){
                $error='Please Make Sure Your Password Is Atleast 10 Characters Long';
            }elseif(strcmp($_POST['password'], $_POST['password2'])){
                $error='Password and Confirm Password Do Not Match';
            }
            else{
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $user->resetPassword($_GET['code'], $password);
                $positive = 'Your Password Was Resetted';
                header('location: login.php?reset=confirmed');
            }
        }
    }

    if ($error) {
    echo '<div class="alert alert-danger">' . $error . '</div>';
    }
    if ($positive) {
        echo '<div class="alert alert-success">' . $positive . '</div>';
    }



       