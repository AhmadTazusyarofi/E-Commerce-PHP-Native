<?php
session_start();
include "../config/koneksi.php";

$id_produk = $_GET['idproduk'];

$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
$produk = $ambil->fetch_assoc();

$produkfoto = array();
$ambil = $koneksi->query("SELECT * FROM produk_foto WHERE id_produk='$id_produk'");

while ($pecah = $ambil->fetch_assoc()) {
    $produkfoto[] = $pecah;
}

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

    <!-- style -->
    <link rel="stylesheet" href="../assets/css/main.css" />
    <title>Halaman Detail Produk</title>
</head>

<body>
    <!-- nav header start -->
    <?php include "../includes/navbar.php"; ?>
    <!-- nav header end -->

    <!-- section produk start -->
    <section class="page-produk">
        <div class="container">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../pages/produk.php">Produk</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Detail Produk
                    </li>
                </ol>
            </nav>

            <div class="row">
                <div class="col-md-3">
                    <?php include "../includes/sidebar.php" ?>
                </div>

                <div class="col-md-9 detail-produk">
                    <div class="row">
                        <div class="col-6 mt-3 mt-lg-0 slide">
                            <div class="carousel slide" id="carouselDemo" data-bs-wrap="true" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <?php foreach ($produkfoto as $key => $value): ?>
                                    <div class="carousel-item <?php echo $key == 0 ? 'active' : ''; ?>"
                                        data-bs-interval="3000">
                                        <img src="../assets/foto_produk/<?php echo $value['nama_produk_foto']; ?>"
                                            class="w-100" />
                                    </div>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        </div>


                        <div class="col-6 card-detail-produk">
                            <form method="post">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="text-dark"><?php echo $produk['nama_produk']; ?></h5>
                                        <div class="formgroup row mb-3">
                                            <label class="col-sm-3 col-form-label">Jumlah :</label>
                                            <div class="col-sm-9">
                                                <input type="number" name="jumlah" class="form-control" value="1"
                                                    min="1" max="<?php echo $produk['stok_produk']; ?>">
                                            </div>
                                        </div>
                                        <div class="formgroup row mb-3">
                                            <label class="col-sm-3 col-form-label">Stok :</label>
                                            <div class="col-sm-9">
                                                <input disabled class="form-control"
                                                    value="<?php echo $produk['stok_produk']; ?>">
                                            </div>
                                        </div>
                                        <h5>Rp<?php echo number_format($produk['harga_produk']); ?></h5>

                                    </div>
                                    <div class="card-footer text-right">
                                        <button name="beli" class="btn btn-primary">
                                            <i class="fas fa-shopping-cart mr-2"></i>Keranjang
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card mt-4">
                            <div class="card-header card-detail">
                                <h5 class="text-white">Detail Produk</h5>
                            </div>
                            <div class="card-body">
                                <p class="text-dark"><?php echo $produk['deskripsi_produk']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <!-- section produk end -->

    <!-- tombol keranjang -->
    <?php

    if (isset($_POST['beli'])) {
        $jumlah = $_POST['jumlah'];

        $_SESSION['keranjang_belanja'][$id_produk] = $jumlah;

        // echo "<script>alert('produk berhasil masuk ke dalam keranjang');</script>";
        // echo "<script>location='keranjang.php';</script>";

        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
            Swal.fire({
                icon: 'success',
                title: 'Produk Berhasil Di Tambahkan Ke Dalam Keranjang',
                text: 'Silahkan Cek Kembali!',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'keranjang.php';
                }
            });
            </script>";
    }



    ?>

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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.all.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../assets/js/demo/datatables-demo.js"></script>

    <script src="../assets/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>

</html>