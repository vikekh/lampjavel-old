<?php

require '../vendor/autoload.php';

$app = new \Slim\Slim();

$app->get('/foo', function () {
    $app->response->setStatus(400);
    $app->response->setBody('Foo');
});

$app->run();