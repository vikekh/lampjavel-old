<?php

require '../vendor/autoload.php';

$app = new \Slim\Slim();

$app->get('/random', function () use ($app) {
    $images = scandir('img/');
    $random = mt_rand(2, count($images) - 1);
    $image = file_get_contents('img/' . $images[$random]);
    $finfo = new finfo(FILEINFO_MIME_TYPE);

    $app->response->header('Content-Type', 'content-type: ' . $finfo->buffer($image));

    echo $image;
});

$app->run();