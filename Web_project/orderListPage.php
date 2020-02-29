<?php
session_start();

include_once 'database/UserDB.php';

// controle of cookie bestaat, als cookie bestaat halen we de email uit de database voor in session te steken
if(isset($_COOKIE['user']) && !empty($_COOKIE['user']) && !isset($_SESSION['loggedIn']) && empty($_SESSION['loggedIn'])) {
    $email = UserDB::getEmailByCookie($_COOKIE['user']);
    $_SESSION['loggedIn'] = $email[0]->Email;
}

if(!isset($_SESSION['loggedIn']) && empty($_SESSION['loggedIn'])) {
    header('location:index.php');
}

if ($_SESSION['loggedIn'] !== 'admin@hotmail.com') {
    header('location:index.php');
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
                <li class="nav-item">
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
                        <a class="nav-link active" href="orderListPage.php"> All Orders </a>
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

<h1 class="text-center">Overview of all Orders</h1>

<hr/>

<h5 style="text-align: center;">Filter on Customer:</h5>

<select class="form-control" style="width: 25%; margin: auto" id="customers" name="customers" class="filter" required>
    <option>None</option>

    <?php
    include_once 'database/UserDB.php';
    $allUsers = UserDB::getUserEmail();
    foreach ($allUsers as $allUser) {
        ?>
        <option><?php echo $allUser->Email; ?></option>
        <?php
    }
    ?>

</select>

<br/>

<div class="container">
    <table class="tableOrder">
        <tr class="trOrder">
            <th class="thOrder">Customer E-mail</th>
            <th class="thOrder">Product</th>
            <th class="thOrder">Order Date</th>
            <th class="thOrder">Billing Address</th>
            <th class="thOrder">Delivery Address</th>
            <th class="thOrder">Delivery Method</th>
            <th class="thOrder">Payment Method</th>
        </tr>

            <?php
            include_once 'database/OrderDB.php';
            $allOrders = OrderDB::getAllOrders();
            foreach ($allOrders as $allOrder) {
                ?>

                <tr class="trOrder filter" id="<?php echo $allOrder->UserEmail; ?>">
                    <td class="tdOrder" id="useremail"><?php echo $allOrder->UserEmail; ?></td>
                    <td class="tdOrder"><?php echo $allOrder->ProductName; ?></td>
                    <td class="tdOrder"><?php echo $allOrder->OrderDate; ?></td>
                    <td class="tdOrder"><?php echo $allOrder->StreetName1; ?> <?php echo $allOrder->HouseNumber1; ?> - <?php echo $allOrder->PostalCode1; ?> <?php echo $allOrder->City1; ?></td>
                    <td class="tdOrder"><?php echo $allOrder->StreetName2; ?> <?php echo $allOrder->HouseNumber2; ?> - <?php echo $allOrder->PostalCode2; ?> <?php echo $allOrder->City2; ?></td>
                    <td class="tdOrder"><?php echo $allOrder->DeliveryMethod; ?></td>
                    <td class="tdOrder"><?php echo $allOrder->PaymentMethod; ?></td>
                </tr>

                <?php
            }
            ?>

    </table>
</div>

<br/>

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<!-- JS files -->
<script src="js/filterOrdersOnEmail.js" type="text/javascript"></script>

</body>
</html>
