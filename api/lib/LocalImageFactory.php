<?php

require_once '../lib/ImageFactoryInterface.php';
require_once '../lib/Image.php';

class LocalImageFactory implements ImageFactoryInterface {

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