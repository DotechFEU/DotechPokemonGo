<?php
    $host = 'localhost'; //website name if uploaded in website
    $username = 'root';
    $password = '';
    $database = 'FINAL_PROJECT';

    $conn = new mysqli($host, $username, $password, $database);

    if($conn->connect_error){
        die("Connection Failed: ".$conn->connect_error);
    }
?>