<?php

session_start();

include "../config/koneksi.php";

if (!isset($_SESSION['pelanggan']['id_pelanggan'])) {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
        Swal.fire({
            icon: 'error',
            title: 'Silahkan Login Terlebih Dahulu',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '../pages/login.php';
            }
        });
        </script>";
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

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="../bootstrap-5.2.3/dist/css/bootstrap.min.css">

    <!-- style -->
    <link rel="stylesheet" href="../assets/css/main.css" />

    <title>Halaman Profil</title>
</head>

<body>
    <header class="top-header py-1">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="social-icons d-flex align-items-center">
                <a href="#" class=" me-2"><i class="bx bxl-facebook"></i></a>
                <a href="#" class=" me-2"><i class="bx bxs-phone"></i></a>
                <a href="#" class=" me-2"><i class="bx bxl-whatsapp"></i></a>
                <a href="#" class=" me-2"><i class="bx bxl-instagram-alt"></i></a>
                <p class="mb-1 ml-2"> | </p>
                <p class="mb-1 ml-2 text-dark">Follow Us</p>
            </div>
            <div class="contact-info d-flex align-items-center">
                <?php if (isset($_SESSION['pelanggan'])): ?>
                <a href="logout.php" class="btn btn-sm btn-contact-info font-weight-bold"><i
                        class="bi bi-box-arrow-right mr-2 text-center"></i>Logout</a>
                <a href="profil.php" id="btn-user"><i class='bx bx-user-circle bx-icon'></i></a>
                <?php else: ?>
                <a href="login.php" class="btn btn-sm btn-contact-info">Login</a>
                <a href="daftar.php" class="btn btn-sm btn-contact-info">Daftar</a>
                <?php endif; ?>
            </div>
        </div>
    </header>
    <!-- nav header start -->
    <nav class=" navbar sticky-top">
        <div class="container">
            <a href="index.php" class="navbar-logo">Fashion-<span>Shop</span></a>

            <div class="navbar-menu">
                <a href="../index.php">Beranda</a>
                <a href="#about">Tentang Kami</a>
                <a href="produk.php">Produk</a>
                <a href="#kontak">Kontak</a>

            </div>

            <!-- toggle -->
            <div class="navbar-icon">
                <a href="#"><i class="fas fa-search"></i></a>
                <a href="../includes/keranjang.php"><i class="bi bi-cart-dash-fill"></i></a>
                <a href="#" id="btn-menu"><i class="fas fa-bars"></i></a>
            </div>
        </div>
    </nav>
    <!-- nav header end -->


    <!-- section produk start -->
    <section class="page-produk">
        <div class="container">

            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Profil</li>
                </ol>
            </nav>

            <div class="row">

                <div class="col-md-3">
                    <div class="card rounded mb-3 mb-lg-0">

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
                                    <a href="profil.php" class="nav-link">
                                        <i class='bx bxs-home'></i><span class="ml-2">Home</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="profil.php?page=pesanan" class="nav-link">
                                        <i class='bx bxs-cart'></i><span class="ml-2">Pesanan</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="profil.php?page=riwayat" class="nav-link">
                                        <i class='bx bx-history'></i><span class="ml-2">Riwayat Belanja</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="profil.php?page=setting" class="nav-link">
                                        <i class='bx bxs-cog'></i><span class="ml-2">Setting</span>
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

                            if (isset($_GET['page'])) {
                                if ($_GET['page'] == "pesanan") {
                                    include 'pesanan.php';
                                } elseif ($_GET['page'] == "detail_pembelian") {
                                    include 'detail_pembelian.php';
                                } elseif ($_GET['page'] == "setting") {
                                    include 'setting.php';
                                } elseif ($_GET['page'] == "ubah_password") {
                                    include 'ubah_password.php';
                                } elseif ($_GET['page'] == "pembayaran") {
                                    include 'bayar.php';
                                } elseif ($_GET['page'] == "detail_pembayaran") {
                                    include 'detail_pembayaran.php';
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.all.min.js"></script>

    <script src="../assets/js/main.js"></script>
</body>

</html>