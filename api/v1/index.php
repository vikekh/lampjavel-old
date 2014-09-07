<?php

require '../vendor/autoload.php';
require '../lib/ImageFactory.php';

$app = new \Slim\Slim();
$factory = new ImageFactory('../data/remote.json');

$app->get('/images/:id', function ($id) use ($app, $factory) {
    if ($id === 'random') {
        $id = mt_rand(0, $factory->getNumberOfImages() - 1);

        $app->redirect($app->urlFor('images', array('id' => $id)));
    }

    if (is_numeric($id)) {
        $id = intval($id);
    }

    $image = $factory->getImage($id);

    $app->response->headers->set('Content-Type', $image->getContentType());

    echo $image->getFile();
})->name('images');

$app->run();