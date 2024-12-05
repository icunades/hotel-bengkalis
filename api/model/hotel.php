<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

class Hotel
{
    public $id;
    public $nama_hotel;
    public $kategori;
    public $alamat;
    public $harga;
    public $image_url;
    public $deskripsi;
    public $no_hp;
    private $connection;
    private $table = 'tb_hotel';

    public function __construct($db)
    {
        $this->connection = $db;
    }

    public function home()
    {
        return "Selamat Datang di API Hotel versi 1.0!";
    }

    public function readHotel()
    {
        // Query to read data from table
        $query = "SELECT * FROM " . $this->table . " ORDER BY id DESC";
        $data = $this->connection->prepare($query);
        $data->execute();
        return $data;
    }

    public function readHotelById($_id)
    {
        $this->id = $_id;
        // Query to read data by id
        $query = "SELECT * FROM " . $this->table . " WHERE id=?";
        $data = $this->connection->prepare($query);
        $data->bindValue(1, $this->id, PDO::PARAM_INT);
        $data->execute();
        return $data;
    }

    public function createHotel($params)
    {
        try {
            // Assign values
            $this->nama_hotel = $params['nama_hotel'];
            $this->kategori = $params['kategori'];
            $this->alamat = $params['alamat'];
            $this->harga = $params['harga'];
            $this->image_url = $params['image_url'] ?? 'logo_default.png';
            $this->deskripsi = $params['deskripsi'];
            $this->no_hp = $params['no_hp'];

            // Query to insert data into table
            $query = "INSERT INTO " . $this->table . " 
                      SET nama_hotel = :nama_hotel, 
                          kategori = :kategori, 
                          alamat = :alamat, 
                          harga = :harga, 
                          image_url = :image_url, 
                          deskripsi = :deskripsi,
                          no_hp = :no_hp";
            $data = $this->connection->prepare($query);
            $data->bindValue(':nama_hotel', $this->nama_hotel);
            $data->bindValue(':kategori', $this->kategori);
            $data->bindValue(':alamat', $this->alamat);
            $data->bindValue(':harga', $this->harga);
            $data->bindValue(':image_url', $this->image_url);
            $data->bindValue(':deskripsi', $this->deskripsi);
            $data->bindValue(':no_hp', $this->no_hp);
            if ($data->execute()) {
                return true;
            }
            return false;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function updateHotel($params)
    {
        try {
            // Assign values
            $this->id = $params['id'];
            $this->nama_hotel = $params['nama_hotel'];
            $this->kategori = $params['kategori'];
            $this->alamat = $params['alamat'];
            $this->harga = $params['harga'];
            $this->image_url = $params['image_url'] ?? 'logo_default.png';
            $this->deskripsi = $params['deskripsi'];
            $this->no_hp = $params['no_hp'];

            // Query to update data
            $query = "UPDATE " . $this->table . " SET
                      nama_hotel = :nama_hotel,
                      kategori = :kategori,
                      alamat = :alamat,
                      harga = :harga,
                      image_url = :image_url,
                      deskripsi = :deskripsi,
                      no_hp = :no_hp
                      WHERE id = :id";
            $data = $this->connection->prepare($query);
            $data->bindValue(':id', $this->id);
            $data->bindValue(':nama_hotel', $this->nama_hotel);
            $data->bindValue(':kategori', $this->kategori);
            $data->bindValue(':alamat', $this->alamat);
            $data->bindValue(':harga', $this->harga);
            $data->bindValue(':image_url', $this->image_url);
            $data->bindValue(':deskripsi', $this->deskripsi);
            $data->bindValue(':no_hp', $this->no_hp);
            if ($data->execute()) {
                return true;
            }
            return false;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function updateHotelById($params)
    {
        try {
            // Assign values
            $this->id = $params['id'];
            $this->nama_hotel = $params['nama_hotel'];
            $this->kategori = $params['kategori'];
            $this->alamat = $params['alamat'];
            $this->harga = $params['harga'];
            $this->deskripsi = $params['deskripsi'];
            $this->no_hp = $params['no_hp'];
            // Query to update data without image
            $query = "UPDATE " . $this->table . " SET
                      nama_hotel = :nama_hotel,
                      kategori = :kategori,
                      alamat = :alamat,
                      harga = :harga,
                      deskripsi = :deskripsi,
                      no_hp = :no_hp
                      WHERE id = :id";
            $data = $this->connection->prepare($query);
            $data->bindValue(':id', $this->id);
            $data->bindValue(':nama_hotel', $this->nama_hotel);
            $data->bindValue(':kategori', $this->kategori);
            $data->bindValue(':alamat', $this->alamat);
            $data->bindValue(':harga', $this->harga);
            $data->bindValue(':deskripsi', $this->deskripsi);
            $data->bindValue(':no_hp', $this->no_hp);
            if ($data->execute()) {
                return true;
            }
            return false;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function deleteHotel($id)
    {
        try {
            // Assign value
            $this->id = $id;

            // Query to delete data
            $query = "DELETE FROM " . $this->table . " WHERE id = :id";
            $data = $this->connection->prepare($query);
            $data->bindValue(':id', $this->id);

            if ($data->execute()) {
                return true;
            }
            return false;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
?>