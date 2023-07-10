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
//TOP NOTE: di ko alam paano lagyan ng error na empty ung field/s
session_start();
if(isset($_POST['btn-changePass'])){ //change pass button
    if(($_POST['oldPassword'] != NULL) && ($_POST['newPassword'] != NULL) && ($_POST['newRepeatPassword'] != NULL)){
    /*Password: Start*/
    if($_POST['oldPassword'] != $_SESSION['pass_word']) { //if old password field in change password is not equal to current password in table
        $_SESSION['newpass_error'] = "Current password is invalid.";
    }else{
        if($_POST['newPassword'] == $_POST['oldPassword']) { //if new password field in change password is equal to current password in table
            $_SESSION['newpass_error'] = "New password is the same as the current password.";
        }else{
            if($_POST['newPassword'] != $_POST['newRepeatPassword']) { //if new password field in change password is not equal to confirm password field in change password
                $_SESSION['newpass_error'] = "New passwords do not match.";
            }else{
                if(!preg_match("/^[a-zA-Z0-9_\.!@#\$%\^\&\*_]*$/", $_POST['newPassword'])) { //validation for new password format
                    $_SESSION['newpass_error'] = "New Password is invalid.";
                }
            }
        } 
    }
    /*Password: End*/

    if(isset($_SESSION['newpass_error'])){
        header("Location: profile.php");
    }else{
        $newPassword = $_POST['newPassword'];
        $id_number = $_SESSION['id_number'];
        unset($_SESSION['loginEmail']); //remove saved email
        unset($_SESSION['loginPassword']); //remove saved password
        $query = "UPDATE `tbl_user_acc` SET `pass_word` = '$newPassword' WHERE `tbl_user_acc`.`id_number` = '$id_number'";
        $result = $conn->query($query);
        if(!$result){
            die("Query Failed: ".$conn->error);
        }else{
            $_SESSION['updatesuccess'] = "Password updated successfully.";
            $_SESSION['pass_word'] = $newPassword;
            header("Location: profile.php");
        }
    }
    }else{
        $_SESSION['empty'] = "Please fill all entry fields.";
        header("Location: profile.php");
    }
}

if(isset($_POST['btn-deactivateProfile'])){ //deactivate profile button
    if(($_POST['deactivate_id'] != NULL) && ($_POST['deactivate_email'] != NULL) && ($_POST['deactivate_password'] != NULL)){
        if($_POST['deactivate_id'] != $_SESSION['id_number']){ //if deactivate acccount's id is equal to currently logged in id
            $_SESSION['deactivate_id_error'] = "ID Number is incorrect."; 
        }
        if($_POST['deactivate_email'] != $_SESSION['email']){ //if deactivate acccount's email is equal to currently logged in email
            $_SESSION['deactivate_email_error'] = "Email is incorrect.";
        }
        if($_POST['deactivate_password'] != $_SESSION['pass_word']){ //if deactivate acccount's password is equal to currently logged in password
            $_SESSION['deactivate_pass_error'] = "Password is incorrect.";
        }
    
        if(isset($_SESSION['deactivate_id_error']) || isset($_SESSION['deactivate_email_error']) || isset($_SESSION['deactivate_pass_error'])){
            $_SESSION['isNewPassword'] = false;
            header("Location: profile.php");
        }else{
            $deactivate_id = $_SESSION['id_number'];
            $query = "DELETE FROM tbl_user_acc WHERE `tbl_user_acc`.`id_number` = '$deactivate_id'";
            $result = $conn->query($query);
            if(!$result){
                die("Query Failed: ".$conn->error);
            }else{
                session_destroy();
    ?>
                <script>
                    alert("Account has been deactivated.");
                    window.location.href = "signInUp.php";
                </script>
    <?php
            }
        }
    }else{
        $_SESSION['isNewPassword'] = false;
        $_SESSION['empty'] = "Please fill all entry fields.";
        header("Location: profile.php");
    }
}
$conn->close();
?>