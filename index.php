<?php
// Mulai sesi jika belum dimulai
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['email'])) {
    echo '<script>alert("Anda harus login terlebih dahulu!"); window.location.href="pages/user/login.php";</script>';
    exit(); // Hentikan eksekusi script lebih lanjut
}

$request_uri = $_SERVER['REQUEST_URI'];
if (strpos($request_uri, '&') !== false) {
    $request_uri = substr($request_uri, 0, strpos($request_uri, '&'));
}

$adder = "/hotel/";
$beranda = array(
    $adder,
    $adder . "index.php",
    $adder . "index.php?page=beranda"
);

$kab_kota_active = array(
    $adder . "index.php?page=data_hotel",
    $adder . "index.php?page=tambah_hotel",
    $adder . "index.php?page=ubah_hotel"
);

$user_active = array(
    $adder . "index.php?page=data_user",
    $adder . "index.php?page=tambah_user",
    $adder . "index.php?page=ubah_user"
);

$lokasi_active = array(
    $adder . "index.php?page=tambah_lokasi" // Tambahkan ini
);

// Menambahkan array untuk peta aktif
$peta_active = array(
    $adder . "index.php?page=peta_hotel" // Tambahkan ini
);

$kelola_data = array_merge($kab_kota_active, $user_active, $lokasi_active);

// Debug: Cetak variabel untuk memastikan nilainya benar
// var_dump($request_uri, $beranda, $kab_kota_active, $user_active, $kelola_data);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Hotel Bengkalis</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- DataTables-->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <!-- Date Picker Tempusdominus Bootstrap4 -->
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4//css/tempusdominus-bootstrap-4.min.css">
    <!-- Summernote -->
    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">

    <!-- Custom CSS -->
    <style>
        body {
            background-color: #003580;
        }

        .main-header {
            background-color: #003580;
        }

        .main-sidebar {
            background-color: #003580;
        }

        .nav-sidebar .nav-link.active {
            background-color: #f39c12;
            color: #ffffff;
        }

        .brand-link {
            background-color: #16a085;
        }

        .brand-link .brand-text {
            color: #fff;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fa fa-bars"></i></a>
                </li>
            </ul>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index.php" class="brand-link">
                <img src="image/logo/bks.png" alt="hotel Melayu Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Hotel Bengkalis</span>
            </a>
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a class="d-block">Admin</a>
                    </div>
                </div>
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="index.php?page=beranda"
                                class="nav-link <?= (in_array($request_uri, $beranda) ? 'active' : ''); ?>">
                                <i class="nav-icon fas fa-home"></i>
                                <p>Beranda</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link <?= (in_array($request_uri, $kelola_data) ? 'active' : ''); ?>">
                            <i class="nav-icon fas fa-cogs"></i>
                                <p>
                                    Kelola Data
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="index.php?page=data_hotel"
                                        class="nav-link <?= (in_array($request_uri, $kab_kota_active) ? 'active' : ''); ?>">
                                        <i class="nav-icon fas fa-hotel"></i>
                                        <p>Hotel</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="index.php?page=tambah_lokasi"
                                        class="nav-link <?= (in_array($request_uri, $lokasi_active) ? 'active' : ''); ?>">
                                        <i class="fas fa-map-marker-alt nav-icon"></i>
                                        <p>Tambah Lokasi Hotel</p> 
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="index.php?page=peta_hotel" class="nav-link <?= (in_array($request_uri, $peta_active) ? 'active' : ''); ?>">
                                        <i class="fas fa-map-marker-alt nav-icon"></i>
                                        <p>Maps</p> 
                                    </a>
                                </li>

                                <?php if ($_SESSION['role'] == 'Admin') { ?>
                                    <li class="nav-item">
                                        <a href="index.php?page=data_user"
                                            class="nav-link <?= (in_array($request_uri, $user_active) ? 'active' : ''); ?>">
                                            <i class="far fa-user nav-icon"></i>
                                            <p>Pengguna</p>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="proses/user/proses_logout.php" class="nav-link">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>Logout</p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <?php include "conf/page.php"; ?>
        </div>
        <!-- /.content-wrapper -->
        <!-- Main Footer -->
        <footer class="main-footer">
            <div class="float-right d-none d-sm-inline">
                Developed by: M. SHOLIHUN
            </div>
            <strong>Copyright &copy; 2024</strong> Hotel
        </footer>
    </div>
    <!-- /.wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- DataTables -->
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="plugins/moment/moment.min.js"></script>
    <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="plugins/summernote/summernote-bs4.min.js"></script>
    <!-- Custom JS -->
    <script>
        $(function () {
            // DataTables
            $("#example1").DataTable({
                "responsive": true,
                "autoWidth": false,
            });
        });
    </script>
</body>

</html>
