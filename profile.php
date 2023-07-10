<?php
$title = "DoTech | My Profile";
$css = "profile";
require "header.php";
require "userLogChecker.php";
include "navbar.php";
require_once('connection.php');
$isNewPassword = true;
if(isset($_SESSION['isNewPassword'])){$isNewPassword = $_SESSION['isNewPassword']; unset($_SESSION['isNewPassword']);}
$id_number = $_SESSION['id_number'];
$query = "SELECT * FROM tbl_user_acc WHERE id_number = '$id_number'";
$result = $conn->query($query);
if(!$result){
    die("Query Failed: ".$conn->error);
}else{
    $userDetails = $result->fetch_all(MYSQLI_ASSOC);
}

$user_id = $userDetails[0]['id_number'];
$email = $userDetails[0]['email'];
$myCoins = $userDetails[0]['pokecoins'];

?>

  <div class="container py-5">
    <div id="card">
        <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="store.php">Home</a></li>
                <li class="breadcrumb-item"><a href="profile.php">User</a></li>
                <li class="breadcrumb-item active" aria-current="page">User Profile</li>
            </ol>
            </nav>
        </div>
        </div>

        <div class="row">
        <div class="col-lg-4 col-md-12 col-sm-12">
            <div id="form-container" class="card mb-4">
            <!-- Pills navs -->
            <?php
                if (isset($_SESSION['newpass_error'])) :
            ?>
            <div class="alert alert-danger" role="alert">
                <?php
                        echo $_SESSION['newpass_error'];
                        unset($_SESSION['newpass_error']);
                ?>
            </div>
            <?php
                endif;
                if (isset($_SESSION['deactivate_id_error'])) :
            ?>
            <div class="alert alert-danger" role="alert">
                <?php
                        echo $_SESSION['deactivate_id_error'];
                        unset($_SESSION['deactivate_id_error']);
                ?>
            </div>
            <?php
                endif;
                if (isset($_SESSION['deactivate_email_error'])) :
            ?>
            <div class="alert alert-danger" role="alert">
                <?php
                        echo $_SESSION['deactivate_email_error'];
                        unset($_SESSION['deactivate_email_error']);
                ?>
            </div>
            <?php
                endif;
                if (isset($_SESSION['deactivate_pass_error'])) :
            ?>
            <div class="alert alert-danger" role="alert">
                <?php
                        echo $_SESSION['deactivate_pass_error'];
                        unset($_SESSION['deactivate_pass_error']);
                ?>
            </div>
            <?php
                endif;
                if (isset($_SESSION['error_inc'])) :
            ?>
            <div class="alert alert-danger" role="alert">
                <?php
                        echo $_SESSION['error_inc'];
                        unset($_SESSION['error_inc']);
                ?>
            </div>
            <?php
                endif;
                if(isset($_SESSION['updatesuccess'])):
            ?>
            <div class="alert alert-success" role="alert">
                <?php
                        echo $_SESSION['updatesuccess'];
                        unset($_SESSION['updatesuccess']);
                ?>
            </div>
            <?php
                endif;
                if(isset($_SESSION['empty'])):
            ?>
            <div class="alert alert-danger" role="alert">
                <?php
                        echo $_SESSION['empty'];
                        unset($_SESSION['empty']);
                ?>
            </div>
            <?php
                endif;
            ?>

            <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link <?php if($isNewPassword) echo 'active'; ?>" id="tab-change_password" data-mdb-toggle="pill" href="#pills-change_password" role="tab"
                aria-controls="pills-change_password" aria-selected="<?php echo $isNewPassword ? 'true' : 'false'; ?>">Change Password</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link <?php if(!$isNewPassword) echo 'active'; ?>" id="tab-deactivate" data-mdb-toggle="pill" href="#pills-deactivate" role="tab"
                aria-controls="pills-deactivate" aria-selected="<?php echo !$isNewPassword ? 'true' : 'false'; ?>">Deactivate Account</a>
            </li>
            </ul>
            <!-- Pills navs -->

            <!-- Pills content -->
            <div class="tab-content">
            <div class="tab-pane fade<?php if ($isNewPassword) echo ' show active'; ?>" id="pills-change_password" role="tabpanel" aria-labelledby="tab-change_password">
                <form action="val_profile.php" method="post">
                <!-- Current Password input -->
                <div class="form-outline mb-4">
                    <input type="password" id="oldPassword" name="oldPassword" class="form-control" placeholder="********"/>
                    <label class="form-label" for="oldPassword">Current Password</label>
                </div>

                <!--New Password input -->
                <div class="form-outline mb-4">
                    <input type="password" id="newPassword" name="newPassword" class="form-control" placeholder="********"/>
                    <label class="form-label" for="newPassword">New Password</label>
                </div>

                <!--Confirm New Password input -->
                <div class="form-outline mb-4">
                    <input type="password" id="newRepeatPassword" name="newRepeatPassword" class="form-control" placeholder="********"/>
                    <label class="form-label" for="newRepeatPassword">Confirm New Password</label>
                </div>

                <!-- Submit button -->
                <input type="hidden" name="btn-changePass">
                <button type="button" onclick="changePass(this)" id="btn-changePass" class="btn btn-info btn-block mb-4 btn-rounded" onmouseover="this.style.backgroundColor='#14A44D'" onmouseout="this.style.backgroundColor='#54B4D3'"><i class="fas fa-key"> Change Password</i></button>
                </form>
            </div>
            <div class="tab-pane fade<?php if (!$isNewPassword) echo ' show active'; ?>" id="pills-deactivate" role="tabpanel" aria-labelledby="tab-deactivate">
                <form form action="val_profile.php" method="post">
                <!-- ID input -->
                <div class="form-outline mb-4">
                    <input type="text" id="deactivate_id" name="deactivate_id" class="form-control" placeholder="####-####-####"/>
                    <label class="form-label" for="deactivate_id">Game ID</label>
                </div>

                <!-- Email input -->
                <div class="form-outline mb-4">
                    <input type="email" id="deactivate_email" name="deactivate_email" class="form-control" placeholder="email@email.com"/>
                    <label class="form-label" for="deactivate_email">Email</label>
                </div>

                <!-- Password input -->
                <div class="form-outline mb-4">
                    <input type="password" id="deactivate_password" name="deactivate_password" class="form-control" placeholder="********"/>
                    <label class="form-label" for="deactivate_password">Password</label>
                </div>

                <!-- Submit button -->
                <input type="hidden" name="btn-deactivateProfile">
                <button type="button" onclick="deact_acc(this)" id="btn-deactivateProfile" class="btn btn-info btn-block mb-3 btn-rounded" onmouseover="this.style.backgroundColor='#DC4C64'" onmouseout="this.style.backgroundColor='#54B4D3'"><i class="fas fa-user-slash"> Deactivate Account</i></button>
                </form>
            </div>
            </div>
            <!-- Pills content -->
            </div>
        </div>
        <div class="col-lg-8 col-md-12 col-sm-12">
            <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                <div class="col-sm-3">
                    <p class="mb-0">Game ID</p>
                </div>
                <div class="col-sm-9">
                    <p class="text-muted mb-0"><?php echo $user_id;?></p>
                </div>
                </div>
                <hr>
                <div class="row">
                <div class="col-sm-3">
                    <p class="mb-0">Email</p>
                </div>
                <div class="col-sm-9">
                    <p class="text-muted mb-0"><?php echo $email;?></p>
                </div>
                </div>

                <hr>
                <div class="row">
                <div class="col-sm-3">
                    <p class="mb-0">PokeCoins</p>
                </div>
                <div class="col-sm-9">
                    <p class="text-muted mb-0"><?php echo $myCoins;?></p>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
    </div>

<script>
    function changePass(btn){
        if (confirm("Change Password?")) {
                var form = btn.closest('form');
                form.submit();
            }else{
                alert("Change Password Canceled!");
            }
    }
    function deact_acc(btn){
        if (confirm("Deactivate Account?")) {
                var form = btn.closest('form');
                form.submit();
            }else{
                alert("Account Deactivation Canceled!");
            }
    }
</script>
    
<?php
$conn->close();
require "footer.php";
?>