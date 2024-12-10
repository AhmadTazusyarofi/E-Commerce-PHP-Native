<?php

session_start();

$id_produk = $_GET['idproduk'];

unset($_SESSION['keranjang_belanja'][$id_produk]);

// echo "<script>alert('keranjang berhasil dihapus');</script>";
// echo "<script>location='keranjang.php';</script>";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>

    <!-- Link CDN SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>

<body>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
    Swal.fire({
        title: 'Keranjang Berhasil Dihapus!',
        text: 'Silahkan Belanja Kembali!',
        icon: 'success',
        confirmButtonText: 'OK'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = 'keranjang.php';
        }
    });
    </script>

</body>

</html>