<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>

<div class="card">
    <div class="card-header">
        <h5 class="text-dark">Pembayaran</h5>
    </div>
</div>

<?php
$id_pembelian = $_GET['id'];

$ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pembelian='$id_pembelian'");
$pecah = $ambil->fetch_assoc();

?>


<div class="alert alert-info text-dark mt-3">
    Total Tagihan: Rp. <?php echo number_format($pecah['total_pembelian']); ?>
</div>

<div class="shadow bg-white p-3 mb-3 rounded">
    <form method="POST" enctype="multipart/form-data">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Nama:</label>
            <div class="col-sm-9">
                <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap Anda" required>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Bank:</label>
            <div class="col-sm-9">
                <select name="bank" class="form-control" required>
                    <option selected disabled>Pilih Metode Pembayaran</option>
                    <option value="bri">BRI</option>
                    <option value="bca">BCA</option>
                    <option value="mandiri">Mandiri</option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Jumlah:</label>
            <div class="col-sm-9">
                <input type="text" name="jumlah" class="form-control" value="<?php echo $pecah['total_pembelian'] ?>"
                    readonly>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Bukti:</label>
            <div class="col-sm-9">
                <input type="file" name="bukti" class="form-control" required>
                <small class="text-danger">Foto Bukti Harus jpg/png</small>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-3 col-form-label"></label>
            <div class="col-sm-9">
                <button name="kirim" class="btn btn-primary">Kirim</button>
                <a href="profil.php?page=pesanan" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </form>
</div>

<?php
if (isset($_POST['kirim'])) {
    $nama = $_POST['nama'];
    $bank = $_POST['bank'];
    $jumlah = $_POST['jumlah'];
    $tanggal = date('Y-m-d');


    $nama_bukti = $_FILES['bukti']['name'];
    $lokasi_bukti = $_FILES['bukti']['tmp_name'];
    $tgl_bukti = date('YmdHis') . $nama_bukti;

    move_uploaded_file($lokasi_bukti, "../assets/foto_bukti/" . $tgl_bukti);

    //menyimpan ke tabel pembayaran
    $koneksi->query("INSERT INTO pembayaran
    (id_pembelian,nama,bank,jumlah,tanggal,bukti)
    VALUES ('$id_pembelian','$nama','$bank','$jumlah','$tanggal','$tgl_bukti')");

    // update tabel pembelian
    $koneksi->query("UPDATE pembelian SET status='Sedang diproses'
     WHERE id_pembelian='$id_pembelian'");

    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script>
    Swal.fire({
        icon: 'success',
        title: 'Pembayaran Terkirim',
        confirmButtonText: 'OK'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = 'profil.php?page=pesanan';
        }
    });
    </script>";
}

?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.all.min.js"></script>