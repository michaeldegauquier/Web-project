<br/>


<?php if (isset($_GET['message']) && $_GET['message'] == 'send') { ?>

    <p class="alert alert-success" style="margin: auto; text-align: center; width: 81%">Your message is send!</p> <br>

<?php } ?>


<h1 class="text-center">Contact us!</h1>

<hr/>

<div class="container">
    <form action="mail.php" method="POST" id="contact_form">

        <div class="row">
            <div class="form-group col">
                <label for="firstname">*First Name:</label>
                <input type="text" class="form-control" name="firstname" id="firstname" value="<?php echo $values['firstname']; ?>" placeholder="Give First name" >
                <span class="errorMsg"><?php echo $errors['firstname']; ?></span>
            </div>

            <div class="form-group col">
                <label for="lastname">*Last Name:</label>
                <input type="text" class="form-control" name="lastname" id="lastname" value="<?php echo $values['lastname']; ?>" placeholder="Give Last name" >
                <span class="errorMsg"><?php echo $errors['lastname']; ?></span>
            </div>
        </div>

        <div class="form-group">
            <label for="email">*E-mail:</label>
            <input type="email" class="form-control" name="email" id="email" value="<?php echo $values['email']; ?>" placeholder="Give E-mail" >
            <small id="emailHelp" class="form-text text-muted">We will never share your email with anyone else.</small>
            <span class="errorMsg"><?php echo $errors['email']; ?></span>
        </div>

        <div class="form-group">
            <label for="message">*Message:</label>
            <textarea class="form-control" name="message" id="message" rows="3" placeholder="Type here your message..." ><?php echo $values['message']; ?></textarea>
            <span class="errorMsg"><?php echo $errors['message']; ?></span>
        </div>

        <button type="submit" id="submit" class="btn btn-primary">Send Message</button>
    </form>
</div>

<br/>
