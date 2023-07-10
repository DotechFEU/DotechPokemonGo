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

if(isset($_POST['btn-signUp'])){
    //for registration validation, palagyan nalang ung validation ni registerID
    if(($_POST['registerID'] != NULL) && ($_POST['registerEmail'] != NULL) && ($_POST['registerPassword'] != NULL) && ($_POST['registerRepeatPassword'] != NULL)){

        /*ID: Start*/
        /*ID: Check first if ID input is in correct format.*/
        if(!preg_match("/^\d{4}-\d{4}-\d{4}$/", $_POST['registerID'])) {
            $_SESSION['id_error'] = "ID is invalid. Format for ID is ####-####-####.";
        }else{/*ID: When ID format is correct.*/
            /*ID: Check database if duplicate ID exists.*/
            foreach($rows as $row){
                if($row['id_number'] == $_POST['registerID']){
                    $_SESSION['id_error'] = "ID already exist.";
                    break;/*Exit Loop when duplicate is found.*/
                }
            }
        }
        /*ID: End*/

        /*Email: Start*/
        /*Email: Check first if Email input is in correct format.*/
        if(!preg_match("/^([a-zA-Z]+[a-zA-Z0-9_\.]*[a-zA-Z0-9]+)@(gmail|yahoo).com$/", $_POST['registerEmail'])) {
            $_SESSION['email_error'] = "Email is invalid.";
        }else{/*Email: When Email format is correct.*/
            /*Email: Check database if duplicate Email exists.*/
            foreach($rows as $row){
                if($row['email'] == $_POST['registerEmail']){
                    $_SESSION['email_error'] = "Email already exist.";
                    break;/*Exit Loop when duplicate is found.*/
                }
            }
        }
        /*Email: End*/

        /*Password: Start*/
        if(!preg_match("/^[a-zA-Z0-9_\.!@#\$%\^\&\*_]*$/", $_POST['registerPassword'])) {
            $_SESSION['password_error'] = "Password is invalid.";
        }
        if($_POST['registerPassword'] != $_POST['registerRepeatPassword']) {
            $_SESSION['password_error'] = "Passwords do not match.";
        }
        /*Password: End*/
        
        /*AgreeCheck: Start*/
        if(!isset($_POST['registerCheck'])){
            $_SESSION['rcheck_error'] = "Please agree to the terms and conditions.";
        }
        /*AgreeCheck: End*/

        //if there's error, display error on signInUp.php, otherwise display success
        if(isset($_SESSION['id_error']) || $_SESSION['email_error'] || isset($_SESSION['password_error']) || $_SESSION['rcheck_error']){
            header("Location: signInUp.php");
            $_SESSION['isLogin'] = false;
        }else{
            $id_number = $_POST['registerID'];
            $email = $_POST['registerEmail'];
            $pass_word = $_POST['registerPassword'];
            $query = "INSERT INTO tbl_user_acc(id_number, email, pass_word, pokecoins) VALUES('$id_number', '$email', '$pass_word', 0)";
            $result = $conn->query($query);
            if(!$result){
                die("Query Failed: ".$conn->error);
            }else{
                $_SESSION['isLogin'] = true;
                $_SESSION['registersuccess'] = "Registered successfully.";
                header("Location: signInUp.php");
            }
        }
    }else{
    $_SESSION['isLogin'] = false;
    $_SESSION['error_inc'] = "Please fill all entry fields.";
    header("Location: signInUp.php");
}
}
$conn->close();
?>