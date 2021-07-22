<?php require 'init.php';?>
<?php $page_title = 'Test' ?>
<?php

// use App\Model\Meme;


// $meme_info = [
//     'owner' => '60f203599250410008724135',
//     'reciever' => NULL,
//     'description' => 'this is a test',
//     'imageUrl' => 'https://api.memegen.link/images/buzz/memes/memes_everywhere.png',
// ];





// $meme = new Meme($meme_info);

// die(var_dump($meme->createMeme()));
?>

<h1> <?=$_POST['test']?>

<div class="form-row">
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
  Launch demo modal
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
        <form action='' method="post">
          <input type="text" name='test'>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">Submit</button>
        <form>
      </div>
    </div>
  </div>
</div>