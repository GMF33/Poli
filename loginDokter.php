<?php
if (!isset($_SESSION)) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $password = $_POST['password'];

    $query = "SELECT * FROM dokter WHERE nama = '$nama'";
    $result = $mysqli->query($query);

    if (!$result) {
        die("Query error: " . $mysqli->error);
    }

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['nama'] = $nama;
            header("Location: menuperiksaDokter.php");
        } else {
            $error = "Password salah";
        }
    } else {
        $error = "User tidak ditemukan";
    }
}
?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="index.php?page=loginDokter">
                        <?php
                        if (isset($error)) {
                            echo '<div class="alert alert-danger">' . $error . '
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>';
                        }
                        ?>
                        <section class="login-section">
                        <!-- Left Icon and Text -->
                        <div class="col-md-6 icon-container">
                            <h2 style="font-size: 32px;">Login Dokter</h2>
                            <div class="form-group" style="margin-bottom: 5px; margin-left: 5px;">
                                <label for="nama">Username</label>
                                <input type="text" name="nama" class="form-control" required placeholder="Masukkan nama anda">
                            </div>
                            <div class="form-group" style="margin-bottom: 5px; margin-left: 5px;">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" required placeholder="Masukkan password anda">
                            </div>
                            <div class="text-center mt-3"  style="margin-bottom: 5px; margin-left: 5px;"> <!-- Added mt-3 for top margin -->
                                <button type="submit" class="btn btn-primary btn-block">Login</button>
                            </div>
                            <div class="text-center">
                                <p class="mt-3">Belum punya akun? <a href="index.php?page=registerDokter">Register</a></p>
                            </div>
                        </div>
                        </section>
                    </form> 
                </div>
            </div>
        </div>
    </div>
</div>