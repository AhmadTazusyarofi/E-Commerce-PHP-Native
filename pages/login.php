<?php
session_start();

include "../config/koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>SB Admin 2 - Login</title>

    <!-- Custom fonts for this template-->
    <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />

    <!-- Custom styles for this template-->
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="stylesheet" href="../assets/css/main.css" />
</head>

<body>
    <br /><br /><br /><br />

    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h3 text-dark mb-4"><strong>E-<span
                                                    style="color: #bec6a0; font-style: italic;">Commerce</span></strong>
                                        </h1>
                                    </div>
                                    <form method="post" class="user">
                                        <div class="form-group d-flex align-items-center">
                                            <i class="fa-solid fa-envelope fa-fw mr-2"></i>
                                            <input type="email" name="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="E-mail" />
                                        </div>
                                        <div class="form-group d-flex align-items-center mt-3">
                                            <i class="fas fa-lock fa-fw mr-2"></i>
                                            <input type="password" name="password"
                                                class="form-control form-control-user" id="exampleInputPassword"
                                                placeholder="Password" />
                                        </div>

                                        <button name="login" class="btn btn-user btn-block btn-login">
                                            Login
                                        </button>
                                        <hr>
                                    </form>
                                    <hr />
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register.html">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php

    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = sha1($_POST['password']);

        $ambil = $koneksi->query("SELECT * FROM pelanggan
        WHERE email_pelanggan='$email'
        AND password_pelanggan='$password'");

        $akun = $ambil->num_rows;

        if ($akun==1) {
            $_SESSION['pelanggan'] = $ambil->fetch_assoc();
            echo "<script>alert('Login Berhasil');</script>";
            echo "<script>location='../index.php';</script>";
        } else{
            echo "<script>alert('Login Gagal');</script>";
            echo "<script>location='login.php';</script>";
        }
    }

    ?>


    <!-- Bootstrap core JavaScript-->
    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../assets/js/sb-admin-2.min.js"></script>
</body>

</html>