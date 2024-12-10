<!-- <div class="bg-white p-3 rounded">
    <h5>Pesanan Saya</h5>
</div> -->

<div class="pesanan mt-3 mt-lg-0">
    <div class="card">
        <div class="card-header">
            <h5 class="text-dark">Pesanan Saya</h5>
        </div>
    </div>


    <?php

    // ambil id pelanggan dari session
    $id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];

    $pembelian = array();
    // ambil data produk dari tbl pembelian
    $ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan
    ON pembelian.id_pelanggan=pelanggan.id_pelanggan
    WHERE pembelian.id_pelanggan='$id_pelanggan'");

    while ($pecah = $ambil->fetch_assoc()) {
        $pembelian[] = $pecah;
    }

    ?>

    <div class="card mt-3">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped" id="tables">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pembelian as $key => $value): ?>
                        <tr>
                            <td width="25px"><?php echo $key + 1; ?></td>
                            <td width="200px">
                                <?php echo date("d F Y", strtotime($value['tanggal_pembelian'])); ?>
                            </td>
                            <td width="100px">
                                Rp.<?php echo number_format($value['total_pembelian']); ?>
                            </td>
                            <?php if ($value['status'] == 'Pending'): ?>
                            <td width="150px" class="text-center text-danger">
                                <?php echo $value['status']; ?> <br>
                                <!-- jika resi pengiriman tidak kosong -->
                                <?php if (!empty($value['resi_pengiriman'])): ?>
                                <?php echo $value['resi_pengiriman']; ?>
                                <?php endif ?>
                            </td>
                            <?php else: ?>
                            <td width="150px" class="text-center text-success">
                                <?php echo $value['status']; ?> <br>
                                <!-- jika resi pengiriman tidak kosong -->
                                <?php if (!empty($value['resi_pengiriman'])): ?>
                                <?php echo $value['resi_pengiriman']; ?>
                                <?php endif ?>
                            </td>
                            <?php endif ?>
                            <td class="text-center" width="200px">
                                <a href="profil.php?page=detail_pembelian&id=<?php echo $value['id_pembelian']; ?>"
                                    class="btn btn-sm btn-info text-white">
                                    <i class="bi bi-file-earmark"></i> Nota
                                </a>

                                <!-- jika status nya pending -->
                                <?php if ($value['status'] == 'Pending'): ?>
                                <a href="profil.php?page=pembayaran&id=<?php echo $value['id_pembelian']; ?>"
                                    class="btn btn-sm btn-primary">
                                    <i class="bi bi-credit-card"></i> Pembayaran
                                </a>
                                <?php else: ?>
                                <a href="profil.php?page=detail_pembayaran&id=<?php echo $value['id_pembelian']; ?>"
                                    class="btn btn-sm btn-success">
                                    <i class="bi bi-eye"></i> Pembayaran
                                </a>
                                <?php endif ?>
                            </td>

                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>