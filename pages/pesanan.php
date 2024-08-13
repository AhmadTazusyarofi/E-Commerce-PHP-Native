<!-- <div class="bg-white p-3 rounded">
    <h5>Pesanan Saya</h5>
</div> -->

<div class="pesanan">
    <div class="card">
        <div class="card-header" style="background-color: #40534c;">
            <h5 class="text-white">Pesanan Saya</h5>
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
        $pembelian[]=$pecah;
    }

    ?>

    <div class="card mt-3">
        <div class="card-body">
            <table class="table table-bordered table-hover table-striped" id="tables">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Total</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pembelian as $key => $value): ?>
                    <tr>
                        <td width="25px"><?php echo $key+1; ?></td>
                        <td>
                            <?php echo date("d F Y", strtotime($value['tanggal_pembelian'])); ?>
                        </td>
                        <td>
                            Rp.<?php echo number_format($value['total_pembelian']); ?>
                        </td>
                        <td width="30px">
                            <a href="#" class="btn btn-sm btn-warning">
                                <?php echo $value['status']; ?>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>