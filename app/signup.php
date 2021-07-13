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
            elseif(strcmp($_POST['password'], $_POST['password2'])){
                $error='Password And Confirm Password Do Not Match';
            }
            elseif($_POST['username'] == NULL){
                $error='Pleaase Enter Your Username';
            }
            elseif(strpos($_POST['username'], '@')){
                $error = 'Username Cannot Contain An @. Please Enter Another Username';
            }
            elseif(strlen($_POST['password']) < 10 ){
                $error = 'Password Is Too Weak. Make Sure It Is Atleast 10 Characters Long.';
            }
            elseif($user->checkEmail($_POST['email'])){
                $error = 'This Email Already Has An Account. Please Go And Login';
            }
            elseif($user->checkUsername($_POST['username'])){
                $error='This Username Already Exists. Please Choose A Different Username';
            }
            else{
                $user->signup($_POST['first_name'], $_POST['last_name'], $_POST['phone'] ?? null, $_POST['email'], $password, $_POST['username']);

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
        <div class="form-group col-md-8">
    <label for="username">Username</label>
    <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="<?=$_POST['username']?>">
</div>
</div>
<div class="form-row justify-content-center">
<div class="form-group col-md-4">
        <label for="">First Name</label>
    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" value="<?=$_POST['first_name']?>">
</div>
<div class="form-group col-md-4">
        <label for="">Last Name</label>
    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" value="<?=$_POST['last_name']?>">
</div>
</div>

<div class="form-row justify-content-center">
        <div class="form-group col-md-4">
    <label for="phone">Phone Number</label>
    <input type="tel" class="form-control" id="phone" name="phone" placeholder="Optional" value="<?=$_POST['phone']?>">
</div>
<div class="form-group col-md-4">
        <label for="">Email</label>
    <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?=$_POST['email']?>">
</div>
</div>
        <div  class="form-row justify-content-center">
        <div class="form-group col-md-4">
    <label for="password">Password</label>
    <input type="password" minlength="10"  class="form-control" id="password" name="password" placeholder="Please Enter Your Password" value="<?=$_POST['password']?>">
</div>
<div class="form-group col-md-4">
    <label for="password">Confirm Password</label>
    <input type="password" class="form-control" id="password2" name="password2" placeholder="Please Confirm Your Password" value="<?=$_POST['password2']?>">
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
