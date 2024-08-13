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


echo "<script>alert('produk ditambahkan ke dalam keranjang');</script>";
echo "<script>location='../includes/keranjang.php';</script>";

?>