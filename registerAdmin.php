<?php
if (!isset($_SESSION)) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password === $confirm_password) {
        $query = "SELECT * FROM admin WHERE username ='$username'";
        $result = $mysqli->query($query); // Mengecek apakah username sudah digunakan sebelumnya.
        if ($result === false) {
            die("Query error: " . $mysqli->error);
        }

        if ($result->num_rows == 0) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $insert_query = "INSERT INTO admin (username, password) VALUES ('$username', '$hashed_password')";
            if (mysqli_query($mysqli, $insert_query)) {
                echo "<script>
                alert('Pendaftaran Berhasil'); 
                document.location='index.php?page=loginAdmin';
                </script>";
            } else {
                $error = "Pendaftaran gagal";
            } // Jika username tersedia, maka lakukan insert data admin baru ke dalam tabel.
        } else {
            $error = "Username sudah digunakan";
        }
    } else {
        $error = "Password tidak cocok";
    } // Menangani proses registrasi admin. Verifikasi apakah password dan konfirmasi password cocok.
}
?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="index.php?page=registerAdmin"> 
                        <?php // Form HTML untuk memasukkan data registrasi admin.
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
                                        <h2 style="font-size: 32px;">Registrasi Admin</h2>
                                        <div class="form-group" style="margin-bottom: 5px; margin-left: 5px;">
                                            <label for="nama">Username</label>
                                            <input type="text" name="nama" class="form-control" required placeholder="Masukkan nama anda">
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
                                            <p class="mt-3">Sudah Punya Akun? <a href="index.php?page=loginAdmin">Login</a></p>
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
