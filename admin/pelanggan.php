<div class="shadow p-3 mb-3 bg-white rounded text-dark">
    <h5><b>Halaman pelanggan</b></h5>
</div>


<?php

$pelanggan = array();
$ambil = $koneksi->query("SELECT * FROM pelanggan");
while ($pecah = $ambil->fetch_assoc()) {
    $pelanggan[] = $pecah;
}

?>


<div class="card shadow bg-white">
    <div class="card-body">
        <table class="table table-bordered table-hover table-stripped" id="tables">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Foto</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($pelanggan as $key => $value):
                ?>
                    <tr>
                        <th width="50"><?php echo $key + 1; ?></th>
                        <th><?php echo $value['nama_pelanggan']; ?></th>
                        <th><?php echo $value['email_pelanggan']; ?></th>
                        <th><?php echo $value['telepon_pelanggan']; ?></th>
                        <th>
                            <img width="150" src="../assets/foto_pelanggan/<?php echo $value['foto_pelanggan']; ?>" alt="">
                        </th>
                        <th class="text-center" width="150">
                            <a href="#" class="btn btn-sm btn-danger">Hapus</a>
                        </th>
                    </tr>
                <?php
                endforeach;
                ?>
            </tbody>
        </table>
    </div>
</div>