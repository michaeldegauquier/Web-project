<?php
session_start();

include_once 'UserDB.php';

// controle of cookie bestaat, als cookie bestaat halen we de email uit de database voor in session te steken
if(isset($_COOKIE['user']) && !empty($_COOKIE['user']) && !isset($_SESSION['loggedIn']) && empty($_SESSION['loggedIn'])) {
    $email = UserDB::getEmailByCookie($_COOKIE['user']);
    $_SESSION['loggedIn'] = $email[0]->Email;
}

if(!isset($_SESSION['loggedIn']) && empty($_SESSION['loggedIn'])) {
    header('location:../index.php');
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
                <li class="nav-item">
                    <a class="nav-link" href="../mail/mail.php"> Contact us </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="shoppingCartDB.php"> Shopping Cart (<?php if (isset($_SESSION['productIds'])) { echo count($_SESSION['productIds']); } else { echo 0; } ?>) </a>
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
                        <a class="nav-link" href="addProductDB.php"> Add Product </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="addCategoryDB.php"> Add Category </a>
                    </li>
                    <?php
                }
                ?>
                <?php
                if(isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn'])) {
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="logoutDB.php"> Sign out </a>
                    </li>
                    <?php
                } else {
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="loginDB.php"> Sign in </a>
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
$_SESSION['billingaddress'] = "";
$_SESSION['deliveryaddress'] = "";
$_SESSION['deliverymethod'] = "";
$_SESSION['paymentmethod'] = "";

$billingaddress = 0;
$deliveryaddress = 0;
$usedeliveryaddress = 0;
$deliverymethod = "";
$paymentmethod = "";
$terms = 0;

// Variabele voor validatie
$valid = true;

// Array waar alle errors in komen
$errors = [
    "billingaddress" => "",
    "deliveryaddress" => "",
    "terms" => ""
];

if(!isset($_SESSION['loggedIn']) || empty($_SESSION['loggedIn']) || !isset($_SESSION['productIds']) || empty($_SESSION['productIds'])) {
    header('location:../index.php');
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // Als formulier niet ingevuld is
    include '../addOrderPage.php';
}
else {
    if (empty($_POST['billingaddress'])) {
        $errors['billingaddress'] = "This field is required!";
    } else {
        $billingaddress = $_POST['billingaddress'];
    }

    if (isset($_POST['usedeliveryaddress'])) {
        $usedeliveryaddress = 1;
    } else {
        $usedeliveryaddress = 0;
    }

    if($usedeliveryaddress == 1) {
        if (empty($_POST['deliveryaddress'])) {
            $errors['deliveryaddress'] = "This field is required!";
        } else {
            $deliveryaddress = $_POST['deliveryaddress'];
        }
    }
    else {
        $deliveryaddress = $billingaddress;
    }

    $deliverymethod = $_POST['deliverymethod'];
    $paymentmethod = $_POST['paymentmethod'];

    if (isset($_POST['terms'])) {
        $terms = 1;
    } else {
        $terms = 0;
        $errors['terms'] = "You have to accept terms & conditions!";
    }

    foreach($errors as $error) {
        if(!empty($error)) {
            $valid = false;
            break;
        }
    }

    // Als het formulier niet valid is wordt formulier terug getoond met foutboodschappen
    if(!$valid) {
        include '../addOrderPage.php';
    } else {
        $_SESSION['billingaddress'] = $billingaddress;
        $_SESSION['deliveryaddress'] = $deliveryaddress;
        $_SESSION['deliverymethod'] = $deliverymethod;
        $_SESSION['paymentmethod'] = $paymentmethod;

        header('location:confirmOrderDB.php');
    }
}


?>

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

</body>
</html>
