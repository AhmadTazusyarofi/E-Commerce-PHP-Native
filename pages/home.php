<?php

$id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];

$ambil = $koneksi->query("SELECT * FROM pelanggan
    WHERE id_pelanggan='$id_pelanggan'");

    $pecah = $ambil->fetch_assoc();

?>

<div class="card card-home">
    <div class="card-body">
        <h4>
            Selamat Datang <?php echo $pecah['nama_pelanggan']; ?> !
        </h4>
    </div>
</div>

<div class="card card-home mt-3">
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data">

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nama :</label>
                <div class="col-sm-9">
                    <input type="text" name="" class="form-control" value="<?php echo $pecah['nama_pelanggan']; ?>"
                        readonly>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Email :</label>
                <div class="col-sm-9">
                    <input type="text" name="" class="form-control" value="<?php echo $pecah['email_pelanggan']; ?>"
                        readonly>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">No Hp :</label>
                <div class="col-sm-9">
                    <input type="number" name="" class="form-control" value="<?php echo $pecah['telepon_pelanggan']; ?>"
                        readonly>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Alamat :</label>
                <div class="col-sm-9">
                    <textarea type="number" name="" class="form-control"
                        readonly><?php echo $pecah['alamat_pelanggan']; ?></textarea>
                </div>
            </div>
        </form>
    </div>
</div>