

<?php
use App\Api\Users;

$users = new Users();

//$response = $users->createUser('bob howser', 'bob@test.com', 'bobhows2', '404-555-1212');
$response = $users->getUser('610335dc55e3bbb0fd5a9580');
var_dump($response->getBody()->getContents());

