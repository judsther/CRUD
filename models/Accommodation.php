<?php

class Accommodation {
    private $db;

    public function __construct() {
        require_once 'Database.php'; // Asegúrate de que este archivo exista y sea correcto
        $this->db = (new Database())->connect(); // Conexión a la base de datos
    }

    // Obtener todos los alojamientos
    public function getAll() {
        $query = 'SELECT * FROM accommodations';
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Devuelve todos los resultados como un array asociativo
    }

    // Obtener un alojamiento por ID
    public function getById($id) {
        $query = 'SELECT * FROM accommodations WHERE id = :id';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); // Devuelve un solo resultado como un array asociativo
    }

    // Crear un nuevo alojamiento
    public function create($name, $price, $image = null) {
        $query = 'INSERT INTO accommodations (name, price, image) VALUES (:name, :price, :image)';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':image', $image);
        return $stmt->execute(); // Devuelve true si la inserción fue exitosa
    }

    // Actualizar un alojamiento
    public function update($id, $name, $price, $image = null) {
        $query = 'UPDATE accommodations SET name = :name, price = :price, image = :image WHERE id = :id';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':image', $image);
        return $stmt->execute(); // Devuelve true si la actualización fue exitosa
    }

    // Eliminar un alojamiento
    public function delete($id) {
        $query = 'DELETE FROM accommodations WHERE id = :id';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute(); // Devuelve true si la eliminación fue exitosa
    }
}
