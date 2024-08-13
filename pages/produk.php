<?php

session_start();

include "../config/koneksi.php";



if (isset($_GET['idkategori'])) {
    // jika ada idkategori di url
    $id_kategori = $_GET['idkategori'];

    $kategori_produk = array();

    $ambil = $koneksi->query("SELECT * FROM produk join kategori ON
    produk.id_kategori=kategori.id_kategori WHERE produk.id_kategori='$id_kategori' LIMIT 8"); 

    while ($pecah = $ambil->fetch_assoc()) {
        $kategori_produk[]=$pecah;
    }
} else {
    // jika tidak ada idkategori di url
    $produk = array();

    $ambil = $koneksi->query("SELECT * FROM produk join kategori ON
    produk.id_kategori=kategori.id_kategori LIMIT 8"); 

    while ($pecah = $ambil->fetch_assoc()) {
        $produk[]=$pecah;
    }
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

    <title>Halaman Produk</title>
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
                    <li class="breadcrumb-item"><a href="../index.php">Beranda</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Produk</li>
                </ol>
            </nav>

            <div class="row">
                <div class="col-md-3">
                    <?php include "../includes/sidebar.php" ?>
                </div>

                <div class="col-md-9">

                    <div class="card box box-card mb-4">
                        <div class="card-body">
                            <h3 class="font-font-weight-bolder">Produk Kami</h3>
                            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quis, accusantium. Eligendi
                                dolorum
                                vero aperiam ratione nesciunt modi ullam quasi ab!</p>
                        </div>
                    </div>

                    <div class="row">
                        <?php if (isset($_GET['idkategori'])): ?>
                        <?php foreach ($kategori_produk as $key => $value): ?>
                        <div class="col-lg-4 col-6 mb-4">
                            <div class="card card-body p-lg-4 p-3">
                                <img src="../assets/foto_produk/<?php echo $value['foto_produk']; ?>" class="img-fluid"
                                    style="border-radius: 10px" alt="" />
                                <h4 class="title mt-3"><?php echo $value['nama_produk']; ?></h4>
                                <div class="rating">
                                    <i class="bx bxs-star bx-star"></i>
                                    <i class="bx bxs-star bx-star"></i>
                                    <i class="bx bxs-star bx-star"></i>
                                    <i class="bx bxs-star bx-star"></i>
                                    <i class="bx bxs-star-fill bx-star"></i>
                                </div>
                                <p class="price m-0 mt-2">
                                    Rp.<?php echo number_format($value['harga_produk']); ?>
                                </p>
                                <div class="detail d-flex justify-content-between align-items-center mt-4">
                                    <a href="../includes/detail_produk.php?idproduk=<?php echo $value['id_produk']; ?>"
                                        class="btn btn-sm btn-info btn-produk"><i class="fas fa-eye mr-2"></i>Detail</a>
                                    <a href="../includes/beli.php?idproduk=<?php echo $value['id_produk']; ?>"
                                        class="btn btn-sm btn-success btn-produk"><i
                                            class="fas fa-shopping-cart mr-2"></i>Keranjang</a>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>

                        <?php else: ?>
                        <?php foreach ($produk as $key => $value): ?>
                        <div class="col-lg-4 col-6 mb-4">
                            <div class="card card-body p-lg-4 p-3">
                                <img src="../assets/foto_produk/<?php echo $value['foto_produk']; ?>" class="img-fluid"
                                    style="border-radius: 10px" alt="" />
                                <h4 class="title mt-3"><?php echo $value['nama_produk']; ?></h4>
                                <div class="rating">
                                    <i class="bx bxs-star bx-star"></i>
                                    <i class="bx bxs-star bx-star"></i>
                                    <i class="bx bxs-star bx-star"></i>
                                    <i class="bx bxs-star bx-star"></i>
                                    <i class="bx bxs-star-fill bx-star"></i>
                                </div>
                                <p class="price m-0 mt-2">
                                    Rp.<?php echo number_format($value['harga_produk']); ?>
                                </p>
                                <div class="detail d-flex justify-content-between align-items-center mt-4">
                                    <a href="../includes/detail_produk.php?idproduk=<?php echo $value['id_produk']; ?>"
                                        class="btn btn-sm btn-info"><i class="fas fa-eye mr-2"></i>Detail</a>
                                    <a href="../includes/beli.php?idproduk=<?php echo $value['id_produk']; ?>"
                                        class="btn btn-sm btn-success"><i
                                            class="fas fa-shopping-cart mr-2"></i>Keranjang</a>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                        <?php endif; ?>
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