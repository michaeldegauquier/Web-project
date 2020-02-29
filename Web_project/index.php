<?php
    session_start();

    include_once 'database/UserDB.php';

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
    <link rel="stylesheet" href="css/layout.css" type="text/css">
</head>

<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">Michael's WebShop</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php"> Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="productPage.php"> Products </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="mail/mail.php"> Contact us </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./database/shoppingCartDB.php"> Shopping Cart (<?php if (isset($_SESSION['productIds'])) { echo count($_SESSION['productIds']); } else { echo 0; } ?>) </a>
                </li>
                <?php
                if(isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn'])) {
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="orderListUserPage.php"> Your Orders </a>
                    </li>
                    <?php
                }
                ?>
                <?php
                    if(isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === 'admin@hotmail.com' ) {
                ?>
                    <li class="nav-item">
                        <a class="nav-link" href="orderListPage.php"> All Orders </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="./database/addProductDB.php"> Add Product </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="./database/addCategoryDB.php"> Add Category </a>
                    </li>

                <?php
                }
                ?>
                <?php
                    if(isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn'])) {
                ?>
                    <li class="nav-item">
                        <a class="nav-link" href="database/logoutDB.php"> Sign out </a>
                    </li>
                <?php
                    } else {
                ?>
                    <li class="nav-item">
                        <a class="nav-link" href="database/loginDB.php"> Sign in </a>
                    </li>
                <?php
                }
                ?>
            </ul>
        </div>
    </nav>
</header>

<body>

<br/>

<?php if (isset($_GET['logout']) && $_GET['logout'] == 'true') { ?>

    <p class="alert alert-success" style="margin: auto; text-align: center; width: 85%">You are successfully logged out!</p> <br>

<?php } ?>

<?php if (isset($_GET['order']) && $_GET['order'] == 'true') { ?>

    <p class="alert alert-success" style="margin: auto; text-align: center; width: 85%">Your products are successfully ordered!</p> <br>

<?php } ?>

<h1 class="text-center">Welcome to my Webshop!</h1>

<hr/>

<h1 class="text-center">Highlighted Products</h1>

<hr/>

<div class="container">
    <div class="card-deck">
        <div class="row">
            <?php
                include_once './database/ProductDB.php';
                $hlProducts = ProductDB::getHighlightedProducts();
                foreach ($hlProducts as $hlProduct) {
            ?>
            <div class="card border-secondary mb-3" style="width: 18rem; margin: auto; margin-left: 1%; text-align: center;">
                <?php echo '<img class="card-img-top" src="data:Image/jpg;base64,' . base64_encode($hlProduct->Image) . '" />'; ?>

                <a href="" class="btn btn-info btn-lg shopping-cart-btn hideButton" id="<?php echo $hlProduct->Id; ?>">
                    <i class="material-icons">shopping_cart</i> Add to Shopping Cart
                </a>

                <div class="card-body">
                    <h5 class="card-title"><b><?php echo $hlProduct->Name; ?></b></h5>
                    <p class="card-text">
                    <p><b>Category:</b> <?php echo $hlProduct->Category; ?></p>
                    <p><b>Price:</b> € <?php echo $hlProduct->Price; ?></p>
                </div>
                <div class="card-footer">
                    <a class="btn btn-primary" style="width: 100%" href="database/addRatingToProduct.php?productId=<?php echo $hlProduct->Id ?>" >More info</a>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>

<hr/>

<h1 class="text-center">Latest Products</h1>

<hr/>

<div class="container">
    <div class="card-deck">
        <div class="row">
            <?php
            include_once './database/ProductDB.php';
            $laProducts = ProductDB::getLatestProducts();
            foreach ($laProducts as $laProduct) {
                ?>
                <div class="card border-secondary mb-3" style="width: 18rem; margin: auto; margin-left: 1%; text-align: center;">
                    <?php echo '<img class="card-img-top" src="data:Image/jpg;base64,' . base64_encode($laProduct->Image) . '" />'; ?>

                    <a href="" class="btn btn-info btn-lg shopping-cart-btn hideButton" id="<?php echo $laProduct->Id; ?>">
                        <i class="material-icons">shopping_cart</i> Add to Shopping Cart
                    </a>

                    <div class="card-body">
                        <h5 class="card-title"><b><?php echo $laProduct->Name; ?></b></h5>
                        <p class="card-text">
                        <p><b>Category:</b> <?php echo $laProduct->Category; ?></p>
                        <p><b>Price:</b> € <?php echo $laProduct->Price; ?></p>
                    </div>
                    <div class="card-footer">
                        <a class="btn btn-primary" style="width: 100%" href="database/addRatingToProduct.php?productId=<?php echo $laProduct->Id ?>" >More info</a>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>

<br/>

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<!-- JS files -->
<script src="js/shoppingCartButtonShow.js" type="text/javascript"></script>
</body>
</html>

<!--
// Bootstrap. Navbar. Geraadpleegd via
// https://getbootstrap.com/docs/4.0/components/navbar/
// Geraadpleegd op 23 december 2018

// Bootstrap. Cards. Geraadpleegd via
// https://getbootstrap.com/docs/4.0/components/card/
// Geraadpleegd op 23 december 2018

// Rizwan Shamsher. PHP display image BLOB from MySQL. Geraadpleegd via
// https://stackoverflow.com/questions/20556773/php-display-image-blob-from-mysql
// Geraadpleegd op 24 december 2018

// Bootstrap. Buttons. Geraadpleegd via
// https://getbootstrap.com/docs/4.0/components/buttons/
// Geraadpleegd op 24 december 2018

// Bootstrap. Forms. Geraadpleegd via
// https://v4-alpha.getbootstrap.com/components/forms/
// Geraadpleegd op 24 december 2018

// Material. Icons. Geraadpleegd via
// https://material.io/tools/icons/?icon=assignment_turned_in&style=baseline
// Geraadpleegd op 24 december 2018
-->