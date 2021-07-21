<?php
require 'init.php';

$template = $twig->load('test.tpl');
echo $template->render(['title' => 'Twig Template']);
?>