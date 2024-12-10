<?php
session_start();

$id_produk = $_GET['idproduk'];

// jika produk di klik keranjang
if (isset($_SESSION['keranjang_belanja'][$id_produk])) {
    // jika produk dengan idproduk yang sama diklik 1 x / lebih dalam keranjang maka
    $_SESSION['keranjang_belanja'][$id_produk]+=1;
} else {
    // jika keranjang nya kosong
    $_SESSION['keranjang_belanja'][$id_produk]=1;
}


//

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beli</title>

    <!-- Link CDN SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>

<body>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
    Swal.fire({
        title: 'Produk Berhasil Ditambahkan Ke dalam Keranjang!',
        text: 'Silahkan Cek dan Lakukan Checkout Barang Anda',
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