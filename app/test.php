<?php require __DIR__  . '/init.php'; ?>
<?php $page_title = 'Test' ?>
<?php

use App\Model\Meme;

// $base_url = $_ENV['API_BASE_URL'];


// $client = new Client(['base_uri' => $base_url]);
// // $response = $client->get('v1/users', ['headers' => ['key' => $_ENV['API_KEY'], 'content-type' => 'application/json']]);
// // $body = json_decode($response->getBody(), true);
// // var_dump($body['users']['0']);

// $body = json_encode([
//             "name" => "testtesttesttest",
//             "email" => "test@testtesttes.testtest",
//             "phone" => "312-665-5666",
//             "username" => "testtestesttest",
//             "imageBase64" => null,
//         ]);

// //die(var_dump($body));
// $response = $client->post('v1/users', ['body' => $body, 'headers' => ['key' => $_ENV['API_KEY'], 'Content-Type' => 'application/json',]]);
$params = ["owner" => "60ef0ca183a12100081befec",
    "receiver" => null,
    "expiredAt"=> 621894785097,
    "description"=> null,
    "private"=> false,
    "replyTo"=> null,
    "imageUrl"=> "https://media1.tenor.com/images/d591623c9a16e971268f60e375aa82de/tenor.gif",
    "imageBase64"=> null];


$memes = new Meme($params);
$response = $memes->createMeme();

die(var_dump($response));