<?php

require '../vendor/autoload.php';

$app = new \Slim\Slim();

$app->get('/random', function () use ($app) {
    $base = 'http://localhost/lampjavel-api/public/img/';
    $files = scandir('img/');

    $app->response->setStatus(400);
    $app->response->setBody($base . $files[mt_rand(2, count($files) - 1)]);
});

$app->run();