<?php
require_once 'init.php';
use App\Model\Meme;

header('Content-Type: application/json');

switch ($_GET['action']) {
    case 'addMessage':
        addMessage();
        break;
}

function addMessage()
{
    if ($_POST['image'] == NULL && $_POST['description'] == NULL) {
        $error = "Both Description And Image Can't Be Empty";
        die(json_encode(['error' => $error]));
    } else {
        $body = [
            'owner' => $_SESSION['user']['owner_id'],
            'reciever' => $_GET['user'],
            'description' => $_POST['description'],
            'private' => true,
            'imageUrl' => $_POST['image']
        ];

        //die(var_dump($body));

        $meme = new Meme($body);
        $response = $meme->createMeme();
        if($response['error'] ?? null){
            die(json_encode(['error' => $response['error']]));
        } elseif($response == 'server'){
            die(json_encode(['error' => "Something Went Wrong. Please Try Again Later."]));
        }else{
            die(json_encode($response));
        }
    }
}
