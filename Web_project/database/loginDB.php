<?php
session_start();

include_once 'UserDB.php';

// controle of cookie bestaat, als cookie bestaat halen we de email uit de database voor in session te steken
if(isset($_COOKIE['user']) && !empty($_COOKIE['user']) && !isset($_SESSION['loggedIn']) && empty($_SESSION['loggedIn'])) {
    $email = UserDB::getEmailByCookie($_COOKIE['user']);
    $_SESSION['loggedIn'] = $email[0]->Email;

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
                        <a class="nav-link active" href="loginDB.php"> Sign in </a>
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
include_once 'UserDB.php';

$email = "";
$password = "";
$remember = "";
$hashEmail = "";

// Variabele voor validatie
$valid = true;

// Array waar alle errors in komen
$errors = [
    "loginEmail" => "",
    "loginPassword" => "",
    "loginIncorrect" => ""
];

// Array waar alle default waarden in komen die correct zijn
$values = [
    "loginEmail" => ""
];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    if(isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn'])) {
        header('location:../index.php');
    }
    else {
        // Als formulier niet ingevuld is
        include '../login.php';
    }
}
else {
    if (empty($_POST['loginEmail'])) {
        $errors['loginEmail'] = "This field is required!";
    } else {
        $description = $_POST['loginEmail'];
        $values['loginEmail'] = $_POST['loginEmail'];
        $email = $_POST['loginEmail'];
    }

    if (empty($_POST['loginPassword'])) {
        $errors['loginPassword'] = "This field is required!";
    } else {
        $description = $_POST['loginPassword'];
        $password = $_POST['loginPassword'];
    }

    if (isset($_POST['remember'])) {
        $remember = 1;
    } else {
        $remember = 0;
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
        include '../login.php';
    } else {
        if (UserDB::getUser($email, $password) == false) {
            $errors['loginIncorrect'] = '<p class="alert alert-danger" style="margin: auto; text-align: center; width: 26%">E-mail or password is incorrect!</p> <br>';
            include '../login.php';
        }
        else {
            $_SESSION['loggedIn'] = $email;

            if($remember == 1) {
                $hashEmail = hash('sha256', $email);

                // 60*60 = 3600 seconden, 3600*24 = 86400 seconden = 1 dag, 1 * 30 = 30 dagen
                setcookie('user', $hashEmail, time()+60*60*24*30, '/');

                UserDB::updateUserCookie($hashEmail, $email);
            }

            header('location:../index.php');
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


<!--
// Stackoverflow. php sessions with remember me. Geraadpleegd via
// https://stackoverflow.com/questions/12091951/php-sessions-login-with-remember-me
// Geraadpleegd op 27 december 2018

// Php. setcookie. Geraapleegd via
// http://php.net/manual/en/function.setcookie.php
// Geraadpleegd op 28 december 2018

// Bavotasan. Making Cookies with PHP. Geraapleegd via
// https://bavotasan.com/2010/making-cookies-with-php/
// Geraadpleegd op 28 december 2018
-->
