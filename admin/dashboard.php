<?php

// Query untuk menghitung jumlah pengguna, produk, kategori, dan pembelian
$queries = [
    'total_pengguna' => "SELECT COUNT(*) AS total_pengguna FROM pelanggan",
    'total_produk' => "SELECT COUNT(*) AS total_produk FROM produk",
    'total_kategori' => "SELECT COUNT(*) AS total_kategori FROM kategori",
    'total_pembelian' => "SELECT COUNT(*) AS total_pembelian FROM pembelian"
];

// Array untuk menyimpan hasil
$results = [];

foreach ($queries as $key => $query) {
    $result = mysqli_query($koneksi, $query);
    $results[$key] = $result ? mysqli_fetch_assoc($result)[$key] : 0;
}

?>


<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="../assets/css/main.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <div class="shadow p-3 mb-3 bg-white rounded">
        <h5><b>Selamat Datang <strong><?php echo $_SESSION['admin']['nama_lengkap'] ?></strong>
                Anda Login Sebagai <strong>Administrator.</strong></b></h5>
    </div>

    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <!-- Small Box (Stat card) -->
            <div class="row mt-3">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box text-bg-primary p-3 rounded-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="inner">
                                <h3 class="mt-2 mb-0"><?php echo number_format($results['total_pengguna']); ?></h3>
                                <p class="mb-0">Pengguna</p>
                            </div>
                            <svg class="small-box-icon" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                class="bi bi-people-fill" viewBox="0 0 16 16">
                                <path
                                    d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
                            </svg>
                        </div>
                        <a href="#"
                            class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover d-block text-center mt-2">
                            More info <i class="bi bi-link-45deg"></i>
                        </a>
                    </div>

                </div> <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box text-bg-success p-3 rounded-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="inner">
                                <h3 class="mt-2 mb-0"><?php echo number_format($results['total_produk']); ?></h3>
                                <p class="mb-0">Produk</p>
                            </div>
                            <svg class="small-box-icon" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 16 16">
                                <path
                                    d="M8.625 1.114a1.5 1.5 0 0 0-1.25 0l-6 3A1.5 1.5 0 0 0 1 5.447V10.5A1.5 1.5 0 0 0 1.875 12l6 3a1.5 1.5 0 0 0 1.25 0l6-3A1.5 1.5 0 0 0 15 10.553V5.5a1.5 1.5 0 0 0-.875-1.385l-6-3zM8 2.06c.123.062.226.158.3.274L13.5 5 8 7.94 2.5 5 7.7 2.334A.993.993 0 0 1 8 2.06zM2 6.5l5.5 2.75v5.385L2 11.885V6.5zm7 .115L14 6.5v5.385l-5 2.75V9.115z" />
                            </svg>

                        </div>
                        <a href="#"
                            class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover d-block text-center mt-2">
                            More info <i class="bi bi-link-45deg"></i>
                        </a>
                    </div>
                </div> <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box text-bg-warning p-3 rounded-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="inner">
                                <h3 class="mt-2 mb-0"><?php echo number_format($results['total_kategori']); ?></h3>
                                <p class="mb-0">Kategori</p>
                            </div>
                            <svg class="small-box-icon" fill="currentColor" viewBox="0 0 16 16"
                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path
                                    d="M3 1H1v2h2V1zm4 0H5v2h2V1zm4 0H9v2h2V1zm4 0h-2v2h2V1zM3 5H1v2h2V5zm4 0H5v2h2V5zm4 0H9v2h2V5zm4 0h-2v2h2V5zM3 9H1v2h2V9zm4 0H5v2h2V9zm4 0H9v2h2V9zm4 0h-2v2h2V9zM3 13H1v2h2v-2zm4 0H5v2h2v-2zm4 0H9v2h2v-2zm4 0h-2v2h2v-2z" />
                            </svg>

                        </div>
                        <a href="#"
                            class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover d-block text-center mt-2">
                            More info <i class="bi bi-link-45deg"></i>
                        </a>
                    </div>
                </div> <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box text-bg-danger p-3 rounded-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="inner">
                                <h3 class="mt-2 mb-0"><?php echo number_format($results['total_pembelian']); ?></h3>
                                <p class="mb-0">Pembelian</p>
                            </div>
                            <svg class="small-box-icon" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 16 16">
                                <path
                                    d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0M6.5 7h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1 0-1" />
                            </svg>
                        </div>
                        <a href="#"
                            class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover d-block text-center mt-2">
                            More info <i class="bi bi-link-45deg"></i>
                        </a>
                    </div>
                </div> <!-- ./col -->
            </div> <!-- /.row -->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content-->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>