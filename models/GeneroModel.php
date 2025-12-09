<?php
require_once '../config/database.php';

class GeneroModel {
    private $db;

    public function __construct() {
        $this->db = conectarDB();
    }

    public function obtenerGeneros() {
        $query = "SELECT * FROM GENERO ORDER BY NOMBRE ASC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerGeneroPorId($id) {
        $query = "SELECT * FROM GENERO WHERE ID_GENERO = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function agregarGenero($nombre) {
        $query = "INSERT INTO GENERO (NOMBRE) VALUES (:nombre)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nombre', $nombre);
        return $stmt->execute();
    }

    public function actualizarGenero($id, $nombre) {
        $query = "UPDATE GENERO SET NOMBRE = :nombre WHERE ID_GENERO = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nombre', $nombre);
        return $stmt->execute();
    }

    public function eliminarGenero($id) {
        // Validamos si hay libros usando este género
        $queryCheck = "SELECT COUNT(*) FROM LIBRO WHERE ID_GENERO = :id";
        $stmtCheck = $this->db->prepare($queryCheck);
        $stmtCheck->bindParam(':id', $id, PDO::PARAM_INT);
        $stmtCheck->execute();

        if ($stmtCheck->fetchColumn() > 0) {
            throw new Exception("No se puede eliminar: Hay libros asociados a este género.");
        }

        $query = "DELETE FROM GENERO WHERE ID_GENERO = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>
