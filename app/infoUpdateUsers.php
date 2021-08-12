<?php

include 'init.php';

use App\Database\User;

echo $twig->render('layouts/basic.layout.twig');

$user = new User();     
if (!isset($_SESSION['user']) && !isset($_COOKIE['user'])) {
    header('Location:' . $_ENV['BASE_URL'] . '/login.php');
}
$modal = true;

if(isset($_POST['change_submit'])){
  $error = $user->editUserInfo($_SESSION['user']['owner_id'],$_POST['phone'], $_POST['email'], $_POST['password']);
}

if (isset($_POST['submit'])) {
    //$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    if ($_POST["password"] == null) {
        $error = "Please Enter a Password";
    } elseif(!$user->checkUserPassword($_SESSION['user']['owner_id'], $_POST['password'])) {
        $error = "Invalid Password";
    } else{
        echo '
        <form action="" method="post">
<div class="form-row justify-content-center">
        <div class="form-group col-md-4">
    <label for="phone">Phone Number</label>
    <input type="text" pattern="[0-9]{10}" oninvalid="setCustomValidity("Please Enter A Valid Phone Number (10 Digits No Hyphen)")" onchange="try{setCustomValidity("")}catch(e){}" class="form-control" id="phone" name="phone" placeholder="123-456-7890"">
</div>
</div>
<div class="form-row justify-content-center">
<div class="form-group col-md-4">
        <label for="email">Email</label>
    <input type="email" class="form-control" id="email" name="email" placeholder="Email"">
</div>
</div>
</div>
        <div  class="form-row justify-content-center">
        <div class="form-group col-md-4">
    <label for="password">Password</label>
    <input type="password" minlength="10"  class="form-control" id="password" name="password" placeholder="Please Enter Your Password"">
</div>
</div>
<div class="form-row justify-content-center ">
<button name="change_submit" type="submit" class="btn btn-primary col-md-4">Update</button>
</div>
</form>';
$modal = false;
    }

}

 ?>

<html>





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

if($modal){
echo'<div class="form-row justify-content-center">
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

</html>';
}


    