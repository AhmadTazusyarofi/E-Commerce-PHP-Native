<?php
session_start();
include "../config/koneksi.php";

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

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.min.css">


    <!-- style -->
    <link rel="stylesheet" href="../assets/css/main.css" />

    <title>Halaman Keranjang</title>
</head>

<body>
    <header class="top-header py-1">
        <div class="d-flex justify-content-between align-items-center">
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
                <a href="../pages/logout.php" class="btn btn-sm btn-contact-info font-weight-bold"><i
                        class="bi bi-box-arrow-right mr-2 text-center"></i>Logout</a>
                <a href="../pages/profil.php" id="btn-user"><i class='bx bx-user-circle bx-icon'></i></a>
                <?php else: ?>
                <a href="../pages/login.php" class="btn btn-sm btn-contact-info">Login</a>
                <a href="../pages/daftar.php" class="btn btn-sm btn-contact-info">Daftar</a>
                <?php endif; ?>
            </div>
        </div>
    </header>
    <!-- nav header start -->
    <nav class=" navbar sticky-top">
        <a href="index.php" class="navbar-logo">Fashion-<span>Shop</span></a>

        <div class="navbar-menu">
            <a href="../index.php">Beranda</a>
            <a href="#about">Tentang Kami</a>
            <a href="../pages/produk.php">Produk</a>
            <a href="#kontak">Kontak</a>

        </div>

        <!-- toggle -->
        <div class="navbar-icon">
            <a href="#"><i class="fas fa-search"></i></a>
            <a href="keranjang.php"><i class="bi bi-cart-dash-fill"></i></a>
            <a href="#" id="btn-menu"><i class="fas fa-bars"></i></a>
        </div>
    </nav>
    <!-- nav header end -->

    <!-- section produk start -->
    <section class="page-keranjang">
        <div class="container">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../index.php">Beranda</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Keranjang Belanja</li>
                </ol>
            </nav>

            <div class="card box">
                <div class="card-header" style="background-color: #40534c;">
                    <h4 class="text-white">Keranjang Belanja</h4>
                </div>
                <div class="card-body">
                    <?php if (empty($_SESSION['keranjang_belanja'])): ?>
                    <p>Anda Mempunyai (0) items di dalam keranjang belanja</p>
                    <?php else: ?>

                    <?php
                        $items = 0;
                        foreach ($_SESSION['keranjang_belanja'] as $id_produk => $jumlah) {
                            $items++;
                        }
                        ?>
                    <p>Anda Mempunyai (<?php echo $items; ?>) items di dalam keranjang belanja</p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="card mt-4 mb-4">
                <div class="table-responsive">
                    <div class="card-body">
                        <table class="table table-hover table-stripped" id="tables">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Foto</th>
                                    <th>Produk</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Subtotal</th>
                                    <th>Opsi</th>
                                </tr>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($_SESSION['keranjang_belanja'] as $id_produk => $jumlah):
                                    // ambil data
                                    $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
                                    $pecah = $ambil->fetch_assoc();

                                    // subtotal
                                    $subtotal = $pecah['harga_produk'] * $jumlah;
                                ?>
                                <tr>
                                    <td width="25px"><?php echo $no++; ?></td>
                                    <td>
                                        <img src="../assets/foto_produk/<?php echo $pecah['foto_produk']; ?>"
                                            width="90">
                                    </td>
                                    <td><?php echo $pecah['nama_produk']; ?></td>
                                    <td><?php echo $jumlah; ?></td>
                                    <td>Rp.<?php echo number_format($pecah['harga_produk']); ?></td>
                                    <td>Rp.<?php echo number_format($subtotal); ?></td>
                                    <td width="25px">
                                        <a href="../includes/hapus_keranjang.php?idproduk=<?php echo $pecah['id_produk']; ?>"
                                            class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach ?>
                            </tbody>

                            </thead>
                        </table>
                    </div>

                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-10">
                                <a href="../pages/produk.php" class="btn btn-info">
                                    Kembali Belanja
                                </a>
                                <a href="checkout.php" class="btn btn-success ml-3">
                                    Checkout
                                </a>
                            </div>
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

    <?php
    if (empty($_SESSION['keranjang_belanja']) or !isset($_SESSION['keranjang_belanja'])) {
        // echo "<script>alert('tidak ada data');</script>";
        // echo "<script>location='../pages/produk.php';</script>";

        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script>
    Swal.fire({
        icon: 'question',
        title: 'Tidak Ada Data Didalam Keranjang',
        text: 'Silahkan Melakukan Pembelian!',
        confirmButtonText: 'OK'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '../pages/produk.php';
        }
    });
    </script>";
    }
    ?>

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