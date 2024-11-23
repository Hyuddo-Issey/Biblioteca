<?php
require_once '../config/database.php';

class GenreModel {
    private $db;

    public function __construct() {
        $this->db = conectarDB(); // Llama a la función de conexión a la base de datos
    }

    // Obtener todos los géneros
    public function getAllGenres() {
        $query = "SELECT * FROM genre ORDER BY NAME ASC"; // Se ordenan los géneros por nombre
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Devuelve todos los géneros en un array
    }

    // Obtener un género por su ID
    public function getGenreById($id) {
        $query = "SELECT * FROM genre WHERE ID_GENRE = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT); // Asocia el parámetro id
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); // Devuelve un solo género
    }

    // Agregar un nuevo género
    public function addGenre($name) {
        $query = "INSERT INTO genre (NAME) VALUES (:name)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':name', $name); // Asocia el parámetro name
        return $stmt->execute(); // Ejecuta la inserción en la base de datos
    }

    // Actualizar un género existente
    public function updateGenre($id, $name) {
        $query = "UPDATE genre SET NAME = :name WHERE ID_GENRE = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT); // Asocia el parámetro id
        $stmt->bindParam(':name', $name); // Asocia el parámetro name
        return $stmt->execute(); // Ejecuta la actualización
    }

    // Eliminar un género
    public function deleteGenre($id) {
        $query = "DELETE FROM genre WHERE ID_GENRE = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT); // Asocia el parámetro id
        return $stmt->execute(); // Ejecuta la eliminación
    }
}
?>
