<?php
if (!isset($_SESSION)) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];
    $id_poli = $_POST['id_poli'];

    if ($password === $confirm_password) {
        $query = "SELECT * FROM dokter WHERE nama ='$nama'";
        $result = $mysqli->query($query);
        if ($result === false) {
            die("Query error: " . $mysqli->error);
        }

        if ($result->num_rows == 0) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $insert_query = "INSERT INTO dokter (nama, password, alamat, no_hp, id_poli) 
                            VALUES ('$nama', '$hashed_password', '$alamat', '$no_hp', '$id_poli')";

            if (mysqli_query($mysqli, $insert_query)) {
                echo "<script>
                alert('Pendaftaran Berhasil'); 
                document.location='index.php?page=loginDokter';
                </script>";
            } else {
                $error = "Pendaftaran gagal";
            }
        } else {
            $error = "Username sudah digunakan";
        }
    } else {
        $error = "Password tidak cocok";
    }
}
?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="index.php?page=registerDokter">
                        <?php
                        if (isset($error)) {
                            echo '<div class="alert alert-danger">' . $error . '
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>';
                        }
                        ?>        
                        <section class="py-5 border-bottom" id="features" style="background-color: #FFFFFF;">
                            <div class="container px-5 my-5">
                                <div class="row g-5">
                                    <section class="login-section">
                                    <!-- Left Icon and Text -->
                                    <div class="col-md-6 icon-container">
                                        <h2 style="font-size: 32px;">Registrasi Dokter</h2>
                                        <div class="form-group" style="margin-bottom: 5px; margin-left: 5px;">
                                            <label for="nama">Username</label>
                                            <input type="text" name="nama" class="form-control" required placeholder="Masukkan nama anda">
                                        </div>
                                        <div class="form-group" style="margin-bottom: 5px; margin-left: 5px;">
                                            <label for="alamat">Alamat</label>
                                            <input type="text" name="alamat" class="form-control" required placeholder="Masukkan alamat anda">
                                        </div>
                                        <div class="form-group" style="margin-bottom: 5px; margin-left: 5px;">
                                            <label for="no_hp">Nomor HP</label>
                                            <input type="text" name="no_hp" class="form-control" required placeholder="Masukkan nomor HP">
                                        </div>
                                        <div class="form-group" style="margin-bottom: 5px; margin-left: 5px;">
                                            <label for="id_poli">ID Poli</label>
                                            <input type="text" name="id_poli" class="form-control" required placeholder="Masukkan ID Poli">
                                        </div>
                                        <div class="form-group" style="margin-bottom: 5px; margin-left: 5px;">
                                            <label for="password">Password</label>
                                            <input type="password" name="password" class="form-control" required placeholder="Masukkan password anda">
                                        </div>
                                        <div class="form-group" style="margin-bottom: 5px; margin-left: 5px;">
                                            <label for="confirm_password">Confirm Password</label>
                                            <input type="password" name="confirm_password" class="form-control" required placeholder="Masukkan password konfirmasi">
                                        </div>
                                        <div class="text-center mt-3"> <!-- Added mt-3 for top margin -->
                                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                                        </div>
                                        <div class="text-center">
                                            <p class="mt-3">Sudah Punya Akun? <a href="index.php?page=loginDokter">Login</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
