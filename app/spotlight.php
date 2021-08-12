<?php
require 'init.php';

use App\Api\Meme;

#$error = "test";
$pageVariables = [
    'title' => 'Spotlight View',
];

$meme = new Meme();
$memes = $meme->searchMemes(['private' => false]);
$data = json_decode($memes->getBody()->getContents(), true);

    $pageVariables['memes'] = $data['memes'] ?? [];
    $pageVariables['nowTime'] = time() * 1000;
    echo $twig->render('spotlights.twig', $pageVariables);

if($data['error']){
    $error = 'Something Went Wrong Please try Again Later';
}
?>

<?php
if ($error) {
    echo '<div class="alert alert-danger">' . $error . '</div>';
}
?>
