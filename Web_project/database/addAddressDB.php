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
                <li class="nav-item">
                    <a class="nav-link active" href="shoppingCartDB.php"> Shopping Cart (<?php if (isset($_SESSION['productIds'])) { echo count($_SESSION['productIds']); } else { echo 0; } ?>) </a>
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
include_once 'AddressDB.php';

$email = $_SESSION['loggedIn'];
$streetname = "";
$housenumber = "";
$city = "";
$postalcode = "";

// Variabele voor validatie
$valid = true;

// Array waar alle errors in komen
$errors = [
    "streetname" => "",
    "housenumber" => "",
    "city" => "",
    "postalcode" => ""
];

// Array waar alle default waarden in komen die correct zijn
$values = [
    "streetname" => "",
    "housenumber" => "",
    "city" => "",
    "postalcode" => ""
];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // Als formulier niet ingevuld is
    include '../addAddressPage.php';
}
else {
    if (empty($_POST['streetname'])) {
        $errors['streetname'] = "This field is required!";
    } else {
        if (!preg_match("/^[a-zA-Z ]*$/",$_POST['streetname'])) {
            $errors['streetname'] = "The street name should only contain letters!";
        } else {
            $streetname = $_POST['streetname'];
            $values['streetname'] = $_POST['streetname'];
        }
    }

    if (empty($_POST['housenumber'])) {
        $errors['housenumber'] = "This field is required!";
    } else {
        $housenumber = $_POST['housenumber'];
        $values['housenumber'] = $_POST['housenumber'];
    }

    if (empty($_POST['city'])) {
        $errors['city'] = "This field is required!";
    } else {
        if (!preg_match("/^[a-zA-Z ]*$/",$_POST['city'])) {
            $errors['city'] = "The city should only contain letters!";
        } else {
            $city = $_POST['city'];
            $values['city'] = $_POST['city'];
        }
    }

    if (empty($_POST['postalcode'])) {
        $errors['postalcode'] = "This field is required!";
    } else {
        $postalcode = $_POST['postalcode'];
        $values['postalcode'] = $_POST['postalcode'];
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
        include '../addAddressPage.php';
    } else {
        if(AddressDB::getAddressByInput($streetname, $housenumber, $_SESSION['loggedIn']) == true) {
            $errors['streetname'] = "The street name and house number already exists!";
            include '../addAddressPage.php';
        }
        else {
            $address = new Address(0, $email, $streetname, $housenumber, $city, $postalcode);

            AddressDB::insertAddress($address);

            header('location:addAddressDB.php?address=added');
        }
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
