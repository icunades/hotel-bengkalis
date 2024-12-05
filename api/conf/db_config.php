<?php
class Database
{
    // Properti untuk menyimpan informasi koneksi database
    private $host = 'localhost';
    private $db_name = 'db_hotel';
    private $username = 'root';
    private $password = '';
    private $connection = null;

    // Metode untuk menghubungkan ke database
    public function connect()
    {
        try {
            // Membuat koneksi menggunakan PDO
            $this->connection = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
            // Mengatur mode error PDO menjadi Exception
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exc) {
            // Menangkap dan menampilkan pesan error jika koneksi gagal
            echo 'Connection Error: ' . $exc->getMessage();
        }
        // Mengembalikan objek koneksi
        return $this->connection;
    }
}
?>