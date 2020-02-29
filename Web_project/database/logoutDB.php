<?php
include_once 'UserDB.php';

session_start();

$email = $_SESSION['loggedIn'];

//  Verwijder cookie uit DB van de ingelogde user
UserDB::updateUserCookie('', $email);

// Verwijder cookie
setcookie('user', '', 1, '/');


unset($_SESSION['loggedIn']);

session_destroy();

header('location:../index.php?logout=true');



// Stackoverflow. Delete all cookies of my website. Geraadpleegd via
// https://stackoverflow.com/questions/2310558/how-to-delete-all-cookies-of-my-website-in-php
// Geraadpleegd op 27 december 2018
?>


