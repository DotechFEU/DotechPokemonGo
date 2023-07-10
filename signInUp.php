<?php
$title = "DoTech | Sign In/Up";
$css = "signInUp";
require "header.php";
session_start();
$_SESSION['logged'] = false;
include "navbar.php";
$isLogin = true;
?>

    <div class="card-container">
        <div id="card-holder">
        <div class="card">
            <div id="card-group">
                <?php
                    if (isset($_SESSION['isLogin'])) :
                        $isLogin = $_SESSION['isLogin'];
                    endif;

                    if (isset($_SESSION['isLogin'])) :
                        $isRegister = $_SESSION['isLogin'];
                    endif;

                    if (isset($_SESSION['userlogin_error'])) : //alert for error login, check function at validation.php
                ?>
                <div class="alert alert-danger" role="alert">
                    <?php
                        if (isset($_SESSION['userlogin_error'])) :
                            echo $_SESSION['userlogin_error'];
                            unset($_SESSION['userlogin_error']);
                        endif;
                    ?>
                </div>
                <?php
                    endif;
                    if (isset($_SESSION['registersuccess'])) : //alert for successful registration, check function at validation.php
                ?>
                <div class="alert alert-success" role="alert">
                    <?php
                        if (isset($_SESSION['registersuccess'])) :
                            echo $_SESSION['registersuccess'];
                            unset($_SESSION['registersuccess']);
                        endif;
                    ?>
                </div>
                <?php
                    endif;
                    if (isset($_SESSION['id_error'])) : //alert for id error, check function at validation.php
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php
                            if (isset($_SESSION['id_error'])) :
                                echo $_SESSION['id_error'];
                                unset($_SESSION['id_error']);
                            endif;
                        ?>
                    </div>
                <?php
                    endif;
                    if (isset($_SESSION['email_error'])) : //alert for email error, check function at validation.php
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php
                            if (isset($_SESSION['email_error'])) :
                                echo $_SESSION['email_error'];
                                unset($_SESSION['email_error']);
                            endif;
                        ?>
                    </div>
                <?php
                    endif;
                    if (isset($_SESSION['password_error'])) : //alert for password error, check function at validation.php
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php
                            if (isset($_SESSION['password_error'])) :
                                echo $_SESSION['password_error'];
                                unset($_SESSION['password_error']);
                            endif;
                        ?>
                    </div>
                <?php
                    endif;
                    if (isset($_SESSION['password_error'])) : //alert for password error, check function at validation.php
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php
                            if (isset($_SESSION['password_error'])) :
                                echo $_SESSION['password_error'];
                                unset($_SESSION['password_error']);
                            endif;
                        ?>
                    </div>
                <?php
                    endif;
                    if (isset($_SESSION['rcheck_error'])) : //alert for password error, check function at validation.php
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php
                            if (isset($_SESSION['rcheck_error'])) :
                                echo $_SESSION['rcheck_error'];
                                unset($_SESSION['rcheck_error']);
                            endif;
                        ?>
                    </div>
                <?php
                    endif;
                    if (isset($_SESSION['updatesucccess'])) : //alert for successful update password, check function at validation.php
                ?>
                    <div class="alert alert-success" role="alert">
                    <?php
                        if (isset($_SESSION['updatesucccess'])) :
                            echo $_SESSION['updatesucccess'];
                            unset($_SESSION['updatesucccess']);
                        endif;
                    ?>
                    </div>
                <?php
                    endif;
                    if(isset($_SESSION['error_inc'])):
                ?>
                        <div class="alert alert-danger" role="alert">
                        <?php
                            if (isset($_SESSION['error_inc'])) :
                                echo $_SESSION['error_inc'];
                                unset($_SESSION['error_inc']);
                            endif;
                        ?>
                        </div>
                <?php
                    endif;
                ?>
                
                <!-- Pills navs -->
                <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
                <li class="nav-item" role="presentation">
                    <a
                    class="nav-link <?php if($isLogin) echo 'active'; ?>"
                    id="tab-login"
                    data-mdb-toggle="pill"
                    href="#pills-login"
                    role="tab"
                    aria-controls="pills-login"
                    aria-selected="<?php echo $isLogin ? 'true' : 'false'; ?>"
                    >Login</a
                    >
                </li>
                <li class="nav-item" role="presentation">
                    <a
                    class="nav-link <?php if (!$isLogin) echo 'active'; ?>"
                    id="tab-register"
                    data-mdb-toggle="pill"
                    href="#pills-register"
                    role="tab"
                    aria-controls="pills-register"
                    aria-selected="<?php echo !$isLogin ? 'true' : 'false'; ?>"
                    >Register</a
                    >
                </li>
                </ul>
                <!-- Pills navs -->

                <!-- Pills content -->
                <!-- login -->
                <div class="tab-content">
                <div class="tab-pane fade<?php if ($isLogin) echo ' show active'; ?>" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
                    <form action="val_login.php" method="post">

                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <input placeholder="email@email.com" type="email" id="loginEmail" name="loginEmail" class="form-control" 
                            style="background-color: <?php if(isset($_SESSION['loginEmail'])){echo "Yellow";}?>"
                            value="<?php if(isset($_SESSION['loginEmail'])){echo $_SESSION['loginEmail'];}?>"/>
                            <label class="form-label" for="loginEmail">Email</label>
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-4">
                            <input placeholder="********" type="password" id="loginPassword" name="loginPassword" class="form-control"
                            style="background-color: <?php if(isset($_SESSION['loginPassword'])){echo "Yellow";}?>"
                            value="<?php if(isset($_SESSION['loginPassword'])){echo $_SESSION['loginPassword'];}
                            ?>"
                            />
                            <label class="form-label" for="loginPassword">Password</label>
                        </div>

                        <!-- 2 column grid layout -->
                        <div class="row mb-4">
                            <div class="col-md-6 d-flex justify-content-center">
                                <!-- Checkbox -->
                                <div class="form-check mb-3 mb-md-0">
                                    <input class="form-check-input" type="checkbox" value="" id="loginCheck" name="loginCheck"/>
                                    <label class="form-check-label" for="loginCheck"> Remember me </label>
                                </div>
                            </div>

                            <div class="col-md-6 d-flex justify-content-center">
                                <!-- Simple link -->
                                <a href="#!">Forgot password?</a>
                            </div>
                        </div>

                        <!-- Submit button -->
                        <button type="submit" name="btn-signIn" class="btn btn-info btn-rounded btn-block mb-4" onmouseover="this.style.backgroundColor='#3B71CA'" onmouseout="this.style.backgroundColor='#54B4D3'">Sign in</button>

                        <script>
                            function switchToRegister() {
                                // Switch to the "Register" tab
                                document.getElementById("tab-login").classList.remove("active");
                                document.getElementById("tab-register").classList.add("active");
                                document.getElementById("pills-login").classList.remove("show", "active");
                                document.getElementById("pills-register").classList.add("show", "active");
                            }
                        </script>
                        <!-- Register button -->
                        <div class="text-center">
                            <p>Not a member? <a onclick="switchToRegister()" style="color: #3B71CA; cursor: pointer;">Register</a></p>
                        </div>

                    </form>
                </div>
                
                <!-- signup -->
                <div class="tab-pane fade<?php if (!$isLogin) echo ' show active'; ?>" id="pills-register" role="tabpanel" aria-labelledby="tab-register">
                    <form action="val_register.php" method="post">

                    <!-- ID input -->
                    <div class="form-outline mb-4">
                        <input placeholder="####-####-####" type="text" id="registerID" name="registerID" class="form-control" />
                        <label class="form-label" for="registerID">ID Number</label>
                    </div>

                    <!-- Email input -->
                    <div class="form-outline mb-4">
                        <input placeholder="email@email.com" type="email" id="registerEmail" name="registerEmail" class="form-control" />
                        <label class="form-label" for="registerEmail">Email</label>
                    </div>

                    <!-- Password input -->
                    <div class="form-outline mb-4">
                        <input placeholder="********" type="password" id="registerPassword" name="registerPassword" class="form-control" />
                        <label class="form-label" for="registerPassword">Password</label>
                    </div>

                    <!-- Repeat Password input -->
                    <div class="form-outline mb-4">
                        <input placeholder="********" type="password" id="registerRepeatPassword" name="registerRepeatPassword" class="form-control" />
                        <label class="form-label" for="registerRepeatPassword">Repeat Password</label>
                    </div>

                    <!-- Checkbox -->
                    <div class="form-check d-flex justify-content-center mb-4">
                        <input class="form-check-input me-2" type="checkbox" value="" id="registerCheck" name="registerCheck" aria-describedby="registerCheckHelpText"/>
                        <label class="form-check-label" for="registerCheck">
                        I have read and agreed to the terms and conditions
                        </label>
                    </div>

                    <!-- Submit button -->
                    <button type="submit" name="btn-signUp" class="btn btn-info btn-rounded btn-block mb-3" onmouseover="this.style.backgroundColor='#3B71CA'" onmouseout="this.style.backgroundColor='#54B4D3'">Sign up</button>
                    </form>
                </div>
                </div>
                <!-- Pills content -->
            </div>
        </div>
        </div>
    </div>

<?php
unset($_SESSION['isLogin']);
require "footer.php";
?>