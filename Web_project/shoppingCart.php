<br/>

<h1 class="text-center">Shopping Cart</h1>

<hr/>

<?php
if(isset($_SESSION['productIds']) && !empty($_SESSION['productIds'])) {
?>

<div class="container" style="margin: auto; ">
    <table class="tableOrder" style="margin: auto; width: 70%;">
        <tr>
            <th class="thOrder">Image</th>
            <th class="thOrder">Product Name</th>
            <th class="thOrder">Category</th>
            <th class="thOrder">Price</th>
            <th class="thOrder">Remove Product</th>
        </tr>

<?php
include_once 'ProductDB.php';


for ($i = 0; $i < count($_SESSION['productIds']); $i++) {
    $allProducts = ProductDB::getProductDetail($_SESSION['productIds'][$i]);
    foreach ($allProducts as $allProduct) {
        ?>

            <tr>
                <td class="tdOrder"><?php echo '<img style="width: 100px;" src="data:Image/jpg;base64,' . base64_encode($allProduct->Image) . '" />'; ?></td>
                <td class="tdOrder"><?php echo $allProduct->Name; ?></td>
                <td class="tdOrder"><?php echo $allProduct->Category; ?></td>
                <td class="tdOrder">€ <?php echo $allProduct->Price; ?></td>
                <td class="tdOrder"><button type="button" style="width: 100%;" class="btn btn-lg btn-secondary btn-sm removeItem" id="<?php echo $allProduct->Id; ?>">Remove</button></td>
            </tr>

        <?php
    }
}
?>
    </table>
</div>

<?php

} else {
    ?>

    <h3 style="text-align: center">No Products in Shopping Cart!</h3>

    <?php
}
?>

<?php
if(isset($_SESSION['productIds']) && !empty($_SESSION['productIds'])) {
    if (isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn'])) {
        ?>

        <hr/>

        <div style="margin: auto; width: 57%;">
            <a type="button" style="width: 200px;" class="btn btn-lg btn-primary btn-sm" href="addOrderDB.php">Continue to Order</a>
            <br/>
        </div>

        <?php
    } else {
        ?>

        <hr/>

        <div style="margin: auto; width: 57%;">
            <p>You have to sign in to continue your order.</p>
            <a type="button" style="width: 200px;" class="btn btn-lg btn-primary btn-sm" href="loginDB.php">Sign in</a>
            <br/>
        </div>

        <?php
    }
}
?>

<br/>

<!--
// Rizwan Shamsher. PHP display image BLOB from MySQL. Geraadpleegd via
// https://stackoverflow.com/questions/20556773/php-display-image-blob-from-mysql
// Geraadpleegd op 24 december 2018
-->