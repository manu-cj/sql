<?php
session_start();
//Logout 
if (isset($_SESSION['user'])) {
    unset($_SESSION['user']);

    header('location:  /exos/php-challenge-auth/login.php');
}

?>