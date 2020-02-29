<br/>

<h1 class="text-center">Make Order</h1>

<hr/>

<div class="container">
    <form action="addOrderDB.php" method="POST">
        <div class="row">
            <div class="form-group col">
                <label for="billingaddress">*Billing Address: </label>
                <select class="form-control" id="billingaddress" name="billingaddress">
                    <?php
                    include_once 'AddressDB.php';
                    $allAddresses = AddressDB::getAllAddressesByEmail($_SESSION['loggedIn']);
                    foreach ($allAddresses as $allAddress) {
                        ?>
                        <option value="<?php echo $allAddress->Id; ?>"><?php echo $allAddress->StreetName; ?> <?php echo $allAddress->HouseNumber; ?> - <?php echo $allAddress->PostalCode; ?> <?php echo $allAddress->City; ?></option>
                        <?php
                    }
                    ?>
                </select>
                <span class="errorMsg"><?php echo $errors['billingaddress']; ?></span>
                <small>No address or address not found? Click <a href="addAddressDB.php"><u style="color: #0047a5">here</u></a> to make one.</small>
            </div>
        </div>

        <br/>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="usedeliveryaddress" name="usedeliveryaddress" data-toggle="collapse" data-target="#collapse">
            <label class="form-check-label" for="usedeliveryaddress">
                Change Delivery Address
            </label>
        </div>

        <br/>

        <div class="row collapse" id="collapse">
            <div class="form-group col">
                <label for="deliveryaddress">*Delivery Address: </label>
                <select class="form-control" id="deliveryaddress" name="deliveryaddress">
                    <?php
                    include_once 'AddressDB.php';
                    $allAddresses = AddressDB::getAllAddressesByEmail($_SESSION['loggedIn']);
                    foreach ($allAddresses as $allAddress) {
                        ?>
                        <option value="<?php echo $allAddress->Id; ?>"><?php echo $allAddress->StreetName; ?> <?php echo $allAddress->HouseNumber; ?> - <?php echo $allAddress->PostalCode; ?> <?php echo $allAddress->City; ?></option>
                        <?php
                    }
                    ?>
                </select>
                <span class="errorMsg"><?php echo $errors['deliveryaddress']; ?></span>
                <small>No address or address not found? Click <a href="addAddressDB.php"><u style="color: #0047a5">here</u></a> to make one.</small>
            </div>
        </div>

        <br/>

        <div class="row">
            <div class="form-group col">
                <label for="deliverymethod">*Delivery Method: </label>
                <select class="form-control" id="deliverymethod" name="deliverymethod">
                    <option>Delivery at Home</option>
                    <option>Delivery at pick-up point in your area</option>
                </select>
            </div>
        </div>

        <br/>

        <div class="row">
            <div class="form-group col">
                <label for="paymentmethod">*Payment Method: </label>
                <select class="form-control" id="paymentmethod" name="paymentmethod">
                    <option>Bancontact / Mister Cash</option>
                    <option>Creditcard</option>
                    <option>Visa</option>
                    <option>PayPal</option>
                    <option>Pay after Delivery</option>
                </select>
            </div>
        </div>

        <br/>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="terms" name="terms">
            <label class="form-check-label" for="terms">
                Accept Terms & Conditions
            </label>
            <br/>
            <span class="errorMsg"><?php echo $errors['terms']; ?></span>
        </div>

        <hr/>

        <button type="submit" class="btn btn-primary">Make Order</button>
        <a type="button" class="btn btn-primary" href="shoppingCartDB.php">Back to Shopping Cart</a>
    </form>
</div>

<br/>

<!--
 // Bootstrap. Collapse. Geraadpleegd via
 // https://getbootstrap.com/docs/4.0/components/collapse/
 // Geraadpleegd op 29 december 2018
 -->
