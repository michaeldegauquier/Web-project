<?php

class Category {
    public $Id;
    public $Category;

    public function __construct($Id, $Category) {
        $this->Id = $Id;
        $this->Category = $Category;
    }
}

?>