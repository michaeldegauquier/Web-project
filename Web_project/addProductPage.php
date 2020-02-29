<br/>

<?php if (isset($_GET['product']) && $_GET['product'] == 'added') { ?>

    <p class="alert alert-success" style="margin: auto; text-align: center; width: 82%">Product is added!</p> <br>

<?php } ?>

<h1 class="text-center">Add a Product</h1>

<hr/>

<div class="container">
    <form action="addProductDB.php" method="POST" enctype="multipart/form-data">
        <div class="form">
            <div class="form-group">
                <label for="name">*Product Name:</label>
                <input type="text" class="form-control" name="name" id="name" value="<?php echo $values['name']; ?>" placeholder="Give Product name">
                <span class="errorMsg"><?php echo $errors['name']; ?></span>
            </div>

            <div class="form-group">
                <label for="price">*Price: </label>
                <input type="number" step="0.01" class="form-control" name="price" id="price" value="<?php echo $values['price']; ?>" placeholder="Give Price">
                <span class="errorMsg"><?php echo $errors['price']; ?></span>
            </div>

            <div class="form-group">
                <label for="category">*Category: </label>
                <select class="form-control" id="category" name="category">
                    <?php
                    include_once 'CategoryDB.php';
                    $allCategories = CategoryDB::getAllCategories();
                    foreach ($allCategories as $allCategory) {
                        ?>
                        <option><?php echo $allCategory->Category; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="description">*Description: </label>
                <textarea class="form-control" name="description" id="description" placeholder="Give description..."><?php echo $values['description']; ?></textarea>
                <span class="errorMsg"><?php echo $errors['description']; ?></span>
            </div>

            <div class="form-group">
                <label for="image">*Image: </label>
                <input type="file" class="form-control-file" id="image" name="image" accept="image/*" required>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="highlight" name="highlight">
                <label class="form-check-label" for="highlight">
                    Highlight Product
                </label>
            </div>
        </div>

        <hr/>

        <button type="submit" class="btn btn-primary">Add Product</button>
    </form>
</div>

<br/>
