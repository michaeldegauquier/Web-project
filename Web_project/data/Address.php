<?php

class Address {
    public $Id;
    public $UserEmail;
    public $StreetName;
    public $HouseNumber;
    public $City;
    public $PostalCode;

    public function __construct($Id, $UserEmail, $StreetName, $HouseNumber, $City, $PostalCode) {
        $this->Id = $Id;
        $this->UserEmail = $UserEmail;
        $this->StreetName = $StreetName;
        $this->HouseNumber = $HouseNumber;
        $this->City = $City;
        $this->PostalCode = $PostalCode;
    }
}

?>