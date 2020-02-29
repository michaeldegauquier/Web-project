<br/>

<?php echo $errors['loginIncorrect']; ?>

<?php if (isset($_GET['register']) && $_GET['register'] == 'true') { ?>

    <p class="alert alert-success" style="margin: auto; text-align: center; width: 27%">Registration is successful!</p> <br>

<?php } ?>

<div class="container">
    <div class="card card-container loginContainer">
        <h1 style="text-align: center;">Sign in</h1>

        <hr/>

        <form id="loginForm" action="loginDB.php" method="POST">
            <label for="inputEmail">E-mail:</label>
            <div style=" margin-bottom: 6%;">
                <input type="email" id="inputEmail" class="form-control" value="<?php echo $values['loginEmail']; ?>" name="loginEmail" placeholder="E-mail address">
                <span class="errorMsg"><?php echo $errors['loginEmail']; ?></span>
            </div>

            <label for="inputPassword">Password:</label>
            <div style=" margin-bottom: 6%;">
                <input type="password" id="inputPassword" class="form-control" name="loginPassword" placeholder="Password">
                <span class="errorMsg"><?php echo $errors['loginPassword']; ?></span>
            </div>

            <div id="remember" class="checkbox">
                <label>
                    <input type="checkbox" name="remember" value="remember"> Remember me
                </label>
            </div>

            <hr/>

            <button class="btn btn-lg btn-primary btn-block btn-signin loginButton" type="submit">Sign in</button>

            <br/>

            <small>No account? Register <a href="registerDB.php">here</a>!</small>
        </form>
    </div>
</div>

<br/>

<!--
// Cesiztel. Google style login extended. Geraadpleegd via
// https://bootsnipp.com/snippets/featured/google-style-login-extended-with-html5-localstorage
// Geraadpleegd op 27 december 2018
-->
