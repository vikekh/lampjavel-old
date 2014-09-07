<?php

require '../lib/Image.php';

class ImageFactory {

    private $_images;

    public function __construct($path) {
        $this->_images = json_decode(file_get_contents($path));
    }

    public function getImage($id) {
        return new Image($this->_images[$id]);
    }

    public function getNumberOfImages() {
        return count($this->_images);
    }

}