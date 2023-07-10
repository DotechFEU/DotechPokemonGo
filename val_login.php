<?php
//Acquire contents on table as $rows
require_once('connection.php');
$query = "SELECT * FROM tbl_user_acc";
$result = $conn->query($query);
if(!$result){
    die("Query Failed: ".$conn->error);
}else{
    $rows = $result->fetch_all(MYSQLI_ASSOC);
}
session_start();

if(isset($_POST['btn-signIn'])){
    //for login validation
    if(($_POST['loginEmail'] != NULL) && ($_POST['loginPassword'] != NULL)){
        $_SESSION['logged'] = false;
        foreach($rows as $row){
            if($_POST['loginEmail'] == $row['email'] && $_POST['loginPassword'] == $row['pass_word']) {
                $_SESSION['id_number'] = $row['id_number'];
                $user_id = $row['id_number'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['pass_word'] = $row['pass_word'];
                $_SESSION['logged'] = true;
                if(isset($_POST['loginCheck'])){
                    $_SESSION['loginEmail'] = $_POST['loginEmail'];
                    $_SESSION['loginPassword'] = $_POST['loginPassword'];
                }else{
                    unset($_SESSION['loginEmail']);
                    unset($_SESSION['loginPassword']);
                }
                break;
            }
        }

        //if islogged=false, display error on signInUp.php, otherwise display success
        if($_SESSION['logged'] == false){
            $_SESSION['userlogin_error'] = "Email or Password is invalid.";
            header("Location: signInUp.php");
        }else{
            $_SESSION['id_number'] = $user_id;
            $_SESSION['logged'] = true;
            header("Location: store.php");
        }
    }else{
        $_SESSION['error_inc'] = "Please fill all entry fields.";
        header("Location: signInUp.php");
    }
}
$conn->close();
?>