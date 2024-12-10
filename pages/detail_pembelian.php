<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>

<body>
    <div class="shadow p-3 mb-3 rounded">
        <h5><b>Halaman Nota Pembelian</b></h5>
    </div>

    <?php

    $id_pembelian = $_GET['id'];

    $ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan 
    WHERE pembelian.id_pembelian='$id_pembelian'");
    $detail = $ambil->fetch_assoc();

    $id_pembelian = $detail['id_pelanggan'];
    $id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];

    if ($id_pembelian !== $id_pelanggan) {

        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script>
    Swal.fire({
        icon: 'warning',
        title: 'Session Tidak Ditemukan',
        confirmButtonText: 'OK'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = 'profil.php?page=pesanan';
        }
    });
    </script>";
    }
    ?>


    <div class="row">
        <div class="col-md-6">
            <div class="card shadow bg-white mb-lg-0 mb-3">
                <div class="card-header bg-info text-white">
                    <strong>Data Pelanggan</strong>
                </div>
                <div class="card-body row">
                    <!--  -->
                    <label class="col-md-4 col-form-label"><strong>Nama :</strong></label>
                    <label class="col-md-8 col-form-label"><?php echo $detail['nama_pelanggan']; ?></label>
                    <!--  -->
                    <label class="col-md-4 col-form-label"><strong>Email :</strong></label>
                    <label class="col-md-8 col-form-label"><?php echo $detail['email_pelanggan']; ?></label>
                    <!--  -->
                    <label class="col-md-4 col-form-label"><strong>Telepon :</strong></label>
                    <label class="col-md-8 col-form-label"><?php echo $detail['telepon_pelanggan']; ?></label>

                    <label class="col-md-4 col-form-label"><strong>Alamat :</strong></label>
                    <label class="col-md-8 col-form-label"><?php echo $detail['alamat']; ?></label>

                    <label class="col-md-4 col-form-label"><strong>Provinsi :</strong></label>
                    <label class="col-md-8 col-form-label"><?php echo $detail['provinsi']; ?></label>

                    <label class="col-md-4 col-form-label"><strong>Kota :</strong></label>
                    <label class="col-md-8 col-form-label"><?php echo $detail['district']; ?></label>

                    <label class="col-md-4 col-form-label"><strong>Kode Pos :</strong></label>
                    <label class="col-md-8 col-form-label"><?php echo $detail['kode_pos']; ?></label>

                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow bg-white mb-3">
                <div class="card-header bg-info text-white">
                    <strong>Data Pembelian</strong>
                </div>
                <div class="card-body">
                    <!--  -->
                    <label class="col-md-4 col-form-label"><strong>Tanggal :</strong></label>
                    <label class="col-md-6 col-form-label">
                        <?php echo date("d F Y", strtotime($detail['tanggal_pembelian'])); ?>
                    </label>

                    <!--  -->
                    <label class="col-md-4 col-form-label"><strong>Total :</strong></label>
                    <label class="col-md-6 col-form-label">Rp.
                        <?php echo number_format($detail['total_pembelian']); ?>
                    </label>
                </div>
            </div>

            <div class="card shadow bg-white">
                <div class="card-header bg-info text-white">
                    <strong>Data Paket</strong>
                </div>
                <div class="card-body">
                    <!--  -->
                    <label class="col-md-4 col-form-label"><strong>Ekspedisi :</strong></label>
                    <label class="col-md-6 col-form-label">
                        <?php echo $detail['ekspedisi'] ?>
                        <?php echo $detail['paket'] ?>
                    </label>

                    <!--  -->
                    <label class="col-md-4 col-form-label"><strong>Ongkir :</strong></label>
                    <label class="col-md-6 col-form-label">Rp.
                        <?php echo number_format($detail['ongkir']); ?>
                    </label>

                    <label class="col-md-4 col-form-label"><strong>Estimasi :</strong></label>
                    <label class="col-md-6 col-form-label">
                        <?php echo $detail['estimasi']; ?> Hari
                    </label>
                </div>
            </div>
        </div>
    </div>

    <?php

    $pp = array();
    $ambil = $koneksi->query("SELECT * FROM pembelian_produk JOIN produk
    ON pembelian_produk.id_produk=produk.id_produk WHERE pembelian_produk.id_pembelian='$id_pembelian'");

    while ($pecah = $ambil->fetch_assoc()) {
        $pp[] = $pecah;
    }
    ?>

    <div class="card shadow bg-white mt-3">
        <div class="card-body">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th width="30px">Jumlah</th>
                        <th>Berat</th>
                        <th>Foto Produk</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pp as $key => $value): ?>
                    <tr>
                        <td width="50"><?php echo $key + 1; ?></td>
                        <td><?php echo $value['nama_produk']; ?> </td>
                        <td>Rp.<?php echo number_format($value['harga_produk']); ?> </td>
                        <td><?php echo $value['jumlah']; ?></td>
                        <td><?php echo number_format($value['subberat']); ?>Gr</td>
                        <td class="text-center">
                            <img width="150" src="../assets/foto_produk/<?php echo $value['foto_produk']; ?>" alt="">
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="alert alert-primary text-dark mt-3">
        <p>Silahkan Melakukan Pembayaran: <strong>Rp.<?php echo number_format($detail['total_pembelian']); ?>
            </strong><br><br>
            <strong>Bank BCA: 123-1324-386 a/n Ahmad Tazusyarofi</strong> <br>
            <strong>Dana: 085624318915 a/n Ahmad Tazusyarofi</strong>
        </p>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.all.min.js"></script>
</body>