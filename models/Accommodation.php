<?php

class Accommodation {
    private $db;

    public $id;
    public $name;
    public $description;
    public $location;
    public $price;
    public $image;

    public function __construct() {
        require_once 'Database.php'; 
        $this->db = (new Database())->getConnection(); 
    }

    // Obtener todos los alojamientos
    public function getAll() {
        $query = 'SELECT * FROM accommodations';
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }

    // Obtener un alojamiento por ID
    public function getById($id) {
        $query = 'SELECT * FROM accommodations WHERE id = :id';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); 
    }

    // Crear un nuevo alojamiento
    public function createAccommodation($name, $description, $location, $price, $image, $userId) {
        $stmt = $this->db->prepare("INSERT INTO accommodations (name, description, location, price, image, user_id, created_at) VALUES (?, ?, ?, ?, ?, ?, NOW())");
        $stmt->bind_param('sssdsd', $name, $description, $location, $price, $image, $userId);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Actualizar un alojamiento
    public function update($id, $name, $price, $image = null) {
        $query = 'UPDATE accommodations SET name = :name, price = :price, image = :image WHERE id = :id';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':image', $image);
        return $stmt->execute(); 
    }

    // Eliminar un alojamiento
    public function delete($id) {
        $query = 'DELETE FROM accommodations WHERE id = :id';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute(); 
    }
}
