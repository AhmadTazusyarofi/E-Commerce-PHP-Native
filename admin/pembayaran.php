<div class="shadow p-3 mb-3 bg-white rounded text-dark">
    <h5><b>Halaman Pembayaran</b></h5>
</div>


<?php

$id_pembelian = $_GET['id'];

$ambil = $koneksi->query("SELECT * FROM pembayaran
    WHERE id_pembelian='$id_pembelian'");

$pecah = $ambil->fetch_assoc();

?>

<div class="card shadow bg-white">
    <div class="card-body row">
        <div class="col-md-8">
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>Nama Pelanggan</th>
                        <td><?php echo $pecah['nama']; ?></td>
                    </tr>
                    <tr>
                        <th>Nama Bank</th>
                        <td><?php echo $pecah['bank']; ?></td>
                    </tr>
                    <tr>
                        <th>Jumlah</th>
                        <td><?php echo $pecah['jumlah']; ?></td>
                    </tr>
                    <tr>
                        <th>Tanggal</th>
                        <td><?php echo $pecah['tanggal']; ?></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="col-md-4">
            <img src="../assets/foto_bukti/<?php echo $pecah['bukti']; ?>" width="250"
                class="img-thumbnail img-responsive">
        </div>
    </div>

    <div class="card-footer">
        <form method="post">

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">No.Resi Pengiriman</label>
                <div class="col-sm-9">
                    <input type="text" name="resi" class="form-control" placeholder="No.Resi Pengiriman">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Status</label>
                <div class="col-sm-9">
                    <select name="status" class="form-control">
                        <option selected disabled>Pilih Status</option>
                        <option value="pembayaran dikonfirmasi">Konfirmasi</option>
                        <option value="barang dikirim">Barang Dikirim</option>
                        <option value="pengiriman dibatalkan">Pengiriman Dibatalkan</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label"></label>
                <div class="col-sm-9">
                    <button name="proses" class="btn btn-primary">Proses</button>
                    <a href="index.php?halaman=pembelian" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        </form>
    </div>
</div>


<?php
if (isset($_POST['proses'])) {
    $resi = $_POST['resi'];
    $status = $_POST['status'];

    $koneksi->query("UPDATE pembelian SET
resi_pengiriman='$resi',
status='$status'
WHERE id_pembelian='$id_pembelian'");

    echo "<script>
alert('Data Pembelian Berhasil Di Update');
</script>";
    echo "<script>
location = 'index.php?halaman=pembelian';
</script>";
    exit();
}
?>