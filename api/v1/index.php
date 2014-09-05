<?php

require '../vendor/autoload.php';
require_once '../lib/LocalImageFactory.php';
require_once '../lib/RemoteImageFactory.php';

$app = new \Slim\Slim();
//$factory = new LocalImageFactory('../../public/img/');
$factory = new RemoteImageFactory();

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