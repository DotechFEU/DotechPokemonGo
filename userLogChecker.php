<?php
    session_start();
    $logged = false;
    if(isset($_SESSION['logged'])){$logged = $_SESSION['logged'];}
    if(!$logged){header("Location: signInUp.php");}
?>