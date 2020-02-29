<br/>

<div class="container">
    <div class="card card-container registerContainer">
        <h1 style="text-align: center;">Register</h1>

        <hr/>

        <form id="loginForm" action="registerDB.php" method="POST">
            <label for="firstname">First Name: </label>
            <div style=" margin-bottom: 6%;">
                <input type="text" id="firstname" class="form-control" value="<?php echo $values['firstname']; ?>" name="firstname" placeholder="First name">
                <span class="errorMsg"><?php echo $errors['firstname']; ?></span>
            </div>

            <label for="lastname">Last Name: </label>
            <div style=" margin-bottom: 6%;">
                <input type="text" id="lastname" class="form-control" value="<?php echo $values['lastname']; ?>" name="lastname" placeholder="Last name">
                <span class="errorMsg"><?php echo $errors['lastname']; ?></span>
            </div>

            <label for="email">E-mail: </label>
            <div style=" margin-bottom: 6%;">
                <input type="email" id="email" class="form-control" value="<?php echo $values['email']; ?>" name="email" placeholder="E-mail address">
                <span class="errorMsg"><?php echo $errors['email']; ?></span>
                <span class="errorMsg"><?php echo $errors['emailexists']; ?></span>
            </div>

            <label for="password">Password: </label>
            <div style=" margin-bottom: 6%;">
                <input type="password" maxlength="20" id="password" class="form-control" value="<?php echo $values['password']; ?>" name="password" placeholder="Password">
                <span class="errorMsg"><?php echo $errors['password']; ?></span>
            </div>

            <label for="password">Confirm Password: </label>
            <div style=" margin-bottom: 6%;">
                <input type="password" maxlength="20" id="confirmpassword" class="form-control" value="<?php echo $values['confirmpassword']; ?>" name="confirmpassword" placeholder="Confirm Password">
                <span class="errorMsg"><?php echo $errors['confirmpassword']; ?></span>
            </div>

            <hr/>

            <button class="btn btn-lg btn-primary btn-block btn-signin registerButton" type="submit">Register</button>
        </form>
    </div>
</div>

<br/>

