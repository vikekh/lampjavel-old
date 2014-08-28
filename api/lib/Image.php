<?php

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