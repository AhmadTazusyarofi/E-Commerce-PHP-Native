<div class="shadow p-3 mb-3 bg-white rounded text-dark">
    <h5><b>Halaman Pembelian</b></h5>
</div>

<?php

$pembelian = array();
$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan");
while ($pecah = $ambil->fetch_assoc()) {
    $pembelian[] = $pecah;
}

?>



<div class="card shadow bg-white">
    <div class="card-body">
        <table class="table table-bordered table-hover table-stripped" id="tables">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Tanggal</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            <tbody>
                <?php
                foreach ($pembelian as $key => $value):
                ?>
                    <tr>
                        <td width="50"><?php echo $key + 1; ?></td>
                        <td><?php echo $value['nama_pelanggan']; ?></td>
                        <td><?php echo date("d F Y", strtotime($value['tanggal_pembelian']));  ?></td>
                        <td>Rp.<?php echo number_format($value['total_pembelian']); ?></td>
                        <td><?php echo $value['status']; ?></td>
                        <td class="text-center" widtd="200">
                            <a href="index.php?halaman=detail_pembelian&id=<?php echo $value['id_pembelian']; ?>"
                                class="btn btn-sm btn-info">Detail</a>

                            <!-- jika status nya sedang di proses -->
                            <?php if ($value['status'] !== 'Pending'): ?>
                                <a href="index.php?halaman=pembayaran&id=<?php echo $value['id_pembelian']; ?>"
                                    class="btn btn-sm btn-success">Lihat Pembayaran</a>
                            <?php endif ?>
                        </td>
                    </tr>
                <?php
                endforeach;
                ?>
            </tbody>
            </thead>
        </table>
    </div>
</div>