<?php require 'init.php';?>
<?php $page_title = 'Sign Up' ?>
<?php include_once $_ENV['BASE_DIRECTORY'] . '/web-assets/app_nav/header.php'; ?>
<?php
    use App\Database\User;


    if(isset($_SESSION['user']) || isset($_COOKIE['user'])){
        header('Location:' . $_ENV['BASE_URL']);
    }

    $user = new User();
    $error = NULL;

        if(isset($_POST['submit'])){

            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

            if($_POST['first_name'] == null){
                $error = 'Please Enter Your First Name';
            } 
            elseif($_POST['last_name'] == null){
                $error='Please Enter Your Last Name';
            }
            elseif($_POST['email'] == NULL){
                $error='Please Enter Your Email';
            }
            elseif($_POST['password'] == null){
                $error='Please Enter Your Password';
            }
            elseif($_POST['password'] !== $_POST['password2']){
                $error='Password And Confirm Password Do Not Match';
            }
            elseif($user->checkEmail($_POST['email'])){
                $error = 'This Email Already Has An Account. Please Go And Login';
            }
            else{
                $user->signup($_POST['first_name'], $_POST['last_name'], $_POST['phone'] ?? null, $_POST['email'], $password);

            }
        }
?>

<html>
    <div class="jumbotron bg-light">
    <div class="container mx-auto">
        <h1 class="text-center md-4"> Create an Account </h1>
        <?php
        if ($error) {
            echo '<div class="alert alert-danger">'.$error.'</div>';
        }
        ?>
        <form action="signup.php" method="post">
            <div class="p-3 bg-white rounded shadow-sm border border-top-0 rounded-0">
<div class="form-row justify-content-center">
<div class="form-group col-md-4">
        <label for="">First Name</label>
    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name">
</div>
<div class="form-group col-md-4">
        <label for="">Last Name</label>
    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name">
</div>
</div>

<div class="form-row justify-content-center">
        <div class="form-group col-md-4">
    <label for="phone">Phone Number</label>
    <input type="tel" class="form-control" id="phone" name="phone" placeholder="Please Enter Your Phone Number">
</div>
<div class="form-group col-md-4">
        <label for="">Email</label>
    <input type="email" class="form-control" id="email" name="email" placeholder="Email">
</div>
</div>
        <div  class="form-row justify-content-center">
        <div class="form-group col-md-4">
    <label for="password">Password</label>
    <input type="password" minlength="10"  class="form-control" id="password" name="password" placeholder="Please Enter Your Password">
</div>
<div class="form-group col-md-4">
    <label for="password">Confirm Password</label>
    <input type="password" class="form-control" id="password2" name="password2" placeholder="Please Confirm Your Password">
</div>
</div>
<div  class="form-row justify-content-center">
<div class="form-group col-md-4">
<input type="file"
       id="propic" name="propic"
       accept="image/png, image/jpeg">
</div>
</div>
<div class='form-row justify-content-center '>
<button name="submit" type="submit" class='btn btn-primary col-md-7'> Sign Up </button>
</div>
<div class='form-group justify-content-center '>
        <a href = "<?=$_ENV['BASE_URL']?>/login.php"> Login </a>
</div>

