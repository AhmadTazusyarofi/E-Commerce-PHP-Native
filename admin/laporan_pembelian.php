<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<?php

$semuadata = array();

if (isset($_POST['cari'])) {
    $tglmulai = $_POST['tglm'];
    $tglselesai = $_POST['tgls'];
    $status = $_POST['status'];


    $ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan
    ON pembelian.id_pelanggan=pelanggan.id_pelanggan
    WHERE status='$status' AND tanggal_pembelian 
    BETWEEN '$tglmulai' AND '$tglselesai'");

    while ($pecah = $ambil->fetch_assoc()) {
        $semuadata[] = $pecah;
    }
}

?>

<div class="shadow p-3 mb-3 bg-white rounded text-dark">
    <h5><b>Halaman Laporan Pembelian</b></h5>
</div>


<div class="card shadow bg-white">
    <div class="card-body">
        <form method="post">
            <div class="row">
                <!-- Kolom Mulai -->
                <div class="col-md-4">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label"><b>Mulai</b></label>
                        <div class="col-sm-9">
                            <input type="date" name="tglm" class="form-control" value="<?php echo $tglmulai; ?>">
                        </div>
                    </div>
                </div>

                <!-- Kolom Selesai -->
                <div class="col-md-4">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label"><b>Selesai</b></label>
                        <div class="col-sm-9">
                            <input type="date" name="tgls" class="form-control" value="<?php echo $tglselesai; ?>">
                        </div>
                    </div>
                </div>

                <!-- Kolom Status -->
                <div class=" col-md-3">
                    <div class="form-group">
                        <select name="status" class="form-control">
                            <option selected disabled>Pilih Status</option>
                            <option value="pending">Pending</option>
                            <option value="pembayaran dikonfirmasi">Konfirmasi</option>
                            <option value="barang dikirim">Barang Dikirim</option>
                            <option value="pengiriman dibatalkan">Pengiriman Dibatalkan</option>
                        </select>
                    </div>
                </div>

                <!-- Tombol Cari -->
                <div class="col-md-1">
                    <button name="cari" class="btn btn-primary">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php if (!empty($semuadata)): ?>
    <div class="alert alert-info shadow mt-3">
        <p>Laporan Pembelian dari <?php echo date("d F Y", strtotime($tglmulai)); ?> sampai
            <?php echo date("d F Y", strtotime($tglselesai)); ?></p>
        <a href="cetak_laporan.php?tglm<?php echo $tglmulai; ?>&tgls=<?php $tglselesai; ?>&status=<?php echo $status; ?>"
            class="btn btn-primary" target="_blank">
            <i class="bi bi-printer-fill me-2"></i> Cetak Data
        </a>
    </div>
<?php endif ?>


<!-- tabel -->
<div class="card shadow bg-white mt-3">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped" id="tables">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (!empty($semuadata)): ?>
                        <?php $total = 0; ?>
                        <?php foreach ($semuadata as $key => $value): ?>
                            <?php $total += $value['total_pembelian']; ?>
                            <tr>
                                <td width="50"><?php echo $key + 1; ?></td>
                                <td><?php echo $value['nama_pelanggan']; ?></td>
                                <td><?php echo date("d F Y", strtotime($value['tanggal_pembelian'])); ?></td>
                                <td><?php echo $value['status']; ?></td>
                                <td><?php echo number_format($value['total_pembelian']); ?></td>
                            </tr>
                        <?php endforeach ?>
                    <?php endif ?>
                </tbody>
                <tfoot>
                    <?php if (!empty($semuadata)): ?>
                        <tr>
                            <th colspan="4">Total:</th>
                            <th>Rp. <?php echo number_format($total); ?></th>
                        </tr>
                    <?php endif ?>
                </tfoot>
            </table>
        </div>
    </div>
</div>