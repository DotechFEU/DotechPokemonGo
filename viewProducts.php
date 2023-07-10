<?php
    session_start();
    unset($_SESSION['transaction_id']);
    $_SESSION['transaction_id'] = $_POST['toView'];
    header("Location: transactionProducts.php");
?>