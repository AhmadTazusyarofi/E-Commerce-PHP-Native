<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>

<div class="card">
    <div class="card-header">
        <h5 class="text-dark">Detail Pembayaran</h5>
    </div>
</div>

<?php

$id_pembelian = $_GET['id'];

$ambil = $koneksi->query("SELECT pembayaran.*, pembelian.total_pembelian, pembelian.id_pelanggan 
    FROM pembayaran 
    JOIN pembelian ON pembayaran.id_pembelian = pembelian.id_pembelian
    WHERE pembayaran.id_pembelian = '$id_pembelian'");


$pecah = $ambil->fetch_assoc();

// jika user belum melakukan pembayaran
if (empty($pecah)) {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script>
    Swal.fire({
        icon: 'warning',
        title: 'Tidak Ada Data Pembayaran',
        confirmButtonText: 'OK'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = 'profil.php?page=pesanan';
        }
    });
    </script>";

    // jika data pembayaran tidak sesuai dengan id
    if ($_SESSION['pelanggan']['id_pelanggan'] !== $pecah['id_pelanggan']) {
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
}

?>



<div class="alert alert-info text-dark mt-3">
    Total Tagihan: Rp. <?php echo number_format($pecah['total_pembelian']); ?>
</div>

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-8">
                <table class="table">
                    <tr>
                        <th>Nama</th>
                        <td><?php echo $pecah['nama']; ?></td>
                    </tr>
                    <tr>
                        <th>Bank</th>
                        <td><?php echo $pecah['bank']; ?></td>
                    </tr>
                    <tr>
                        <th>Jumlah</th>
                        <td>Rp. <?php echo number_format($pecah['jumlah']); ?></td>
                    </tr>
                    <tr>
                        <th>Tanggal</th>
                        <td><?php echo date("d F Y", strtotime($pecah['tanggal'])); ?></td>
                    </tr>
                </table>
                <a href="profil.php?page=pesanan" class="btn btn-sm btn-secondary">Kembali</a>
            </div>
            <div class="col-md-4">
                <img src="../assets/foto_bukti/<?php echo $pecah['bukti']; ?>" class="img-thumbnail img-responsive">
            </div>
        </div>
    </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.all.min.js"></script>