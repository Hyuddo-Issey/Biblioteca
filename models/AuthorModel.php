<?php
require_once '../config/database.php';

class AuthorModel {
    private $db;

    public function __construct() {
        $this->db = conectarDB(); // Llama a la función de conexión a la base de datos
    }

    // Obtener todos los autores
    public function getAllAuthors() {
        $query = "SELECT * FROM author ORDER BY FULL_NAME ASC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener un autor por su ID
    public function getAuthorById($id) {
        $query = "SELECT * FROM author WHERE ID_AUTHOR = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Agregar un nuevo autor
    public function addAuthor($fullName, $birthDate, $deathDate = null) {
        $query = "INSERT INTO author (FULL_NAME, DATE_OF_BIRTH, DATE_OF_DEATH) 
                  VALUES (:fullName, :birthDate, :deathDate)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':fullName', $fullName);
        $stmt->bindParam(':birthDate', $birthDate);
        $stmt->bindParam(':deathDate', $deathDate);
        return $stmt->execute();
    }

    // Actualizar un autor existente
    public function updateAuthor($id, $fullName, $birthDate, $deathDate = null) {
        $query = "UPDATE author 
                  SET FULL_NAME = :fullName, DATE_OF_BIRTH = :birthDate, DATE_OF_DEATH = :deathDate 
                  WHERE ID_AUTHOR = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':fullName', $fullName);
        $stmt->bindParam(':birthDate', $birthDate);
        $stmt->bindParam(':deathDate', $deathDate);
        return $stmt->execute();
    }

    // Eliminar un autor por su ID
    public function deleteAuthor($id) {
        $query = "DELETE FROM author WHERE ID_AUTHOR = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>
