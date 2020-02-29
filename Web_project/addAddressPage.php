<br/>

<?php if (isset($_GET['address']) && $_GET['address'] == 'added') { ?>

    <p class="alert alert-success" style="margin: auto; text-align: center; width: 82%">Address is added!</p> <br>

<?php } ?>

<h1 class="text-center">Add an Address</h1>

<hr/>

<div class="container">
    <form action="addAddressDB.php" method="POST">
        <div class="form">
            <div class="form">
                <div class="row">
                    <div class="form-group col">
                        <label for="streetname">*Street Name:</label>
                        <input type="text" class="form-control" name="streetname" id="streetname" value="<?php echo $values['streetname']; ?>" placeholder="Give Street name">
                        <span class="errorMsg"><?php echo $errors['streetname']; ?></span>
                    </div>

                    <div class="form-group col">
                        <label for="housenumber">*House Number: </label>
                        <input type="text" class="form-control" name="housenumber" id="housenumber" value="<?php echo $values['housenumber']; ?>" placeholder="Give House number">
                        <span class="errorMsg"><?php echo $errors['housenumber']; ?></span>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col">
                        <label for="postalcode">*Postal Code: </label>
                        <input type="text" class="form-control" name="postalcode" id="postalcode" value="<?php echo $values['postalcode']; ?>" placeholder="Give Postal code">
                        <span class="errorMsg"><?php echo $errors['postalcode']; ?></span>
                    </div>

                    <div class="form-group col">
                        <label for="city">*City:</label>
                        <input type="text" class="form-control" name="city" id="city" value="<?php echo $values['city']; ?>" placeholder="Give City">
                        <span class="errorMsg"><?php echo $errors['city']; ?></span>
                    </div>
                </div>
            </div>
        </div>

        <hr/>

        <button type="submit" class="btn btn-primary">Add Address</button>
        <a type="button" class="btn btn-primary" href="addOrderDB.php">Back to Order</a>
    </form>
</div>

<br/>
