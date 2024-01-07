<?php
if (!isset($_SESSION)) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Ini menangani formulir login hanya jika metode permintaan adalah POST. Ini mengambil data dari formulir yang disubmit.
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM admin WHERE username = '$username'";
    $result = $mysqli->query($query); // Ini adalah kueri SQL yang mencari admin berdasarkan username yang dimasukkan.

    if (!$result) {
        die("Query error: " . $mysqli->error);
    }

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            header("Location: menuAdmin.php"); // Jika login berhasil, session username diatur dan pengguna diarahkan ke halaman menuAdmin.php.
        } else { 
            $error = "Password salah";
        }
    } else {
        $error = "User tidak ditemukan";
    } // Ini memeriksa apakah ada admin dengan username yang dimasukkan. Jika ditemukan, maka password yang dimasukkan diverifikasi menggunakan password_verify.
}
?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="index.php?page=loginAdmin"> 
                        <?php // Ini adalah formulir HTML untuk login admin. Juga, ada penanganan pesan kesalahan yang ditampilkan di bagian form.
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
                                        <h2 style="font-size: 32px;">Login Admin</h2>
                                        <div class="form-group" style="margin-bottom: 5px; margin-left: 5px;">
                                            <label for="username">Username</label>
                                            <input type="text" name="username" class="form-control" required placeholder="Masukkan nama anda">
                                        </div>
                                        <div class="form-group" style="margin-bottom: 5px; margin-left: 5px;">
                                            <label for="password">Password</label>
                                            <input type="password" name="password" class="form-control" required placeholder="Masukkan password anda">
                                        </div>
                                        <div class="text-center mt-3"  style="margin-bottom: 5px; margin-left: 5px;"> <!-- Added mt-3 for top margin -->
                                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                                        </div>
                                        <div class="text-center"  style="margin-bottom: 5px; margin-left: 5px;">
                                                <p class="mt-3">Belum punya akun? <a href="index.php?page=registerAdmin">Register</a></p>
                                            </div>
                                    </div>
                                    </section>
                                </div>
                            </div>
                        </section>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

