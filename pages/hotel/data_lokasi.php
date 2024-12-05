<?php
include 'conf/db_conn.php'; // File koneksi database

// Query untuk mengambil semua data lokasi
$sql = "SELECT * FROM tb_lokasi";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Lokasi Hotel/Wisma</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
</head>
<body>

<div class="container mt-5">
    <h1>Data Lokasi Hotel/Wisma</h1>
    <a href="index.php?page=tambah_lokasi" class="btn btn-primary mb-3"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah Lokasi</a>
    <div class="table-responsive">
        <table id="lokasi" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Latitude</th>
                    <th>Longitude</th>
                    <th>Kategori</th>
                    <th style="text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 0; ?>
                <?php if ($result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td style="text-align: center;"><?= ++$no; ?></td>
                            <td><?= htmlspecialchars($row["name"]); ?></td>
                            <td><?= htmlspecialchars($row["latitude"]); ?></td>
                            <td><?= htmlspecialchars($row["longitude"]); ?></td>
                            <td><?= htmlspecialchars($row["kategori"]); ?></td>
                            <td style="text-align: center; white-space:nowrap;">
                                <!-- Detail Modal -->
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-<?= $row["id"]; ?>"><i class="fas fa-eye"></i></button>
                                <a href="index.php?page=ubah_lokasi&id=<?= $row['id']; ?>" class="btn btn-success btn-sm" role="button" title="Ubah Data"><i class="fas fa-edit"></i></a>
                                <a href="proses/hotel/proses_hapus_lokasi.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" role="button" title="Hapus Data" onclick="return confirm('Apakah anda yakin?')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>

                        <!-- Modal untuk menampilkan detail lokasi -->
                        <div class="modal fade" id="modal-<?= $row["id"]; ?>">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Detail Lokasi <?= $row["name"]; ?></h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-sm-5 col-6">Nama</div>
                                                <div class="col-sm-5 col-6">: <?= $row["name"]; ?></div>
                                                <div class="w-100 d-none d-md-block"></div>
                                                <div class="col-sm-5 col-6">Latitude</div>
                                                <div class="col-sm-5 col-6">: <?= $row["latitude"]; ?></div>
                                                <div class="w-100 d-none d-md-block"></div>
                                                <div class="col-sm-5 col-6">Longitude</div>
                                                <div class="col-sm-5 col-6">: <?= $row["longitude"]; ?></div>
                                                <div class="w-100 d-none d-md-block"></div>
                                                <div class="col-sm-5 col-6">Kategori</div>
                                                <div class="col-sm-5 col-6">: <?= $row["kategori"]; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--/.modal-content -->
                            </div>
                            <!--/.modal-dialog -->
                        </div>
                        <!-- /.modal -->
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan='6'>Tidak ada data lokasi.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Scripts -->
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<!-- Page specific script -->
<script>
    $(document).ready(function () {
        $('#lokasi').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>
</body>
</html>
