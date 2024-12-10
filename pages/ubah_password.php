<?php

$id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];

?>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.min.css">


</head>

<body>
    <div class="card card-home">
        <div class="card-body">
            <h4>
                Update Password
            </h4>
        </div>
    </div>

    <div class="card card-home mt-3">
        <div class="card-body">
            <form method="POST">

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Password Lama:</label>
                    <div class="col-sm-9">
                        <input type="password" name="pass_lama" class="form-control"
                            placeholder="Masukan Password Lama">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Password Baru:</label>
                    <div class="col-sm-9">
                        <input type="password" name="pass_baru" class="form-control"
                            placeholder="Masukan Password Baru">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label"></label>
                    <div class="col-sm-9">
                        <button name="update" class="btn btn-sm btn-primary">Update</button>
                        <a href="profil.php?page=setting" name="cancel" class="btn btn-sm btn-secondary">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.all.min.js"></script>

</body>

<?php

if (isset($_POST['update'])) {
    $pass_lama = sha1($_POST['pass_lama']);
    $pass_baru = sha1($_POST['pass_baru']);

    // ambil data pelanggan
    $ambil = $koneksi->query("SELECT * FROM pelanggan WHERE password_pelanggan='$pass_lama'");
    $pass = $ambil->num_rows;

    // jika memasukan password lama dengan benar maka
    if ($pass==1) {
        $koneksi->query("UPDATE pelanggan SET password_pelanggan='$pass_baru'
        WHERE id_pelanggan='$id_pelanggan'");

        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
        Swal.fire({
            icon: 'success',
            title: 'Password Berhasil Di Update',
            text: 'Silahkan Login Kembali',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'login.php';
            }
        });
        </script>";
    } else {
        // jika user salah memasukan password lama

        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
        Swal.fire({
            icon: 'error',
            title: 'Password Gagal Di Update',
            text: 'Silahkan Masukan Password Lama Yang Benar',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'profil.php?page=ubah_password';
            }
        });
        </script>";
    }
}

?>