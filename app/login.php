<?php require 'init.php';?>
<?php $page_title = 'Login' ?>
<?php include_once $_ENV['BASE_DIRECTORY'] . '/web-assets/app_nav/header.php'; ?>
<?php

    if(isset($_SESSION['user']) || isset($_COOKIE['user'])){
        header('Location:' . $_ENV['BASE_URL']);
    }

    use App\Database\User;
    $user = new User();

    if(isset($_POST['submit'])){
        if($_POST['email'] == NULL){
            $error='Please Enter Your Email';
        }
        elseif($_POST['password'] == NULL){
            $error='Please Enter Your Password';
        }
        if(!$user->login($_POST['email'], $_POST['password'], $_POST['remmemberPass'])){
          $error='Email And Password Do Not Match'; 
        } else{
            header('Location:' . $_ENV['BASE_URL']);
        }
        
    }
?>


<div class="container mt-4">
         <h1 class="text-center"> Log In </h1>
         <div class="container bg-light">
             <?php
if ($error) {
    echo '<div class="alert alert-danger">' . $error . '</div>';
}
?>
       <form action="login.php" method="post">
            <div class="row justify-content-center"> <!-- Start Row -->
                <div class="w-100"></div>
                 <div class="w-100"></div>
                 <div class="col-md-4 justify-content-centerr">
                     <label for="email">Email</label>
                     <input type="email" class="form-control" id="email" name="email">
                 </div>
                 <div class="w-100"></div>
                 <div class="col-md-4 justify-content-center">
                     <label for="password">Password</label>
                     <input type="password" class="form-control" id="password" name="password">
                 </div>
                 <div class="w-100"></div>
                 <div class="col-md-4 justify-content-center">
                     <div class="form-check">
                         <input class="form-check-input" type="checkbox" id="gridCheck" value = 'remmemberPass' name="remmemberPass">
                         <label class="form-check-label" for="gridCheck">
                             Remember Password
                         </label>
                     </div>
                 </div>
                 <div class="w-100"></div>
                 <div class="col-md-4 justify-content-center">

                 <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="w-100"></div>
            </div> <!-- End Row -->
        </form>

         </div>
     </div>