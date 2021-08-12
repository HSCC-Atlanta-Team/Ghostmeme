<?php

include 'init.php';

use App\Database\User;

echo $twig->render('layouts/basic.layout.twig');

$user = new User();     
if (!isset($_SESSION['user']) && !isset($_COOKIE['user'])) {
    header('Location:' . $_ENV['BASE_URL'] . '/login.php');
}



if (isset($_POST['submit'])) {
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    if ($_POST["password"] == null) {

        $error = "Please Enter a Password";

} elseif(!$user->login($_SESSION['user']['email'], $password, null)) {
    $error = "Invalid Password";
}

}

 ?>

<html>


<!--<form action="" method="post">
    <label for="Username">New Username</label>
    <input type="text" name="Username" placeholder="Username">
    <label for="Email">New Email</label>
    <input type="email" name="Email" placeholder="example@example.com">
    <label for="Phone Number">New Phone Number</label>
    <input type="tel" name="Phone Number" pattern='[0-9]{3}-[0-9]{3}-[0-9]{4}' placeholder="Phone Number">
    <label for="pwd">Password</label>
    <input type="password" name="pwd" placeholder=''     
</form>
-->

<!-- Button trigger modal 

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-backdrop="static" data-keyboard="false">
  Password 
</button>
 Modal 
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="test.php" method="post">
        <label for="password">Password</label>
        <input type="text" name="password">
    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <submit class="btn btn-primary">Submit</submit>
        </form>
      </div>
    </div>
  </div>
</div>
-->
<?php
        if ($error) {
            echo '<div class="alert alert-danger">'.$error.'</div>';
        }
        ?>

<div class="form-row justify-content-center">
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
  Password
</button>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Ghostmeme</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="message" action="" method="post">
            <div class="form-row p-1">
                 <input type="password" name="password" placeholder="password">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button name="submit" type="submit" id="message" class="btn btn-primary">Submit</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div> 

</html>
 


    