<?php
require ("conf/db_conn.php");

$query = "SELECT * FROM tb_hotel";
$daftar_hotel = mysqli_query($conn, $query);
?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1 class="m-0">Kelola Data <i class="fas fa-angle-right"></i> Hotel</h1>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Daftar Hotel</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <a href="index.php?page=tambah_hotel" type="button" class="btn btn-primary mb-3"><i
                                class="fa fa-plus"></i>&nbsp;&nbsp;Tambah Data</a>
                        <div class="table-responsive">
                            <table id="hotel" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Hotel</th>
                                        <th>Kategori</th>


                                        <th style="text-align: center;">Image</th>
                                        <th style="text-align: center;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 0; ?>
                                    <?php foreach ($daftar_hotel as $row): ?>
                                        <tr>
                                            <td style="text-align: center;"><?= ++$no; ?></td>
                                            <td><?= htmlspecialchars($row["nama_hotel"]); ?></td>
                                            <td><?= htmlspecialchars($row["kategori"]); ?></td>


                                            <td style="text-align: center;">
                                                <?php
                                                $image_url = $row["image_url"];
                                                if ($image_url == null) {
                                                    echo "<img src='image/hotel/default.png' style='width: 80px;'/>";
                                                } else {
                                                    echo "<img src='$image_url' style='width: 80px;'/>";
                                                }
                                                ?>
                                            </td>
                                            <td style="text-align: center; white-space:nowrap;">
                                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                                    data-target="#modal-<?= $row["id"]; ?>"><i
                                                        class="fas fa-eye"></i></button>
                                                <a href="index.php?page=ubah_hotel&id=<?= $row['id']; ?>"
                                                    class="btn btn-success btn-sm" role="button" title="Ubah Data"><i
                                                        class="fas fa-edit"></i></a>
                                                <a href="proses/hotel/proses_hapus_hotel.php?id=<?= $row['id']; ?>"
                                                    class="btn btn-danger btn-sm" role="button" title="Hapus Data"
                                                    onclick="return confirm('Apakah anda yakin?')">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="modal-<?= $row["id"]; ?>">
                                            <div class="modal-dialog modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Detail Data <?= $row["nama_hotel"]; ?></h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="container">
                                                            <div class="row">
                                                                <div class="col-12 mb-2 text-center">
                                                                    <?php $image_url = $row["image_url"];
                                                                    if ($image_url == null) {
                                                                        echo "<img src='image/hotel/default.png' style='width: 400px;'/>";
                                                                    } else {
                                                                        echo "<img src='$image_url' style='width: 400px;'/>";
                                                                    }
                                                                    ?>
                                                                    
                                                                </div>
                                                                <div class="col-sm-5 col-6">Kategori</div>
                                                                <div class="col-sm-5 col-6">: <?= $row["kategori"]; ?></div>
                                                                <div class="w-100 d-none d-md-block"></div>
                                                                <div class="col-sm-5 col-6">Alamat</div>
                                                                <div class="col-sm-5 col-6">: <?= $row["alamat"]; ?></div>
                                                                <div class="w-100 d-none d-md-block"></div>
                                                                <div class="col-sm-5 col-6">Harga</div>
                                                                <div class="col-sm-5 col-6">: <?= $row["harga"]; ?></div>
                                                                <div class="w-100 d-none d-md-block"></div>
                                                                <div class="col-sm-5 col-6">Deskripsi</div>
                                                                <div class="col-sm-5 col-6">: <?= $row["deskripsi"]; ?>
                                                                <div class="w-100 d-none d-md-block"></div>
                                                                <div class="col-sm-5 col-6">No Handphone</div>
                                                                <div class="col-sm-5 col-6">: <?= $row["no_hp"]; ?>
                                                                </div>
                                                                <div class="w-100 d-none d-md-block"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--/.modal-content -->
                                            </div>
                                            <!--/.modal-dialog -->
                                        </div>
                                        <!-- /.modal -->
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /.content -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- Page specific script -->
<script>
    $(document).ready(function () {
        if (!$.fn.dataTable.isDataTable('#hotel')) {
            $('#hotel').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        }
    });
</script>