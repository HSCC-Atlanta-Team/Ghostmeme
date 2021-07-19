<?php

use App\Database\Chat;

require __DIR__ . '/../../src/Database/Chat.php';

$chat = new Chat();

$chat_info = $chat->getChat($_SESSION['user']['id']);
?>
<div class="w3-sidebar w3-bar-block w3-animate-left bg-light" style="display:none;z-index:500000" id="mySidebar">
  <button class="w3-bar-item w3-button w3-black bg-light text-right text-dark" onclick="w3_close()">Close</button>

<?php
if(isset($_SESSION['user']) || isset($_COOKIE['user'])){
    foreach($chat_info as $value){
        echo '<div class="form-row">
        <a href="' .$_ENV['BASE_URL'] . '/users.php?user=' . $value['reciever_id'] . '#bottomOfPage' .'" class="lead ml-3">' . $value['reciever_username'].'</a>
        </div>';
    }
} else{
     echo '<div class="form-row">
        <a href="login.php" class="display-4 ml-3"> Please Login </a> 
        </div>';
}
?>
</div>
<div>
    <div class="w3-overlay w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" id="myOverlay"></div>
<button class="w3-button w3-xxlarge" onclick="w3_open()">&#9776;</button>
<div class="w3-container">
    <script>
    function w3_open() {
      document.getElementById("mySidebar").style.display = "block";
      document.getElementById("myOverlay").style.display = "block";
    }
    function w3_close() {
      document.getElementById("mySidebar").style.display = "none";
      document.getElementById("myOverlay").style.display = "none";
    }
    </script>
    </div>

