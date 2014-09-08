<?php

require '../vendor/autoload.php';
require '../lib/ImageFactory.php';

$app = new \Slim\Slim();
$factory = new ImageFactory('../data/tumblr.json');

$app->get('/images/random', function () use ($app, $factory) {
    $url = $app->urlFor('images', array('id' => $factory->getRandomId()));

    $app->redirect($url);
});

$app->get('/images/:id', function ($id) use ($app, $factory) {
    if (is_numeric($id)) {
        $id = intval($id);
    }

    $image = $factory->getImage($id);

    $app->response->headers->set('Content-Type', $image->getContentType());

    echo $image->getFile();
})->name('images');

$app->run();