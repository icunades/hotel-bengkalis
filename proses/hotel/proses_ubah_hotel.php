<?php
include ("../../conf/db_conn.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id = $_POST['id'];
    $nama_hotel = $_POST['nama_hotel'];
    $kategori = $_POST['kategori'];
    $alamat = $_POST['alamat'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];
    $no_hp = $_POST['no_hp'];
    $remove_image = $_POST['image_url_lama'];
    $ubah_image_url = isset($_POST['ubah_image_url']) && $_POST['ubah_image_url'] ? true : false;

    if ($ubah_image_url) {
        $image_url = $_POST['image_url'];
        if (!filter_var($image_url, FILTER_VALIDATE_URL)) {
            echo "<script>alert('URL gambar tidak valid!');</script>";
            echo "<script>window.location='../../index.php?page=ubah_hotel&id=$id';</script>";
        } else {
            $query = "UPDATE tb_hotel SET nama_hotel='$nama_hotel', kategori='$kategori', alamat='$alamat', harga='$harga', deskripsi='$deskripsi', image_url='$image_url' WHERE id='$id'";
            $result = mysqli_query($conn, $query);
            if ($result) {
                echo "<script>alert('Berhasil mengubah data hotel $nama_hotel!');</script>";
                echo "<script>window.location='../../index.php?page=data_hotel';</script>";
            } else {
                echo "<script>alert('Gagal mengubah data hotel $nama_hotel, coba cek isian Anda!');</script>";
                echo "<script>window.location='../../index.php?page=ubah_hotel&id=$id';</script>";
            }
        }
    } else {
        $query = "UPDATE tb_hotel SET nama_hotel='$nama_hotel', kategori='$kategori', alamat='$alamat', harga='$harga', deskripsi='$deskripsi' WHERE id='$id'";
        $result = mysqli_query($conn, $query);
        if ($result) {
            echo "<script>alert('Berhasil mengubah data hotel $nama_hotel!');</script>";
            echo "<script>window.location='../../index.php?page=data_hotel';</script>";
        } else {
            echo "<script>alert('Gagal mengubah data hotel $nama_hotel, coba cek isian Anda!');</script>";
            echo "<script>window.location='../../index.php?page=ubah_hotel&id=$id';</script>";
        }
    }
}
?>