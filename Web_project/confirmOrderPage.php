<br/>

<h1 class="text-center">Confirm Order</h1>

<hr/>

<div class="container" style="border: 1px solid black; width: 70%; border-radius: 10px; background-color: #c9ddff;">
    <form action="confirmOrderDB.php" method="POST">

        <br/>

        <div class="row">
            <div class="form-group col">
                <h5><b>Billing Address:</b></h5>
                <?php
                include_once 'AddressDB.php';

                $allAddresses = AddressDB::getAddressByAddressId($_SESSION['billingaddress']);
                foreach ($allAddresses as $allAddress) {
                    ?>

                    <p><?php echo $allAddress->StreetName; ?> <?php echo $allAddress->HouseNumber; ?> - <?php echo $allAddress->City; ?> <?php echo $allAddress->PostalCode; ?></p>
                    <?php
                }
                ?>

                <h5><b>Delivery Address:</b></h5>
                <?php

                $allAddresses = AddressDB::getAddressByAddressId($_SESSION['deliveryaddress']);
                foreach ($allAddresses as $allAddress) {
                    ?>

                    <p><?php echo $allAddress->StreetName; ?> <?php echo $allAddress->HouseNumber; ?> - <?php echo $allAddress->City; ?> <?php echo $allAddress->PostalCode; ?></p>
                    <?php
                }
                ?>

                <h5><b>Delivery Method:</b></h5>
                <p><?php echo $_SESSION['deliverymethod'] ?></p>

                <h5><b>Payment Method:</b></h5>
                <p><?php echo $_SESSION['paymentmethod'] ?></p>


            </div>
        </div>

        <h5><b>All Products:</b></h5>

        <hr/>

        <div class="row">
            <div class="form-group col">
                <table style="width: 90%;">
                    <tr style="border: 1px solid black;">
                        <th style="border: 1px solid black;">Name</th>
                        <th style="border: 1px solid black;">Category</th>
                        <th style="border: 1px solid black;">Price</th>
                    </tr>
                    <?php
                    include_once 'ProductDB.php';
                    for ($i = 0; $i < count($_SESSION['productIds']); $i++) {
                        $allProducts = ProductDB::getProductDetail($_SESSION['productIds'][$i]);
                        foreach ($allProducts as $allProduct) {
                            ?>
                            <tr style="border: 1px solid black;">
                                <td style="border: 1px solid black;"><?php echo $allProduct->Name; ?></td>
                                <td style="border: 1px solid black;"><?php echo $allProduct->Category; ?></td>
                                <td style="border: 1px solid black;"><b>€ <?php echo $allProduct->Price; ?></b></td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </table>
            </div>
        </div>

        <br/>

        <h5><b>Total Price:</b></h5>

        <hr/>

        <div class="row">
            <div class="form-group col">
                <?php
                $totalprice = 0;

                for ($i = 0; $i < count($_SESSION['productIds']); $i++) {
                    $allProducts = ProductDB::getProductDetail($_SESSION['productIds'][$i]);
                    foreach ($allProducts as $allProduct) {
                        $totalprice = $totalprice + $allProduct->Price;
                    }
                }
                ?>

                <h5><b>€ <?php echo $totalprice; ?></b></h5>
            </div>
        </div>

        <hr/>

        <p>Make sure you have checked your order!</p>

        <button type="submit" class="btn btn-primary">Confirm Order</button>
        <a type="button" class="btn btn-primary" href="addOrderDB.php">Go Back</a>
    </form>

    <br/>

</div>

<br/>

