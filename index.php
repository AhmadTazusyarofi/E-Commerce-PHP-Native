<?php

session_start();

include "config/koneksi.php";

$produk = array();

$ambil = $koneksi->query("SELECT * FROM produk join kategori ON
produk.id_kategori=kategori.id_kategori LIMIT 8");
while ($pecah =
    $ambil->fetch_assoc()
) {
    $produk[] = $pecah;
} ?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- boxicons -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />

    <!-- Custom fonts for this template-->
    <link href="./assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />

    <!-- Custom styles for this template-->
    <link href="./assets/css/sb-admin-2.min.css" rel="stylesheet" />

    <!-- Custom styles for this page -->
    <link href="./assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- style -->
    <link rel="stylesheet" href="./assets/css/main.css" />

    <title>E-Commerce</title>
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
                <a href="./pages/logout.php" class="btn btn-sm btn-contact-info font-weight-bold"><i
                        class="bi bi-box-arrow-right mr-2 text-center"></i>Logout</a>
                <a href="./pages/profil.php" id="btn-user"><i class='bx bx-user-circle bx-icon'></i></a>
                <?php else: ?>
                <a href="./pages/login.php" class="btn btn-sm btn-contact-info">Login</a>
                <a href="./pages/daftar.php" class="btn btn-sm btn-contact-info">Daftar</a>
                <?php endif; ?>
            </div>
        </div>
    </header>
    <!-- nav header start -->
    <nav class=" navbar sticky-top">
        <a href="index.php" class="navbar-logo">Fashion-<span>Shop</span></a>

        <div class="navbar-menu">
            <a href="#">Beranda</a>
            <a href="#about">Tentang Kami</a>
            <a href="pages/produk.php">Produk</a>
            <a href="#kontak">Kontak</a>

        </div>

        <!-- toggle -->
        <div class="navbar-icon">
            <a href="#"><i class="fas fa-search"></i></a>
            <a href="includes/keranjang.php"><i class="bi bi-cart-dash-fill"></i></a>
            <a href="#" id="btn-menu"><i class="fas fa-bars"></i></a>
        </div>
    </nav>
    <!-- nav header end -->

    <!-- hero section start -->
    <section class="header" id="header">
        <div class="container">
            <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
                <div class="carousel-inner">

                    <div class="carousel-item active">
                        <img src="assets/images/header2.jpg" class="d-block w-100" style="object-fit: cover;">
                        <div class="carousel-caption d-none d-md-block">
                            <h5 class="fs-2 caption">Belanja Dari Rumah di Fashion-Shop</h5>
                            <a class="btn btn-custom mt-3">Belanja Sekarang
                                <i class="bi bi-arrow-down ms-2"></i>
                            </a>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <img src="assets/images/header3.jpg" class="d-block w-100" style="object-fit: cover;">
                        <div class="carousel-caption d-none d-md-block">
                            <h5 class="fs-2 caption">Satu Klik untuk Penampilan Sempurna.</h5>
                            <button class="btn btn-primary btn-cta mt-3">Belanja Sekarang</button>
                        </div>
                    </div>

                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </section>
    <!-- hero section end -->

    <!-- produk section start -->
    <section class="produk" id="produk">
        <div class="container">
            <h2 class="judul"><span>Produk </span>Kami</h2>

            <a href="pages/produk.php" class="btn btn-sm btn-custom">
                View <span> All</span>
                <i class="bi bi-arrow-right ms-2"></i>
            </a>


            <div class="row mt-3">
                <?php foreach (
                    $produk as $key =>
                    $value
                ): ?>

                <div class="col-lg-3 col-6">
                    <div class="card card-body p-lg-4 p-3">
                        <img src="assets/foto_produk/<?php echo $value['foto_produk']; ?>" class="img-fluid"
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
                        <div class="detail d-flex justify-content-between mt-4">
                            <a href="includes/detail_produk.php?idproduk=<?php echo $value['id_produk']; ?>"
                                class="btn btn-sm btn-primary text-white"><i class="bi bi-eye mr-2"></i>Detail</a>
                            <a href="includes/beli.php?idproduk=<?php echo $value['id_produk']; ?>"
                                class="btn btn-sm btn-success"><i class="bi bi-bag-dash-fill mr-2"></i>Beli</a>
                        </div>
                    </div>
                </div>
                <?php endforeach ?>
            </div>
        </div>
    </section>
    <!-- produk section end -->

    <!-- about section start -->
    <section class="about" id="about">
        <div class="container">
            <h2 class="judul"><span>Tentang </span>Kami</h2>
            <div class="row">
                <!-- Kolom gambar -->
                <div class="col-md-6 about-img">
                    <img src="assets/images/about.jpg" alt="" class="img-fluid" />
                </div>
                <!-- Kolom teks -->
                <div class="col-md-6 content">
                    <h3 class="mt-4">Kenapa Memilih Produk Kami?</h3>
                    <p class="mt-4 text-muted">
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eius
                        esse necessitatibus saepe voluptas. Ipsa error in, minus
                        architecto cupiditate fugit!
                    </p>
                    <p class="text-muted">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque
                        nostrum aperiam obcaecati animi cupiditate fugiat modi dolor
                        deleniti quam excepturi.
                    </p>
                    <a href="#" class="btn btn-success btn-about mt-3 mt-sm-3">Read More</a>
                </div>
            </div>
        </div>
    </section>
    <!-- about section end -->

    <!-- kontak start -->
    <section class="kontak" id="kontak">
        <div class="container">
            <h2 class="judul"><span>Kontak</span>Kami</h2>
            <div class="row">
                <div class="col-md-6 kontak-map">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.744420476265!2d106.79987209999997!3d-6.553915899999989!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c40dd4189aa5%3A0x7aa18d1f391951f9!2sBogor%20Modern%20Residence!5e0!3m2!1sid!2sid!4v1722095261777!5m2!1sid!2sid"
                        allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <div class="col-md-6 kontak-form">
                    <div class="container">
                        <h3 class="mb-4">Kontak Saran</h3>
                        <form onsubmit="sendMessage()">
                            <div class="formKontakKiri">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="name" name="nama"
                                        placeholder="Nama Lengkap" required />
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                                        required />
                                </div>
                                <div class="form-group">
                                    <input type="number" class="form-control" id="number" name="number"
                                        placeholder="Nomor Telepon" required />
                                </div>
                            </div>
                            <div class="formKontakKanan">
                                <div class="form-group">
                                    <textarea name="pesan" id="message" cols="30" rows="8" class="form-control"
                                        placeholder="Masukan Pesan Disini" required></textarea>
                                </div>
                                <button type="submit" name="kirim" class="btn btn-kirim float-right">
                                    Kirim
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- kontak end -->


    <!-- footer start -->
    <footer>
        <div class="container pt-5">
            <div class="row row-content">
                <div class="col-md-6">
                    <h1 class="logo-brand">Fashion-<span>Shop</span></h1>
                    <p class="text-white">Tempat Belanja Pakaian Termurah.</p>
                </div>

                <div class="col-md-3 mt-4 mt-sm-0 navigasi">
                    <h3 class="mb-3">Navigation</h3>
                    <ul class="p-0">
                        <li><a href="#">Beranda</a></li>
                        <li class="mt-3">
                            <a href="#about">Tentang Kami</a>
                        </li>
                        <li class="mt-3"><a href="pages/produk.php">Produk</a></li>
                        <li class="mt-3"><a href="#kontak">Kontak</a></li>
                    </ul>
                </div>

                <div class="col-md-3 mt-4 mt-sm-0">
                    <h3 class="mb-3">Sosial Media</h3>
                    <ul class="footer-sosial">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                    </ul>
                </div>

                <div class="row content-copy">
                    <div class="col-md-12">
                        <p class="text-white content-copy-p">
                            &copy; 2024 <strong>E-Commerce</strong>, All rights reserved.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer end -->

    <!-- whatsapp -->
    <a href="https://wa.me/6285624318915" class="floating-whatsapp animated" target="_blank">
        <i class="fab fa-whatsapp" id="icon-whatsapp"></i>
        <p class="floating-whatsapp-text ml-2">
            Butuh Bantuan? <b>Hubungi Admin</b>
        </p>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="./assets/vendor/jquery/jquery.min.js"></script>
    <script src="./assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="./assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="./assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="./assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="./assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="assets/js/demo/datatables-demo.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>

    <script src="assets/js/main.js"></script>
</body>

</html>