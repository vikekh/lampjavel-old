<?php

require '../vendor/autoload.php';
require '../lib/Image.php';
require '../lib/ImageFactory.php';

$app = new \Slim\Slim();
$factory = new ImageFactory('../../public/img/');

$app->get('/images/random', function () use ($app, $factory) {
    $image = $factory->getRandomImage();

    $app->response->headers->set('Content-Type', $image->getContentType());

    echo $image->getFile();
});

$app->get('/images/:id', function ($id) use ($app, $factory) {
    $image = $factory->getImage($id);

    $app->response->headers->set('Content-Type', $image->getContentType());

    echo $image->getFile();
});

$app->run();