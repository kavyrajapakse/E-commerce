<?php

require "connection.php";

?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thrift Estop</title>
    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />

</head>

<body class="mainb">
    <div class="container-fluid mt-1 d-flex justify-content-center">

        <div class="row align-content-center">

            <!--header -->
            <div class="col-12">
                <div class="row">
                    <div class="col-12 logo"></div>
                    <div class="col-12">
                        <p class="text-center" style="font-family:amatic;font-size: 35px;letter-spacing:3px;font-weight:bold;">
                            Welcome to THRIFT eSTOP </p>
                    </div>
                </div>
            </div>
            <!--header -->

            <!--signup box-->
            <div class="offset-lg-3 col-12 col-lg-6" id="signUpBox">
                <div class="row g-2">

                    <div class="col-12 text-center">
                        <p class="title2">SIGN UP</p>
                    </div>

                    <div class="col-12 d-none" id="msgdiv">
                        <div class="alert alert-danger" role="alert" id="msg">

                        </div>
                    </div>

                    <div class="col-6">
                        <label class="form-label">First Name</label>
                        <input class="form-control" type="text" placeholder="ex:Rosanna" id="fname" />
                    </div>

                    <div class="col-6">
                        <label class="form-label">Last Name</label>
                        <input class="form-control" type="text" placeholder="ex:Fitze" id="lname" />
                    </div>

                    <div class="col-12">
                        <label class="form-label">Email</label>
                        <input class="form-control" type="email" placeholder="ex:rosanna@gmail.com" id="email" />
                    </div>

                    <div class="col-6">
                        <label class="form-label">Password</label>
                        <input class="form-control" type="password" placeholder="ex:*******" id="password" />
                    </div>

                    <div class="col-6">
                        <label class="form-label">Mobile</label>
                        <input class="form-control" type="text" placeholder="ex:0776757866" id="mobile" />
                    </div>

                    <div class="col-6">
                        <label class="form-label">Gender</label>
                        <select class="form-control" id="gender">
                            <option>Select your gender</option>
                            <?php
                            $gender_rs = Database::search("SELECT * FROM `gender`");
                            $gender_num = $gender_rs->num_rows;

                            for ($x = 0; $x < $gender_num; $x++) {
                                $gender_data = $gender_rs->fetch_assoc();
                            ?>
                                <option value="<?php echo $gender_data["id"]; ?>"><?php echo $gender_data["gender_name"]; ?></option>
                            <?php
                            }

                            ?>
                        </select>
                    </div>

                    <div class="col-6">
                        <label class="form-label">City</label>
                        <select class="form-control" id="city">
                            <option>Select your city</option>
                            <?php
                            $city_rs = Database::search("SELECT * FROM `city`");
                            $city_num = $city_rs->num_rows;

                            for ($x = 0; $x < $city_num; $x++) {
                                $city_data = $city_rs->fetch_assoc();
                            ?>
                                <option value="<?php echo $city_data["id"]; ?>"><?php echo $city_data["city_name"]; ?></option>
                            <?php
                            }

                            ?>
                        </select>
                    </div>

                    <div class="col-6 d-grid">
                        <button class="btn btn-secondary" onclick="signUp();">Sign Up</button>
                    </div>
                    <div class="col-6 d-grid">
                        <button class="btn btn-outline-dark" onclick="ChangeView();">
                            Existing user? Log In</button>
                    </div>

                </div>
            </div>
            <!--signup box-->

            <!--signin box-->

            <div class="offset-lg-4 col-12 d-none col-lg-4" id="signInBox">
                <div class="row g-3">

                    <div class="col-12 text-center">
                        <p class="title2">LOGIN</p>
                    </div>

                    <?php

                    $email = "";
                    $password = "";

                    if (isset($_COOKIE["email"])) {
                        $email = $_COOKIE["email"];
                    }

                    if (isset($_COOKIE["password"])) {
                        $password = $_COOKIE["password"];
                    }

                    ?>

                    <div class="col-12">
                        <label class="form-label">Email</label>
                        <input class="form-control" type="email" value="<?php echo $email; ?>" placeholder="ex:rosanna@gmail.com" id="logemail" />
                    </div>

                    <div class="col-12">
                        <label class="form-label">Password</label>
                        <input class="form-control" type="password" value="<?php echo $password; ?>" placeholder="********" id="logpassword" />
                        
                    </div>

                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="rememberme">
                            <label class="form-check-label" for="remember Me">
                                Remember Me
                            </label>
                        </div>
                    </div>

                    <div class="col-6 d-grid">
                        <button class="btn btn-secondary" onclick="logIn();">Log In</button>
                    </div>

                    <div class="col-6 d-grid">
                        <button class="btn btn-outline-dark" onclick="ChangeView();">Create New Account</button>
                    </div>

                    <div class="col-12 text-center">
                        <a href="#" class="link-secondary" onclick="lostPassword();">Lost your Password?</a>
                    </div>


                </div>
            </div>

            <!--signin box-->

            <!-- modal -->

            <div class="modal" tabindex="-1" id="forgotPasswordModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Lost your Password</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-3">

                                <div class="col-6">
                                    <label class="form-label">New Password</label>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" id="np" />
                                        <button class="btn btn-outline-secondary" type="button" id="npb" onclick="showPassword();">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label class="form-label">Retype New Password</label>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" id="rnp" />
                                        <button class="btn btn-outline-secondary" type="button" id="rnpb" onclick="showPassword2();">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Verification Code</label>
                                    <input type="text" class="form-control" id="vc" />
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-dark" onclick="resetPassword();">Reset Password</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- modal -->

            <!--footer-->
            <div class="col-12 d-none d-lg-block fixed-bottom mt-1">
                <p class="text-center">&copy; 2023 Thrift eStop | All Rights Reserved</p>
            </div>
            <!--footer-->
        </div>

    </div>

    <script src="script.js"></script>
    <script src="bootstrap.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>

</html>