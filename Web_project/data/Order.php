<?php

class Order {
    public $Id;
    public $UserEmail;
    public $ProductName;
    public $OrderDate;

    //Billing address
    public $BillingAddressId;
    public $StreetName1;
    public $HouseNumber1;
    public $City1;
    public $PostalCode1;

    //Delivery address
    public $DeliveryAddressId;
    public $StreetName2;
    public $HouseNumber2;
    public $City2;
    public $PostalCode2;

    public $DeliveryMethod;
    public $PaymentMethod;

    public function __construct($Id, $UserEmail, $ProductName, $OrderDate, $BillingAddressId, $StreetName1, $HouseNumber1, $City1, $PostalCode1,
                                $DeliveryAddressId, $StreetName2, $HouseNumber2, $City2, $PostalCode2, $DeliveryMethod, $PaymentMethod) {
        $this->Id = $Id;
        $this->UserEmail = $UserEmail;
        $this->ProductName = $ProductName;
        $this->OrderDate = $OrderDate;
        //Billing address
        $this->BillingAddressId = $BillingAddressId;
        $this->StreetName1 = $StreetName1;
        $this->HouseNumber1 = $HouseNumber1;
        $this->City1 = $City1;
        $this->PostalCode1 = $PostalCode1;
        //Delivery address
        $this->DeliveryAddressId = $DeliveryAddressId;
        $this->StreetName2 = $StreetName2;
        $this->HouseNumber2 = $HouseNumber2;
        $this->City2 = $City2;
        $this->PostalCode2 = $PostalCode2;
        $this->DeliveryMethod = $DeliveryMethod;
        $this->PaymentMethod = $PaymentMethod;
    }
}

?>