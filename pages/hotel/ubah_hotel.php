<?php
include ("conf/db_conn.php");

$id = $_GET['id'];
$query = "SELECT * FROM tb_hotel WHERE id = '$id'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);

// Check if the query executed successfully
if (!$result) {
    die('Error fetching data: ' . mysqli_error($conn));
}

// Check if $row is not empty before using it
if (!$row) {
    die('No data found for the given ID');
}
?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1 class="m-0">Kelola Data <i class="fas fa-angle-right"></i> Hotel</h1>
            </div><!--/.col-->
        </div><!--/.row -->
    </div><!-- /.container-fluid -->
</div><!--/.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <!-- jquery validation -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Ubah Data Hotel</h3>
                    </div>
                    <!--/.card-header -->
                    <!-- form start -->
                    <form id="ubahData" method="post" action="proses/hotel/proses_ubah_hotel.php">
                        <input type="hidden" value="<?= $row['id']; ?>" name="id">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="nama_hotel">Nama Hotel</label>
                                <input type="text" name="nama_hotel" class="form-control" id="nama_hotel"
                                    placeholder="Masukkan nama hotel baru..." value="<?= $row['nama_hotel'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="kategori">Kategori</label>
                                <input type="text" name="kategori" class="form-control" id="kategori"
                                    placeholder="Masukkan kategori hotel..." value="<?= $row['kategori'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea name="alamat" class="form-control" id="alamat"
                                    placeholder="Masukkan alamat..." required><?= $row['alamat'] ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="harga">Harga</label>
                                <textarea name="harga" class="form-control" id="harga"
                                    placeholder="Masukkan harga ..." required><?= $row['harga'] ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi </label>
                                <textarea name="deskripsi" class="form-control" id="deskripsi"
                                    placeholder="Masukkan deskripsi singkat..." required><?= $row['deskripsi'] ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="no_hp">No Handphone </label>
                                <textarea name="no_hp" class="form-control" id="no_hp"
                                    placeholder="Masukkan No Handphone..." required><?= $row['no_hp'] ?></textarea>
                            </div>
                            <input type="hidden" value="<?= $row['image_url']; ?>" name="image_url_lama">
                            <div class="form-group">
                                <label for="image_url">URL Gambar</label>
                                <input type="text" class="form-control" id="image_url" name="image_url"
                                    value="<?= $row['image_url'] ?>" placeholder="Masukkan URL gambar...">
                            </div>
                            <div class="form-group mb-0">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="ubah_image_url" class="custom-control-input"
                                        id="ubah_image_url" onchange="toggleImageUrlInput(this)">
                                    <label class="custom-control-label" for="ubah_image_url">Ubah URL Gambar</label>
                                </div>
                            </div>
                        </div><!--/.card-body -->
                        <div class="card-footer d-flex justify-content-end">
                            <a href="javascript:history.back()" class="btn btn-secondary me-2">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div><!--/.card -->
            </div>
        </div><!--/.row -->
    </div><!--/.container-fluid -->
</div><!--/.content -->

<script>
    function toggleImageUrlInput(checkbox) {
        var imageUrlInput = document.getElementById('image_url');
        imageUrlInput.disabled = !checkbox.checked;
    }
</script>
