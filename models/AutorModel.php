<?php
require_once '../config/database.php';

class AutorModel {
    private $db;

    public function __construct() {
        $this->db = conectarDB();
    }

    public function obtenerAutores() {
        $query = "SELECT * FROM AUTOR ORDER BY NOMBRE_COMPLETO ASC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerAutorPorId($id) {
        $query = "SELECT * FROM AUTOR WHERE ID_AUTOR = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function agregarAutor($nombre, $fechaNacimiento, $fechaFallecimiento = null) {
        $query = "INSERT INTO AUTOR (NOMBRE_COMPLETO, FECHA_NACIMIENTO, FECHA_FALLECIMIENTO) 
                  VALUES (:nombre, :nacimiento, :fallecimiento)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':nacimiento', $fechaNacimiento);
        $stmt->bindParam(':fallecimiento', $fechaFallecimiento);
        return $stmt->execute();
    }

    public function actualizarAutor($id, $nombre, $fechaNacimiento, $fechaFallecimiento = null) {
        $query = "UPDATE AUTOR 
                  SET NOMBRE_COMPLETO = :nombre, FECHA_NACIMIENTO = :nacimiento, FECHA_FALLECIMIENTO = :fallecimiento 
                  WHERE ID_AUTOR = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':nacimiento', $fechaNacimiento);
        $stmt->bindParam(':fallecimiento', $fechaFallecimiento);
        return $stmt->execute();
    }

    public function eliminarAutor($id) {
        $query = "DELETE FROM AUTOR WHERE ID_AUTOR = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>
