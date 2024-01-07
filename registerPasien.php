<?php
if (!isset($_SESSION)) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $alamat = $_POST['alamat'];
    $no_ktp = $_POST['no_ktp'];
    $no_hp = $_POST['no_hp'];

    if ($password === $confirm_password) {
        // Generate the current year and month (e.g., 202312)
        $yearMonth = date('Ym');

        // Get the current counter value for the given year and month
        $queryCounter = "SELECT MAX(SUBSTRING(no_rm, 8)) AS max_counter FROM pasien WHERE no_rm LIKE '$yearMonth%'";
        $resultCounter = $mysqli->query($queryCounter);

        if ($resultCounter === false) {
            die("Query error: " . $mysqli->error);
        }

        $counter = 1; // Default counter value if no records found
        if ($resultCounter->num_rows > 0) {
            $row = $resultCounter->fetch_assoc();
            $counter = (int)$row['max_counter'] + 1;
        }

        // Pad the counter with leading zeros (e.g., 001, 002, ...)
        $paddedCounter = str_pad($counter, 3, '0', STR_PAD_LEFT);

        // Combine the yearMonth and paddedCounter to form the final no_rm
        $no_rm = $yearMonth . '-' . $paddedCounter;

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $insert_query = "INSERT INTO pasien (nama, password, alamat, no_ktp, no_hp, no_rm) 
                        VALUES ('$nama', '$hashed_password', '$alamat', '$no_ktp', '$no_hp', '$no_rm')";

        if (mysqli_query($mysqli, $insert_query)) {
            echo "<script>
            alert('Pendaftaran Berhasil'); 
            document.location='index.php?page=loginPasien';
            </script>";
        } else {
            $error = "Pendaftaran gagal";
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
                    <form method="POST" action="index.php?page=registerPasien">
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
                                        <h2 style="font-size: 32px;">Registrasi Pasien</h2>
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
                                            <label for="no_ktp">Nomor KTP</label>
                                            <input type="text" name="no_ktp" class="form-control" required placeholder="Masukkan No KTP">
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
                                        <p class="mt-3">Sudah Punya Akun? <a href="index.php?page=loginPasien">Login</a></p>
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

