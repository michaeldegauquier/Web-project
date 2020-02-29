<?php
session_start();

include_once '../database/UserDB.php';

// controle of cookie bestaat, als cookie bestaat halen we de email uit de database voor in session te steken
if(isset($_COOKIE['user']) && !empty($_COOKIE['user']) && !isset($_SESSION['loggedIn']) && empty($_SESSION['loggedIn'])) {
    $email = UserDB::getEmailByCookie($_COOKIE['user']);
    $_SESSION['loggedIn'] = $email[0]->Email;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Michael's WebShop</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <!-- Material icons Google Web fonts -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Layout -->
    <link rel="stylesheet" href="../css/layout.css" type="text/css">
</head>

<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="../index.php">Michael's WebShop</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="../index.php"> Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../productPage.php"> Products </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="mail.php"> Contact us </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../database/shoppingCartDB.php"> Shopping Cart (<?php if (isset($_SESSION['productIds'])) { echo count($_SESSION['productIds']); } else { echo 0; } ?>) </a>
                </li>
                <?php
                if(isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn'])) {
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="../orderListUserPage.php"> Your Orders </a>
                    </li>
                    <?php
                }
                ?>
                <?php
                if(isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === 'admin@hotmail.com' ) {
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="../orderListPage.php"> All Orders </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="../database/addProductDB.php"> Add Product </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="../database/addCategoryDB.php"> Add Category </a>
                    </li>

                    <?php
                }
                ?>
                <?php
                if(isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn'])) {
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="../database/logoutDB.php"> Sign out </a>
                    </li>
                    <?php
                } else {
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="../database/loginDB.php"> Sign in </a>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </nav>
</header>

<body>

<?php

$message = "";
$from = "";
$firstname = "";
$lastname = "";

// Variabele voor validatie
$valid = true;

// Array waar alle errors in komen
$errors = [
    "firstname" => "",
    "lastname" => "",
    "email" => "",
    "message" => ""
];

// Array waar alle default waarden in komen die correct zijn
$values = [
    "firstname" => "",
    "lastname" => "",
    "email" => "",
    "message" => ""
];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // Als formulier niet ingevuld is
    include '../contactPage.php';
}
else {
    // Valideer alle data
    if (empty($_POST['message'])) {
        $errors['message'] = "This field is required!";
    } else {
        $message = $_POST['message'];
        $values['message'] = $_POST['message'];
    }

    if (empty($_POST['email'])) {
        $errors['email'] = "This field is required!";
    } else {
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Invalid email format!";
        } else {
            $from = $_POST['email'];
            $values['email'] = $_POST['email'];
        }
    }

    if (empty($_POST['firstname'])) {
        $errors['firstname'] = "This field is required!";
    } else {
        if (!preg_match("/^[a-zA-Z ]*$/",$_POST['firstname'])) {
            $errors['firstname'] = "First name should only contain letters!";
        } else {
            $firstname = $_POST['firstname'];
            $values['firstname'] = $_POST['firstname'];
        }
    }

    if (empty($_POST['lastname'])) {
        $errors['lastname'] = "This field is required!";
    } else {
        if (!preg_match("/^[a-zA-Z ]*$/",$_POST['lastname'])) {
            $errors['lastname'] = "Last name should only contain letters";
        } else {
            $lastname = $_POST['lastname'];
            $values['lastname'] = $_POST['lastname'];
        }
    }

    // Als er nog errors zijn, zet de variabele $valid op false
    foreach($errors as $error) {
        if(!empty($error)) {
            $valid = false;
            break;
        }
    }

    // Als het formulier niet valid is wordt formulier terug getoond met foutboodschappen
    if(!$valid) {
        include '../contactPage.php';
    } else {
        $to = "michael.de.gauquier@gmail.com";
        $subject = "Form";
        $name = $firstname. ' '.$lastname;
        $headers = "From: ". $from;

        mail($to,$subject,$message,$headers);

        header('location:mail.php?message=send');
    }
}
?>

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<!-- JS files -->
<script src="../js/shoppingCartButtonShow.js" type="text/javascript"></script>

</body>
</html>

<!--
// Php. Mail function. Geraadpleegd via
// http://php.net/manual/en/function.mail.php
// Geraadpleegd op 24 december 2018

// W3schools. PHP FILTER_VALIDATE_EMAIL Filter. Geraadpleegd via
// https://www.w3schools.com/php/filter_validate_email.asp
// Geraadpleegd op 25 december 2018
-->