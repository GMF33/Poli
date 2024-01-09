<?php
if (!isset($_SESSION)) {
    session_start();
}

include_once("koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">
<style>
    /* Section 3: Login */
    .login-section {
            display: flex;
            justify-content: space-around;
            align-items: center;
            padding: 20px;
        }

        .icon-container {
            font-family: 'Sora', sans-serif;
            margin: 50px;
            text-align: justify;
            border: 1px solid #ccc;
            /* Menambahkan border */
            padding: 20px;
            /* Menambahkan ruang padding */
            transition: transform 0.5s, box-shadow 0.5s;
            /* Animasi transisi transformasi dan bayangan */
        }

        .icon-container img {
            width: 100px;
            /* Example size, adjust as needed */
            height: auto;
        }

        .icon-link {
            color: blue;
            text-decoration: none;
        }

        .icon-link:hover {
            text-decoration: underline;
        }
</style>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Sistem Temu Janji Poliklinik </title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/poliweb/dist/css/welcome_styles.css">
</head>

<body>
    <!-- Responsive navbar-->
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #4942E4">
    <div class="container px-4">
        <a class="navbar-brand" href="index.php">
            <img src="dist/img/clinic.png" alt="Logo" height="30" class="d-inline-block align-top me-2">
            <span style="color: #fff; font-weight: bold;">Poliklinik UDINUS</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
            </ul>
        </div>
    </div>
</nav>


<?php 
    if (isset($_GET['page'])) {
        if ($_GET['page'] === 'loginAdmin') {
            include_once ('./loginAdmin.php');
        } else if ($_GET['page'] === 'loginDokter') {
            include_once ('./loginDokter.php');
        } else if ($_GET['page'] === 'loginPasien') {
            include_once ('./loginPasien.php');
        } else {
            include($_GET['page'] . ".php");
        }
    } else { // Ini adalah bagian PHP yang menentukan konten halaman berdasarkan parameter URL page. Jika page ada dalam URL, 
        // itu akan memuat halaman login yang sesuai (Admin, Dokter, atau Pasien). Jika tidak, itu akan menampilkan header dan bagian tampilan utama.
?>

        <!-- Header-->
        <header class="py-5" style="background-color:  #F8E559; border-bottom: 5px solid #F8E559;"> <!-- Change Color Banner and Add Border Here -->
    <div class="container px-5" style="border-radius: 10px; box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.5);"> <!-- Add Border Radius and Box Shadow to the Container -->
        <div class="row gx-5 justify-content-center">
            <div class="col-lg-6">
                <div class="text-center my-5">
                    <h1 class="display-4 fw-bold text-white mb-2" style="text-align: center;">Sistem Temu Janji <br>DOKTER-PASIEN</h1> <!-- Change Heading Text and Font Size -->
                    <p class="lead text-white-50 mb-5" style="text-align: center;">Bimbingan Karier Web Developer</p> <!-- Change Subtitle Text -->
                </div>
            </div>
        </div>
    </div>
</header>


    <!-- Features section-->
<section class="py-5 border-bottom" id="features" style="background-color: #FFFFFF;">
    <div class="container px-5 my-5">
        <div class="row g-5">
            <section class="login-section">
            <!-- Left Icon and Text -->
            <div class="col-md-6 icon-container">
                <img src="asset/images/pasien.png" alt="First Icon">
                <h2 style="font-size: 32px;">Login Sebagai Admin</h2>
                <p>Jika Anda adalah seorang Admin, silakan Login untuk mengelola data website!</p>
                <a class="text-decoration-none" href="index.php?page=loginAdmin">
                    Klik Link Berikut
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
            <div class="col-md-6 icon-container">
                <img src="asset/images/dokter.png" alt="First Icon">
                <h2 class="h4 fw-bolder">Login Sebagai Dokter</h2>
                <p>Jika Anda adalah seorang Dokter, silakan Login untuk memulai melayani Pasien!</p>
                <a class="text-decoration-none" href="index.php?page=loginDokter">
                    Klik Link Berikut
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
            <div class="col-md-6 icon-container">
                <img src="asset/images/pasien.png" alt="First Icon">
                <h2 class="h4 fw-bolder">Login Sebagai Pasien</h2>
                <p>Jika Anda adalah seorang Pasien, silakan Login untuk mulai menggunakan layanan kami!</p>
                <a class="text-decoration-none" href="index.php?page=loginPasien">
                    Klik Link Berikut
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
            </section>
        </div>
    </div>
</section>

<!-- Footer-->
<footer class="main-footer px-4 py-2" style="background-color: #4942E4; color: #fff; text-align: center;">
<strong>
    Copyright ©
    <script>
        document.write(new Date().getFullYear())
    </script>
    <a href="https://bengkelkoding.dinus.ac.id/" style="color: #fff;">Bengkel Koding</a>.
</strong>
All rights reserved.
<div class="float-right d-none d-sm-inline-block" style="color: #fff;">
    <b>Version</b> 1.0.0
</div>
</footer>
    <?php
        }
    ?>
    <!-- Bootstrap core JS--> 
    <!-- Ini adalah tautan ke library JavaScript Bootstrap dan skrip core theme. -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script> 
    <!-- Core theme JS-->
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script> 
</body>

</html>