<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1 class="m-0">Kelola Data <i class="fas fa-angle-right"></i> Hotel</h1>
            </div><!-- /.col-sm-12 -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div><!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <!-- jquery validation -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Data Hotel</h3>
                    </div><!-- /.card-header -->
                    <form id="tambahData" method="post" action="proses/hotel/proses_tambah_hotel.php">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="nama_hotel">Nama Hotel</label>
                                <input type="text" id="nama_hotel" name="nama_hotel" class="form-control"
                                    placeholder="Masukkan nama hotel baru...">
                            </div>
                            <div class="form-group">
                            <label for="kategori">Kategori</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="kategoriHotel" name="kategori" value="Hotel" required>
                                    <label class="form-check-label" for="kategoriHotel">Hotel</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="kategoriWisma" name="kategori" value="Wisma" required>
                                    <label class="form-check-label" for="kategoriWisma">Wisma</label>
                                </div>
                            </div>
                        </div>

                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea id="alamat" name="alamat" class="form-control"
                                    placeholder="Masukkan alamat-alamat..."></textarea>
                            </div>
                            <div class="form-group">
                                <label for="harga">Harga</label>
                                <input type="text" id="kategori" name="harga" class="form-control"
                                    placeholder="Masukkan kategori hotel...">
                            </div>
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea id="deskripsi" name="deskripsi" class="form-control"
                                    placeholder="Masukkan deskripsi singkat..."></textarea>
                            </div>
                            <div class="form-group">
                                <label for="no_hp">No Handphone</label>
                                <textarea id="no_hp" name="no_hp" class="form-control"
                                    placeholder="Masukkan No Handphone..."></textarea>
                            </div>
                            <div class="form-group">
                                <label for="image_url">URL Gambar</label>
                                <input type="text" id="image_url" name="image_url" class="form-control"
                                    placeholder="Masukkan URL gambar...">
                            </div>
                            <!-- <div class="form-group">
                                <label for="image_file">Unggah Gambar</label>
                                <input type="file" id="image_file" name="image_file" class="form-control" accept="image/*" required>
                            </div> -->


                        </div><!-- /.card-body -->
                        <div class="card-footer d-flex justify-content-end">
                            <a href="javascript:history.back()" class="btn btn-secondary me-2">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>

                    </form>
                </div><!-- /.card -->
            </div><!-- /.col-md-8 -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div><!-- /.content -->