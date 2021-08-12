<?php require 'init.php'; ?>
<?php $page_title = 'Sign Up' ?>
<?php

use App\Database\User;

echo $twig->render('layouts/basic.layout.twig');

if (isset($_SESSION['user']) || isset($_COOKIE['user'])) {
    header('Location:' . $_ENV['BASE_URL']);
}

$user = new User();
$error = NULL;

if (isset($_POST['submit'])) {
    //die(var_dump($_FILES));
    $path = $_FILES['propic']['tmp_name'];
    $type = pathinfo($path, PATHINFO_EXTENSION);
    $data = file_get_contents($path);
    $base64 = 'data:image/jpeg' . ';base64,' . base64_encode($data);

    //die(var_dump($base64));
    $fruit = $_POST['captcha'];
    $answer = $_POST['answer'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    if ($captcha[$fruit] != $answer) {
        $error='🧙‍♂️Thou cannot refute that ye failed the riddle of fruits!🧙‍♂️)';
    }


    if ($_POST['first_name'] == null) {
        $error = 'Please Enter Your First Name';
    } elseif ($_POST['last_name'] == null) {
        $error = 'Please Enter Your Last Name';
    } elseif ($_POST['email'] == NULL) {
        $error = 'Please Enter Your Email';
    } elseif ($_POST['password'] == null) {
        $error = 'Please Enter Your Password';
    } elseif (strcmp($_POST['password'], $_POST['password2'])) {
        $error = 'Password And Confirm Password Do Not Match';
    } elseif ($_POST['username'] == NULL) {
        $error = 'Please Enter Your Username';
    } elseif (strlen($_POST['username']) > 11) {
        $error = 'Make Sure Your Username is Less Than or Equal To 11 Characters Long.';
    } elseif (!ctype_alpha($_POST['username'])) {
        $error = 'Please Make Sure Your Username Doesnt Have Any Numbers Or Special Charecters';
    } elseif ($_FILES['propic'] == NULL) {
        $error = 'Please Select A Profile Picture';
    } elseif (strpos($_POST['username'], '@')) {
        $error = 'Username Cannot Contain An @. Please Enter Another Username';
    } elseif (strlen($_POST['password']) < 10) {
        $error = 'Password Is Too Weak. Make Sure It Is Atleast 10 Characters Long.';
    } elseif ($user->checkEmail($_POST['email'])) {
        $error = 'This Email Already Has An Account. Please Go And Login';
    } elseif ($user->checkUsername($_POST['username'])) {
        $error = 'This Username Already Exists. Please Choose A Different Username';
    } else {
        $numbers = explode("\n", $_POST['phone']);


        foreach ($numbers as $number) {
            $data = preg_replace('~.*(\d{3})[^\d]{0,7}(\d{3})[^\d]{0,7}(\d{4}).*~', '$1-$2-$3', $number) . "\n";
        }
        $phone = substr($data, 0, -1);

        if (!$error) {
            $error_report = $user->signup($_POST['first_name'], $_POST['last_name'], $phone, $_POST['email'], $password, $_POST['username'], $base64);
        } else {
        }
        if ($error_report) {
            $error = $error_report;
        } else {
            header('location: login.php?signup=confirmed');
        }
    }
}
?>
<?php



?>

<html>
    <div class="jumbotron">
    <div class="container mx-auto">
        <h1 class="text-center md-4"> Create an Account </h1>
        <?php
        if ($error) {
            echo '<div class="alert alert-danger">' . $error . '</div>';
        }
        ?>
        <form action="signup.php" method="post" enctype="multipart/form-data">
            <div class="p-3 bg-white rounded shadow-sm border border-top-0 rounded-0">
                <div class="form-row justify-content-center">
                    <div class="form-group col-md-8">
                        <label for="username">Username</label>
                        <input type="text" maxlength='11' class="form-control" id="username" name="username" placeholder="Username" value="<?= $_POST['username'] ?>">
                    </div>
                </div>
                <div class="form-row justify-content-center">
                    <div class="form-group col-md-4">
                        <label for="">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" value="<?= $_POST['first_name'] ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" value="<?= $_POST['last_name'] ?>">
                    </div>
                </div>

                <div class="form-row justify-content-center">
                    <div class="form-group col-md-4">
                        <label for="phone">Phone Number</label>
                        <input type="text" pattern="[0-9]{10}" oninvalid="setCustomValidity('Please Enter A Valid Phone Number (10 Digits No Hyphen)')" onchange="try{setCustomValidity('')}catch(e){}" class="form-control" id="phone" name="phone" placeholder="123-456-7890 *Optional " value="<?= $_POST['phone'] ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?= $_POST['email'] ?>">
                    </div>
                </div>
                <div class="form-row justify-content-center">
                    <div class="form-group col-md-4">
                        <label for="password">Password</label>
                        <input type="password" minlength="10" class="form-control" id="password" name="password" placeholder="Please Enter Your Password" value="<?= $_POST['password'] ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="password">Confirm Password</label>
                        <input type="password" class="form-control" id="password2" name="password2" placeholder="Please Confirm Your Password" value="<?= $_POST['password2'] ?>">
                    </div>
                </div>
                <div class="form-row justify-content-center">
                    <div class="form-group col-md-4">
                        <input type="file" id="propic" name="propic" accept="image/png, image/jpeg, image/gif">
                    </div>
                    <!-- <input type="hidden" id="base64profile"> -->
                </div>

                <?php
                include 'captcha.php';
                ?>
            </div>
            <div class='form-row justify-content-center '>
                <button name="submit" type="submit" class='btn btn-primary col-md-7'> Sign Up </button>
            </div>
            <!-- <script>
    //base64
    setInterval(function basicsteefor(){
    if($('#propic')[0].files[0]){
            $('#base64profile').value=getBase64($('#propic')[0].files[0]);
        }
    }
    ,200)

    function getBase64(file) {
   var reader = new FileReader();
   reader.readAsDataURL(file);
   reader.onload = function () {
      
     console.log(reader.result);
     
   };
   reader.onerror = function (error) {
     console.log('Error: ', error);
   };
}
    $('.captcha .grid-item').on('click', function (event) {
          var filename = $(event.target).attr('data-filename');
          $('#answer').val(filename);
    });
</script> -->