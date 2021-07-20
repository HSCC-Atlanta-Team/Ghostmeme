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


<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
