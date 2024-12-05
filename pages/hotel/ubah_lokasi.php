<?php
include 'conf/db_conn.php'; // File koneksi database

$id = $_GET['id'];
$query = "SELECT * FROM tb_lokasi WHERE id = '$id'";
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $description = $_POST['description'];
    $kategori = $_POST['kategori']; // Ambil kategori dari form

    // Validasi kategori agar sesuai dengan ENUM
    if (!in_array($kategori, ['hotel', 'wisma'])) {
        echo "<script>
                alert('Kategori tidak valid!');
                window.history.back(); // Kembali ke halaman sebelumnya
              </script>";
        exit();
    }

    // Query untuk mengubah data lokasi di database
    $sql = "UPDATE tb_lokasi SET name='$name', latitude='$latitude', longitude='$longitude', description='$description', kategori='$kategori' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Data lokasi berhasil diubah!');
                window.location.href = '?page=data_lokasi'; // Redirect ke halaman data lokasi
              </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Lokasi Hotel/Wisma</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h1>Ubah Data Lokasi Hotel/Wisma</h1>
    <hr>
    <form method="POST" action="">
        <input type="hidden" name="id" value="<?= $row['id']; ?>">
        <div class="mb-3">
            <label for="name" class="form-label">Nama Hotel/Wisma</label>
            <input type="text" id="name" name="name" class="form-control" value="<?= $row['name']; ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Kategori</label><br>
            <div>
                <input type="radio" name="kategori" value="hotel" <?= ($row['kategori'] == 'hotel') ? 'checked' : ''; ?> required> Hotel
                <input type="radio" name="kategori" value="wisma" <?= ($row['kategori'] == 'wisma') ? 'checked' : ''; ?> required> Wisma
            </div>
        </div>
        <div class="mb-3">
            <label for="latitude" class="form-label">Latitude</label>
            <input type="text" id="latitude" name="latitude" class="form-control" value="<?= $row['latitude']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="longitude" class="form-label">Longitude</label>
            <input type="text" id="longitude" name="longitude" class="form-control" value="<?= $row['longitude']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea id="description" name="description" class="form-control" rows="3" required><?= $row['description']; ?></textarea>
        </div>

        <div class="d-flex justify-content-end">
            <a href="javascript:history.back()" class="btn btn-secondary me-2">Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
