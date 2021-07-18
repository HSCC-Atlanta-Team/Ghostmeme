<?php require 'init.php';?>
<?php $page_title = 'Ghostmeme' ?>
<?php


    $error = NULL;
    if(!isset($_SESSION['user']) && !isset($_COOKIE['user'])){
        header('Location: ' . $_ENV['BASE_URL'] . '/login.php');
    }

    use GuzzleHttp\Client;
    use GuzzleHttp\Psr7\Request;
    use App\Database\User;
    $user = new User();

    if(isset($_GET['user'])){
        $user_info = $user->getUserWithUsername($_GET['user']);
        if(!$user_info){
            header('Location: ' . $_ENV['BASE_URL']);
        } elseif($user_info=='server'){
            $error = 'Something Went Wrong. Please Try Again Later';
        } elseif($user_info['user']['user_id'] == $_SESSION['user']['owner_id']){
            header('Location: ' . $_ENV['BASE_URL']);
        }
        else{
            $client = new Client(['base_uri' => $_ENV['API_BASE_URL'], 'http_errors' => false]);

            $response = $client->get('/v1/memes', ['headers' => ['key' => $_ENV['API_KEY'], 'Content-Type' => 'application/json',]]);
            
            $status = $response->getStatusCode();

            if($status == 200){
                $allMemes = json_decode($response->getBody(), true);
                //die(var_dump($allMemes));
            } elseif($status == 400){
                $error_info = json_decode($response->getBody(), true);
                $error = $error_info['errors'];
            } elseif($status == 555){
                $error = 'Something Went Wrong. Please Try Again Later';
            }
        }
    }
    ?>



<?php
if ($error) {
    echo '<div class="alert alert-danger">' . $error . '</div>';
}
if($allMemes){
    foreach(array_reverse($allMemes['memes']) as $value){
    //     echo '<div class="form-row justify-content-start" style="padding-left: 1.5%; padding-top: 2%">
    //     <div class="card" style="width: 18rem;">
    // <img class="card-img-top" src="' .$value['imageUrl'] .'" alt="Image Failed To Load">
    // <div class="card-body" style="background-color: #77fc4e">
    //     <p class="card-text">' . $value['description'].'</p>
    // </div>
    // </div>
    // </div>';
    // }
    if($value['owner'] == $_GET['user'] && $value['receiver'] == $_SESSION['user']['owner_id']){
                echo '<div class="form-row justify-content-start" style="padding-left: 1.5%; padding-top: 2%">
            <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="' .$value['imageUrl'] .'" alt="Image Failed To Load">
        <div class="card-body" style="background-color: #43CC47">
            <p class="card-text">' . $value['description'].'</p>
        </div>
        </div>
        </div>';
    }
    if($value['receiver'] == $_GET['user'] && $value['owner'] == $_SESSION['user']['owner_id']){
        echo '<div class="form-row justify-content-end" style="padding-right: 1.5%; padding-top: 2%">
            <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="' .$value['imageUrl'] .'" alt="Image Failed To Load">
        <div class="card-body" style="background-color: #1982FC">
            <p class="card-text">' . $value['description'].'</p>
        </div>
        </div>
        </div>';
    }
    
}
}
?>

<a name="bottomOfPage"></a>
