<?php

class Fighter {

    protected $_type;

    public function __construct($str) {
       $this->_type = $str;
    }

    public function getType() {
        return $this->_type;
    }
}

?>