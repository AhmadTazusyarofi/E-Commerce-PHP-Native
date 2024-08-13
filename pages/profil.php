<?php

session_start();

include "../config/koneksi.php";

if (!isset($_SESSION['pelanggan']['id_pelanggan'])) {
    echo "<script>alert('Silahkan Login Terlebih Dahulu');</script>";
    echo "<script>location='../pages/login.php';</script>";
    exit();
}

$id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];

$ambil = $koneksi->query("SELECT * FROM pelanggan WHERE id_pelanggan='$id_pelanggan'");
$pecah = $ambil->fetch_assoc();


?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- boxicons -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />

    <!-- Custom fonts for this template-->
    <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />

    <!-- Custom styles for this template-->
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet" />

    <!-- Custom styles for this page -->
    <link href="../assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" />

    <!-- style -->
    <link rel="stylesheet" href="../assets/css/main.css" />

    <title>Halaman Profil</title>
</head>

<body>
    <!-- nav header start -->
    <nav class="navbar sticky-top">
        <a href="index.php" class="navbar-logo">E-<span>Commerce</span></a>

        <div class="navbar-menu">
            <a href="../index.php">Beranda</a>
            <a href="#about">Tentang Kami</a>
            <a href="pages/produk.php">Produk</a>
            <a href="#kontak">Kontak</a>

        </div>

        <!-- toggle -->
        <div class="navbar-icon">
            <a href="#"><i class="fas fa-search"></i></a>
            <a href="keranjang.php"><i class="fas fa-shopping-cart"></i></a>
            <a href="#" id="btn-user"><i class="fas fa-user"></i></a>
            <a href="#" id="btn-menu"><i class="fas fa-bars"></i></a>
        </div>

        <div class="user">
            <ul class="list-unstyled mt-3">
                <li><a href="#">
                        <i class="fas fa-user-plus mb-2 mr-2"></i> Profil
                    </a></li>
                <li><a href="./pages/logout.php">
                        <i class="fas fa-sign-in-alt mr-2"></i> Logout
                    </a></li>
            </ul>
        </div>
    </nav>
    <!-- nav header end -->

    <!-- section produk start -->
    <section class="page-produk">
        <div class="container">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../index.php">Beranda</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Profil</li>
                </ol>
            </nav>

            <div class="row">

                <div class="col-md-3">
                    <div class="card rounded">

                        <div class="card-header">
                            <div class="img">
                                <img src="../assets/foto_pelanggan/<?php echo $pecah['foto_pelanggan'] ?>" width="150"
                                    class="rounded-circle rounded mx-auto d-block" alt="">
                            </div>
                            <div class="card-title">
                                <h3 class="text-dark mt-3 text-center">
                                    <?php echo $pecah['nama_pelanggan']; ?>
                                </h3>
                            </div>
                        </div>

                        <div class="card-body">
                            <ul class="nav nav-pills flex-column text-center">
                                <li class="nav-item">
                                    <a href="index" class="nav-link">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a href="profil.php?page=pesanan" class="nav-link">
                                        Pesanan
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="profil.php?page=riwayat" class="nav-link">
                                        Riwayat Belanja
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="card">
                        <div class="card-body">

                            <?php

                            if(isset($_GET['page'])){
                                if($_GET['page']=="pesanan"){
                                    include 'pesanan.php';
                                }
                            } else {
                                include 'home.php';
                            }

                            ?>

                        </div>
                    </div>
                </div>
            </div>


        </div>
        </div>
    </section>
    <!-- section produk end -->

    <!-- footer start -->
    <?php include "../includes/footer.php" ?>
    <!-- footer end -->

    <!-- Bootstrap core JavaScript-->
    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../assets/js/demo/datatables-demo.js"></script>

    <script src="../assets/js/main.js"></script>
</body>

</html>