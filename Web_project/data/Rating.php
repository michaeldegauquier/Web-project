<?php

class Rating {
    public $Id;
    public $ProductId;
    public $UserEmail;
    public $Rating;
    public $Feedback;
    public $Date;
    public $Firstname;
    public $Lastname;

    public function __construct($Id, $ProductId, $UserEmail, $Rating, $Feedback, $Date, $Firstname, $Lastname) {
        $this->Id = $Id;
        $this->ProductId = $ProductId;
        $this->UserEmail = $UserEmail;
        $this->Rating = $Rating;
        $this->Feedback = $Feedback;
        $this->Date = $Date;
        $this->Firstname = $Firstname;
        $this->Lastname = $Lastname;
    }
}

?>