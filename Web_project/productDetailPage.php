<br/>

<?php include_once 'ProductDB.php';
    $productDetails = ProductDB::getProductDetail($_GET['productId']);
    foreach ($productDetails as $productDetail) {
?>

<h1 class="text-center"><?php echo $productDetail->Name; ?></h1>

<hr/>

<div class="container" style="border:1px solid grey; margin: auto; padding: 1%; background-color: white;">
    <div class="row">

        <div class="col-md-auto" style="float: left;">

            <div style="float: left;">
                <?php echo '<img style="border: 1px solid grey; border-radius: 2%;" src="data:Image/jpg;base64,' . base64_encode($productDetail->Image) . '" />'; ?>

                <br/>

                <a href="" style="margin-top: 1%;" class="btn btn-info btn-lg shopping-cart-btn" id="<?php echo $productDetail->Id; ?>">
                    <i class="material-icons">shopping_cart</i> Add to Shopping Cart
                </a>
            </div>
        </div>

        <div class="col" style="float: left;">
            <div style="float: left;">
                <h2><u>Description</u></h2>
                <h4><?php echo $productDetail->Description; ?></h4>
            </div>
        </div>

        <div class="col-md-auto" style="float: left;">
            <div style="float: left;">
                <h2 style="text-align: center;"><u>Category</u></h2>
                <h4 style="text-align: center;"><?php echo $productDetail->Category; ?></h4>

                <h2 style="text-align: center;"><u>Price</u></h2>
                <h4 style="text-align: center; color: red;">€ <?php echo $productDetail->Price; ?></h4>

                <?php
                }
                ?>

                <h2 style="text-align: center;"><u>Rating</u></h2>

                <?php include_once 'RatingDB.php';
                    $ratingNumRows = RatingDB::getRatingByProductId($_GET['productId']);

                    $ratingDetails = RatingDB::getAVGRatingByProductId($_GET['productId']);
                    foreach ($ratingDetails as $ratingDetail) {
                        if ($ratingNumRows == true) {
                            ?>

                            <h4 style="text-align: center;"><?php echo $ratingDetail->Rating ?>/10</h4>

                            <?php
                        } else {
                            ?>

                            <h4 style="text-align: center;">No score</h4>

                    <?php
                        }
                    }
                ?>
            </div>
        </div>

    </div>

    <hr/>

    <div class="row">
        <div class="col">
            <h2 style="text-align: center;">Feedback Customers</h2>

            <hr/>

            <?php
            $feedbackDetails = RatingDB::getFeedbackByProductId($_GET['productId']);

            if ($ratingNumRows == false) {
            ?>

                <p style="text-align: center;">Nothing Posted yet!</p>

            <?php
            } else {
                foreach ($feedbackDetails as $feedbackDetail) {
            ?>
                <small>Rating: <?php echo $feedbackDetail->Rating; ?>/10 - Posted by <?php echo $feedbackDetail->Firstname; ?> <?php echo $feedbackDetail->Lastname; ?> on <?php echo $feedbackDetail->Date; ?> </small>

                <textarea cols="1" class="form-control" name="feedback" id="feedback" readonly style="background-color: whitesmoke;"><?php echo $feedbackDetail->Feedback; ?></textarea>

                <br/>

                <?php
                }
            }
            ?>

        </div>
    </div>

    <hr/>

    <div class="row">
        <div class="col">
            <h2 style="text-align: center;">Set Rating on Product</h2>

            <hr/>

            <form action="#" method="POST">
                <div class="form-group">
                    <label for="score">*Give score 1-10: </label>
                    <select class="form-control" id="score" name="score" style="width: 10%;">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                        <option>6</option>
                        <option>7</option>
                        <option>8</option>
                        <option>9</option>
                        <option>10</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="feedback">*Give Feedback:</label>
                    <textarea type="text" class="form-control" name="feedback" id="feedback" placeholder="Type your feedback here..."></textarea>
                    <span class="errorMsg"><?php echo $errors['feedback']; ?></span>
                </div>

                <hr/>

                <button type="submit" class="btn btn-primary">Add Rating</button>
                <span class="errorMsg"><?php echo $errors['exist']; ?></span>
            </form>
        </div>
    </div>
</div>

<br/>

<h1 class="text-center">Products in same Category</h1>

<hr/>

<div class="container">
    <div class="card-deck">
        <div class="row">
            <?php
            $catgProducts = ProductDB::getProductinSameCatg($_GET['productId']);
            foreach ($catgProducts as $catgProduct) {
                ?>
                <div class="card border-secondary mb-3" style="width: 18rem; margin: auto; margin-left: 1%; text-align: center;">
                    <?php echo '<img class="card-img-top" src="data:Image/jpg;base64,' . base64_encode($catgProduct->Image) . '" />'; ?>

                    <a href="" class="btn btn-info btn-lg shopping-cart-btn hideButton" id="<?php echo $catgProduct->Id; ?>">
                        <i class="material-icons">shopping_cart</i> Add to Shopping Cart
                    </a>

                    <div class="card-body">
                        <h5 class="card-title"><b><?php echo $catgProduct->Name; ?></b></h5>
                        <p class="card-text">
                        <p><b>Category:</b> <?php echo $catgProduct->Category; ?></p>
                        <p><b>Price:</b> € <?php echo $catgProduct->Price; ?></p>
                    </div>
                    <div class="card-footer">
                        <a class="btn btn-primary" style="width: 100%" href="addRatingToProduct.php?productId=<?php echo $catgProduct->Id ?>" >More info</a>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>

<br/>


<!--
// Rizwan Shamsher. PHP display image BLOB from MySQL. Geraadpleegd via
// https://stackoverflow.com/questions/20556773/php-display-image-blob-from-mysql
// Geraadpleegd op 24 december 2018
-->