<?php

class Product {
    public $Id;
    public $Name;
    public $Price;
    public $Category;
    public $Description;
    public $Image;
    public $Highlight;

    public function __construct($Id, $Name, $Price, $Category, $Description, $Image, $Highlight) {
        $this->Id = $Id;
        $this->Name = $Name;
        $this->Price = $Price;
        $this->Category = $Category;
        $this->Description = $Description;
        $this->Image = $Image;
        $this->Highlight = $Highlight;
    }
}

?>