<?php

require_once '../lib/ImageFactoryInterface.php';
require_once '../lib/Image.php';

class RemoteImageFactory implements ImageFactoryInterface {

    private $_images;
    private $_url;

    public function __construct() {
        $this->_url = 'http://hallkaftenlampjavel.tumblr.com/';

        $this->scan();
    }

    public function getImage($id) {
        return new Image($this->_images[$id]);
    }

    public function getRandomImage() {
        return $this->getImage(mt_rand(0, count($this->_images) - 1));
    }

    private function scan() {
        $html = file_get_contents($this->_url . 'page/' . mt_rand(0, 38));
        preg_match_all('/<div class="stat-media-wrapper"><a [^>]+><img src="([^"]+)" alt=""/', $html, $matches);
        $this->_images = $matches[1];
    }

}