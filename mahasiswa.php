<?php
require_once __DIR__ . '/../config/Database.php';

class Mahasiswa extends Database {
    private $table = "mahasiswa";

    // CREATE
    public function create($nim, $nama, $jurusan, $alamat, $email, $no_hp) {
        $query = "INSERT INTO $this->table VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssssss", $nim, $nama, $jurusan, $alamat, $email, $no_hp);
        return $stmt->execute();
    }

    // READ (FIX)
    public function read() {
        $query = "SELECT * FROM $this->table";
        $result = $this->conn->query($query);

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        return $data;
    }

    // UPDATE
    public function update($nim, $nama, $jurusan, $alamat, $email, $no_hp) {
        $query = "UPDATE $this->table 
                  SET nama=?, jurusan=?, alamat=?, email=?, no_hp=? 
                  WHERE nim=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssssss", $nama, $jurusan, $alamat, $email, $no_hp, $nim);
        return $stmt->execute();
    }

    // DELETE
    public function delete($nim) {
        $query = "DELETE FROM $this->table WHERE nim=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $nim);
        return $stmt->execute();
    }
}