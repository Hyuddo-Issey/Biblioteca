<?php
require_once '../config/database.php';

class AutorModel {
    private $db;

    public function __construct() {
        $this->db = conectarDB(); 
    }

    // Obtener todos los autores
    public function obtenerAutores() {
        $query = "SELECT * FROM AUTOR ORDER BY NOMBRE_COMPLETO ASC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener un autor por su ID
    public function obtenerAutorPorId($id) {
        $query = "SELECT * FROM AUTOR WHERE ID_AUTOR = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Agregar un nuevo autor
    public function agregarAutor($nombreCompleto, $fechaNacimiento, $fechaFallecimiento = null) {
        $query = "INSERT INTO AUTOR (NOMBRE_COMPLETO, FECHA_NACIMIENTO, FECHA_FALLECIMIENTO) 
                  VALUES (:nombre, :nacimiento, :fallecimiento)";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nombre', $nombreCompleto);
        $stmt->bindParam(':nacimiento', $fechaNacimiento);
        $stmt->bindParam(':fallecimiento', $fechaFallecimiento);
        
        return $stmt->execute();
    }
    
    //Auctualizar a un autor ya existente
    public function actualizarAutor($id, $nombreCompleto, $fechaNacimiento, $fechaFallecimiento = null) {
        $query = "UPDATE AUTOR 
                  SET NOMBRE_COMPLETO = :nombre, 
                      FECHA_NACIMIENTO = :nacimiento, 
                      FECHA_FALLECIMIENTO = :fallecimiento 
                  WHERE ID_AUTOR = :id";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nombre', $nombreCompleto);
        $stmt->bindParam(':nacimiento', $fechaNacimiento);
        $stmt->bindParam(':fallecimiento', $fechaFallecimiento);
        
        return $stmt->execute();
    }
    
    //Eliminar un autor
    public function eliminarAutor($id) {
        $query = "DELETE FROM AUTOR WHERE ID_AUTOR = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>
