<?php
session_start();
include "../config/koneksi.php";

// user tidak bisa checkout sebelu, login
if (!isset($_SESSION['pelanggan'])) {
    echo "<script>alert('Silahkan Login Terlebih Dahulu');</script>";
    echo "<script>location='../pages/login.php';</script>";
    exit();
}

$id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];

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

    <title>Halaman Checkout</title>
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
                    <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                </ol>
            </nav>

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
                                <th>Subharga</th>
                            </tr>
                        <tbody>
                            <?php
                            $no = 1;
                            $subtotal = 0;
                            foreach ($_SESSION['keranjang_belanja'] as $id_produk => $jumlah):
                                // ambil data
                                $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
                                $pecah = $ambil->fetch_assoc();

                                // subtotal
                                $subharga = $pecah['harga_produk'] * $jumlah;
                                $subberat = $pecah['berat_produk'] * $jumlah;
                                $totalbelanja = $subtotal+=$subharga;
                            ?>
                            <tr>
                                <td width="25px"><?php echo $no++; ?></td>
                                <td>
                                    <img src="../assets/foto_produk/<?php echo $pecah['foto_produk']; ?>" width="90">
                                </td>
                                <td><?php echo $pecah['nama_produk']; ?></td>
                                <td><?php echo $jumlah; ?></td>
                                <td>Rp.<?php echo number_format($pecah['harga_produk']); ?></td>
                                <td>Rp.<?php echo number_format($subharga); ?></td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>

                        <tfoot>
                            <tr>
                                <th colspan="5">Total Belanja :</th>
                                <th>Rp.<?php echo number_format($totalbelanja); ?></th>
                            </tr>
                        </tfoot>
                        </thead>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <input type="text" class="form-control"
                                value="<?php echo $_SESSION['pelanggan']['nama_pelanggan']; ?>" readonly>
                            <br>
                            <input type="text" class="form-control"
                                value="<?php echo $_SESSION['pelanggan']['email_pelanggan']; ?>" readonly>
                            <br>
                            <input type="text" class="form-control"
                                value="<?php echo $_SESSION['pelanggan']['telepon_pelanggan']; ?>" readonly>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">

                            <form method="post">

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Alamat</label>
                                    <div class="col-sm-9">
                                        <textarea type="text" name="alamat" class="form-control"
                                            placeholder="Masukan Alamat Rumah"></textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Provinsi :</label>
                                    <div class="col-sm-9">
                                        <select name="provinsi" class="form-control">

                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">District :</label>
                                    <div class="col-sm-9">
                                        <select name="district" class="form-control">

                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Ekspedisi :</label>
                                    <div class="col-sm-9">
                                        <select name="ekspedisi" class="form-control">

                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Paket :</label>
                                    <div class="col-sm-9">
                                        <select name="paket" class="form-control">

                                        </select>
                                    </div>
                                </div>

                                <input type="text" name="total_berat" class="form-control"
                                    value="<?php echo $subberat; ?>" hidden>
                                <input type="text" name="nama_provinsi" class="form-control" hidden>
                                <input type="text" name="nama_district" class="form-control" hidden>
                                <input type="text" name="type_district" class="form-control" hidden>
                                <input type="text" name="kode_pos" class="form-control" hidden>
                                <input type="text" name="nama_ekspedisi" class="form-control" hidden>
                                <input type="text" name="paket" class="form-control" hidden>
                                <input type="text" name="ongkir" class="form-control" hidden>
                                <input type="text" name="estimasi" class="form-control" hidden>

                                <div class="text-right">
                                    <button name="checkout" class="btn btn-success">Checkout</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- section produk end -->

    <?php
    if(isset($_POST['checkout'])){
        $id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];
        $tanggal_pembelian = date('y-m-d');
        $alamat = $_POST['alamat'];
        $berat = $_POST['total_berat'];
        $provinsi = $_POST['nama_provinsi'];
        $district = $_POST['nama_district'];
        $type = $_POST['type_district'];
        $pos = $_POST['kode_pos'];
        $ekspedisi = $_POST['nama_ekspedisi'];
        $paket = $_POST['paket'];
        $ongkir = $_POST['ongkir'];
        $estimasi = $_POST['estimasi'];
        $total_pembelian = $totalbelanja+$ongkir;

        // simpan kedalam tbl pembelian
        $koneksi->query("INSERT INTO pembelian
        (id_pelanggan, tanggal_pembelian, total_pembelian, alamat, total_berat, provinsi,
        district, type_district, kode_pos,ekspedisi,paket,ongkir,estimasi)
        VALUES ('$id_pelanggan','$tanggal_pembelian','$total_pembelian','$alamat',
        '$berat','$provinsi','$district','$type','$pos','$ekspedisi','$paket','$ongkir','$estimasi')");

        // id pembelian baru
        $id_pembelian_baru = $koneksi->insert_id;

        // mengambil field tbl pembelian_produk
        foreach ($_SESSION['keranjang_belanja'] as $id_produk => $jumlah) {
            $ambil = $koneksi->query("SELECT * FROM produk
            WHERE id_produk='$id_produk'");
            $pecah = $ambil->fetch_assoc();
            $nama = $pecah['nama_produk'];
            $harga = $pecah['harga_produk'];
            $berat = $pecah['berat_produk'];
            $subberat = $pecah['berat_produk']*$jumlah;
            $subharga = $pecah['harga_produk']*$jumlah;

            // simpan ke dalam tbl pembelian_produk
            $koneksi->query("INSERT INTO pembelian_produk
            (id_pembelian,id_produk,nama,harga,berat,subberat,subharga,jumlah)
            VALUES ('$id_pembelian_baru','$id_produk','$nama','$harga','$berat','$subberat','$subharga','$jumlah')");

            // update stok di tbl produk
            $koneksi->query("UPDATE produk SET stok_produk = stok_produk - $jumlah WHERE id_produk = '$id_produk'");

        }

        // kosongkan keranjang jika sudah checkout
        unset($_SESSION['keranjang_belanja']);
        echo "<script>alert('Pembelian Sukses');</script>";
        echo "<script>location='../pages/profil.php?page=pesanan';</script>";
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

    <!-- Page level custom scripts -->
    <script src="../assets/js/demo/datatables-demo.js"></script>

    <script src="../assets/js/main.js"></script>
</body>

</html>