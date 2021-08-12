<?php
require_once __DIR__ . '/../init.php';
use App\Model\Meme;

header('Content-Type: application/json');

switch ($_GET['action']) {
    case 'addMessage':
        addMessage();
        break;
}

function addMessage()
{   
    //die(json_encode(['error' =>$_POST['post']]));
    //echo 'I am in addMessage method';
    //die(json_encode(['success' => true 'owner' => 'test']));
    // if($_GET['image'] !== null && $_POST['post'] !== NULL){
    //     die(json_encode(['error' => 'You Cant Have Both Image Url and A File']));
    // }
    if ($_GET['image'] == NULL && $_GET['description'] == NULL && $_POST == NULL) {
        $error = "Both Description And Image Can't Be Empty";
        die(json_encode(['error' => $error]));
    } else {
        if($_GET['description']){
        $body = [
            'owner' => $_SESSION['user']['owner_id'],
            'reciever' => $_GET['user'],
            'description' => $_GET['description'],
            'private' => true,
            'imageUrl' => $_GET['image'],
            'imageBase64' => $_POST['post'],
        ];
        } else {
            $body = [
                'owner' => $_SESSION['user']['owner_id'],
                'reciever' => $_GET['user'],
                'description' => NULL,
                'private' => true,
                'imageUrl' => $_GET['image'],
                'imageBase64' => $_POST['post'],
            ];
        }
        //die(json_encode(['error' => $_POST['post']]));

        //die(json_encode(['user' => $body]));

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
