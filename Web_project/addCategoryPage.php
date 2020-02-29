<br/>

<?php if (isset($_GET['category']) && $_GET['category'] == 'added') { ?>

    <p class="alert alert-success" style="margin: auto; text-align: center; width: 81%">Category is added!</p> <br>

<?php } ?>

<h1 class="text-center">Add a Category</h1>

<hr/>

<div class="container">
    <form action="addCategoryDB.php" method="POST">
        <div class="row">
            <div class="form-group col">
                <label for="category">*Category Name:</label>
                <input type="text" class="form-control" name="category" id="category" value="<?php echo $values['category']; ?>" placeholder="Give Category name:">
                <span class="errorMsg"><?php echo $errors['category']; ?></span>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Add Category</button>
    </form>
</div>

<br/>

