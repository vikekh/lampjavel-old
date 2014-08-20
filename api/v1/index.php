<?php

require '../vendor/autoload.php';

class Image {

    private $_image;

    public function __construct($path) {
        $this->_image = file_get_contents($path);
    }

    public function getContentType() {
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        return $finfo->buffer($this->_image);
    }

    public function getFile() {
        return $this->_image;
    }

}

class ImageFactory {

    private $_images;
    private $_path;

    public function __construct($path) {
        $this->_path = $path;

        $this->scan();
    }

    public function getImage($id) {
        return new Image($this->_path . $this->_images[$id]);
    }

    public function getRandomImage() {
        return $this->getImage(mt_rand(0, count($this->_images) - 1));
    }

    private function scan() {
        $this->_images = array_slice(scandir($this->_path), 2);
    }

}

$app = new \Slim\Slim();
$imageFactory = new ImageFactory('../../public/img/');

$app->get('/random', function () use ($app, $imageFactory) {
    $image = $imageFactory->getRandomImage();

    $app->response->header('Content-Type', 'content-type: ' . $image->getContentType());

    echo $image->getFile();
});

$app->run();