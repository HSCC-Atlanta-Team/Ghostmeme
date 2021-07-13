<?php require 'init.php';?>
<?php $page_title = 'Forgot Password' ?>
<?php
    use App\Database\User;
    $user = new User();

    if(isset($_SESSION['user']) || isset($_COOKIE['user'])){
        header('Location:' . $_ENV['BASE_URL']);
    }

    $user = new User();

    if(isset($_POST['submit'])){
        if($_POST['email'] == null){
            $error='Please Enter Your Email';
        }
        elseif(!$user->checkEmail($_POST['email'])){
            $error='This Email Is Not Connected To An Account. Please Create Your Account';
        }
        else{
            $link = $user->forgotPassword($_POST['email']);
            $positive = 'An Email Was Sent To Your Email Address. Click On The Link And Reset Your Password';
            echo '<script>';
            echo 'console.log('. json_encode( $link ) .')';
            echo '</script>';
        }
    }
?>

<div class="container mt-4">
         <h1 class="text-center"> Forgot Password </h1>
         <div class="container bg-light">
             <?php
if ($error) {
    echo '<div class="alert alert-danger">' . $error . '</div>';
}
if ($positive) {
    echo '<div class="alert alert-success">' . $positive . '</div>';
}
?>
       <form action="forgot_password.php" method="post">
            <div class="row justify-content-center"> <!-- Start Row -->
                <div class="w-100"></div>
                 <div class="w-100"></div>
                 <div class="col-md-4 justify-content-center p-3">
                     <label for="email">Email</label>
                     <input type="text" placeholder="Enter Email"class="form-control" id="email" name="email" value="<?=$_POST['email']?>">
                 </div>
            </div>
            <div class="row justify-content-center">
                <div class="w-100"></div>
                    <div class="col-md-4 justify-content-center">
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </div>
                <div class="w-100"></div>
            </div>