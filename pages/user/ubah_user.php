<?php
require ("conf/db_conn.php");

// Ambil id dari parameter GET
$id = $_GET['id'];

// Query untuk mengambil data pengguna berdasarkan id
$query = "SELECT * FROM tb_user WHERE id = '$id'";
$result = mysqli_query($conn, $query);

// Periksa apakah query berhasil dieksekusi
if (!$result) {
    die("Query error: " . mysqli_error($conn));
}

// Ambil data pengguna dari hasil query
$row = mysqli_fetch_array($result);
?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1 class="m-0">Kelola Data <i class="fas fa-angle-right"></i> Pengguna</h1>
            </div><!--/.col -->
        </div><!--/.row -->
    </div><!--/.container-fluid -->
</div><!--/.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <!-- jquery validation -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Ubah Data Pengguna</h3>
                    </div><!--/.card-header -->
                    <!-- form start -->
                    <form id="ubahUser" method="post" action="proses/user/proses_ubah_user.php">
                        <input type="hidden" value="<?= $row['id']; ?>" name="id">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="username">Nama Pengguna</label>
                                <input type="text" name="username" class="form-control" id="username"
                                    placeholder="Masukkan nama pengguna..." value="<?= $row['username']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="email">Alamat Email</label>
                                <input type="email" name="email" class="form-control" id="email"
                                    placeholder="Masukkan email..." value="<?= $row['email']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="no_hp">Nomor Handphone</label>
                                <input type="tel" name="no_hp" class="form-control" id="no_hp"
                                    placeholder="Masukkan nomor handphone..." value="<?= $row['no_hp']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="password">Kata Sandi</label>
                                <input type="password" name="password" class="form-control" id="password"
                                    placeholder="Masukkan kata sandi..." disabled>
                            </div>
                            <div class="form-group">
                                <label for="retype_password">Ulangi Kata Sandi</label>
                                <input type="password" name="retype_password" class="form-control" id="retype_password"
                                    placeholder="Ketik ulang kata sandi..." disabled>
                            </div>
                            <div class="form-group mb-0">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="ubah_password" class="custom-control-input"
                                        id="ubah_password" onchange="togglePasswordFields(this)">
                                    <label class="custom-control-label" for="ubah_password">Ubah Kata Sandi</label>
                                </div>
                            </div>
                        </div><!--/.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div><!--/.card -->
            </div><!--/.col-md-6 -->
        </div><!--/.row -->
    </div><!--/.container-fluid -->
</div><!--/.content -->

<!-- JavaScript untuk mengatur disable/enable field password -->
<script>
    function togglePasswordFields(checkbox) {
        var passwordFields = document.querySelectorAll('input[type="password"]');
        passwordFields.forEach(function (field) {
            field.disabled = !checkbox.checked;
        });
    }
</script>