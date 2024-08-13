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
                                        <h1 class="h3 text-dark mb-4"><strong>Daftar</strong>
                                        </h1>
                                    </div>
                                    <form method="post" class="user" enctype="multipart/form-data">
                                        <div class="form-group d-flex align-items-center">
                                            <i class="fas fa-user fa-fw mr-2"></i>
                                            <input type="text" name="nama" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Nama Lengkap" />
                                        </div>
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
                                        <div class="form-group d-flex align-items-center mt-3">
                                            <i class="fa-solid fa-phone fa-fw mr-2"></i>
                                            <input type="number" name="nohp" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="No Handphone" />
                                        </div>
                                        <div class="form-group d-flex align-items-center mt-3">
                                            <i class="fa-solid fa-location-arrow fa-fw mr-2"></i>
                                            <textarea type="text" name="alamat" class="form-control
                                                form-control-user" id="exampleInputPassword" placeholder="Alamat"
                                                required> </textarea>
                                        </div>
                                        <div class="form-group d-flex align-items-center mt-3">
                                            <i class="fa-solid fa-image fa-fw mr-2"></i>
                                            <input type="file" name="foto" class="form-control" required>
                                        </div>

                                        <button name="daftar" class="btn btn-user btn-block btn-login">
                                            Daftar
                                        </button>
                                        <hr>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php

    if (isset($_POST['daftar'])) {
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $password = sha1($_POST['password']);
        $nohp = $_POST['nohp'];
        $alamat = $_POST['alamat'];

        $namafoto = $_FILES['foto']['name'];
        $lokasifoto = $_FILES['foto']['tmp_name'];

        move_uploaded_file($lokasifoto, "../assets/foto_pelanggan/" . $namafoto);

        // jika email sama
        $ambil = $koneksi->query("SELECT * FROM pelanggan
        WHERE email_pelanggan='$email'");
        $ada_email = $ambil->num_rows;
        if ($ada_email==1) {
            echo "<script>alert('Email Sudah Ada');</script>";
            echo "<script>location='daftar.php';</script>";
        } else {
            $koneksi->query("INSERT INTO pelanggan(nama_pelanggan,email_pelanggan,password_pelanggan,telepon_pelanggan,alamat_pelanggan,foto_pelanggan)
            VALUES('$nama', '$email', '$password', '$nohp', '$alamat', '$namafoto')");

            echo "<script>alert('Daftar Berhasil');</script>";
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