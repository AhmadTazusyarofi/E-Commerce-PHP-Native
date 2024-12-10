<?php

$id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];

$ambil = $koneksi->query("SELECT * FROM pelanggan
    WHERE id_pelanggan='$id_pelanggan'");

    $pecah = $ambil->fetch_assoc();

?>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.min.css">


</head>

<body>
    <div class="card card-home">
        <div class="card-body">
            <h4>
                Update Profil
            </h4>
        </div>
    </div>

    <div class="card card-home mt-3">
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Nama :</label>
                    <div class="col-sm-9">
                        <input type="text" name="nama" class="form-control"
                            value="<?php echo $pecah['nama_pelanggan']; ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Email :</label>
                    <div class="col-sm-9">
                        <input type="email" name="email" class="form-control"
                            value="<?php echo $pecah['email_pelanggan']; ?>" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Password :</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" value="<?php echo $pecah['password_pelanggan']; ?>">
                        <a href="profil.php?page=ubah_password" class="btn btn-sm btn-primary mt-2">Update Password</a>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">No Hp :</label>
                    <div class="col-sm-9">
                        <input type="number" name="telepon" class="form-control"
                            value="<?php echo $pecah['telepon_pelanggan']; ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Alamat :</label>
                    <div class="col-sm-9">
                        <textarea type="number" name="alamat"
                            class="form-control"><?php echo $pecah['alamat_pelanggan']; ?></textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Foto :</label>
                    <div class="col-sm-9">
                        <img src="../assets/foto_pelanggan/<?php echo $pecah['foto_pelanggan']; ?>" width="200px">
                        <input type="file" name="foto" class="form-control mt-2">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label"></label>
                    <div class="col-sm-9">
                        <button name="simpan" class="btn btn-sm btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.all.min.js"></script>

</body>

<?php

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $pass = sha1($_POST['password']);
    $telepon = $_POST['telepon'];
    $alamat = $_POST['alamat'];

    $nama_foto = $_FILES['foto']['name'];
    $lokasi_foto = $_FILES['foto']['tmp_name'];

    move_uploaded_file($lokasi_foto, "../assets/foto_pelanggan/".$nama_foto);

    if (!empty($lokasi_foto)) {
        $koneksi->query("UPDATE pelanggan SET nama_pelanggan = '$nama',
        password_pelanggan = '$pass',
        telepon_pelanggan = '$telepon',
        alamat_pelanggan = '$alamat',
        foto_pelanggan = '$nama_foto'
        WHERE id_pelanggan='$id_pelanggan'");
    } else {
        $koneksi->query("UPDATE pelanggan SET nama_pelanggan = '$nama',
        telepon_pelanggan = '$telepon',
        alamat_pelanggan = '$alamat'
        WHERE id_pelanggan='$id_pelanggan'");
    }
    // echo "<script>alert('Data Berhasil di Update');</script>";
    // echo "<script>location='profil.php';</script>";
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
        Swal.fire({
            icon: 'success',
            title: 'Data Berhasil Di Update',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'profil.php';
            }
        });
        </script>";
}

?>