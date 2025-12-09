<?php
require_once '../config/database.php';

class LibroModel {
    private $db;

    public function __construct() {
        $this->db = conectarDB();
    }

    public function obtenerLibros() {
        $query = "SELECT 
                    b.ID_LIBRO, 
                    b.TITULO, 
                    b.DESCRIPCION, 
                    b.ANIO_PUBLICACION, 
                    a.NOMBRE_COMPLETO AS NOMBRE_AUTOR, 
                    g.NOMBRE AS NOMBRE_GENERO 
                  FROM LIBRO b
                  LEFT JOIN AUTOR a ON b.ID_AUTOR = a.ID_AUTOR
                  LEFT JOIN GENERO g ON b.ID_GENERO = g.ID_GENERO
                  ORDER BY b.TITULO ASC";

        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerLibroPorId($id) {
        $query = "SELECT * FROM LIBRO WHERE ID_LIBRO = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function agregarLibro($titulo, $descripcion, $anioPublicacion, $idAutor, $idGenero) {
        $query = "INSERT INTO LIBRO (TITULO, DESCRIPCION, ANIO_PUBLICACION, ID_AUTOR, ID_GENERO) 
                  VALUES (:titulo, :descripcion, :anio, :idAutor, :idGenero)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':anio', $anioPublicacion);
        $stmt->bindParam(':idAutor', $idAutor, PDO::PARAM_INT);
        $stmt->bindParam(':idGenero', $idGenero, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function actualizarLibro($id, $titulo, $descripcion, $anioPublicacion, $idAutor, $idGenero) {
        $query = "UPDATE LIBRO 
                  SET TITULO = :titulo, DESCRIPCION = :descripcion, ANIO_PUBLICACION = :anio, 
                      ID_AUTOR = :idAutor, ID_GENERO = :idGenero 
                  WHERE ID_LIBRO = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':anio', $anioPublicacion);
        $stmt->bindParam(':idAutor', $idAutor, PDO::PARAM_INT);
        $stmt->bindParam(':idGenero', $idGenero, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function eliminarLibro($id) {
        // Validamos Stock antes de borrar
        $queryCheck = "SELECT COUNT(*) FROM INVENTARIO WHERE ID_LIBRO = :id";
        $stmtCheck = $this->db->prepare($queryCheck);
        $stmtCheck->bindParam(':id', $id, PDO::PARAM_INT);
        $stmtCheck->execute();
        
        if ($stmtCheck->fetchColumn() > 0) {
            throw new Exception("No se puede eliminar el libro: Tiene stock asociado.");
        }
    
        $query = "DELETE FROM LIBRO WHERE ID_LIBRO = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>
