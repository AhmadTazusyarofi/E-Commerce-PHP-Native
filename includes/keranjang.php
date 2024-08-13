<?php
session_start();
include "../config/koneksi.php";

if (empty($_SESSION['keranjang_belanja']) OR !isset($_SESSION['keranjang_belanja'])) {
    echo "<script>alert('tidak ada data');</script>";
    echo "<script>location='../pages/produk.php';</script>";
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

    <!-- style -->
    <link rel="stylesheet" href="../assets/css/main.css" />

    <title>Halaman Keranjang</title>
</head>

<body>
    <!-- nav header start -->
    <?php include "../includes/navbar.php"; ?>
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
                    <p>Anda mempunyai (4) items di dalam keranjang</p>
                </div>
            </div>

            <div class="card mt-4 mb-4">
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
                                    <img src="../assets/foto_produk/<?php echo $pecah['foto_produk']; ?>" width="90">
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