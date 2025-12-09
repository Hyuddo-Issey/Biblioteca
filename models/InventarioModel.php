<?php
require_once '../config/database.php';

class InventarioModel
{
    private $db;

    public function __construct()
    {
        $this->db = conectarDB();
    }

    public function obtenerInventario()
    {
        $query = "
            SELECT 
                i.ID_INVENTARIO, 
                i.ID_LIBRO, 
                i.CANTIDAD_STOCK, 
                i.NOTAS, 
                i.FECHA_ULTIMO_INVENTARIO, 
                l.TITULO AS TITULO_LIBRO
            FROM INVENTARIO i
            LEFT JOIN LIBRO l ON i.ID_LIBRO = l.ID_LIBRO
            ORDER BY l.TITULO ASC
        ";
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerInventarioPorId($id)
    {
        $query = "SELECT * FROM INVENTARIO WHERE ID_INVENTARIO = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function agregarInventario($idLibro, $cantidad, $notas, $fecha = null)
    {
        if ($fecha === null) {
            $fecha = date('Y-m-d');
        }

        $query = "INSERT INTO INVENTARIO (ID_LIBRO, CANTIDAD_STOCK, NOTAS, FECHA_ULTIMO_INVENTARIO) 
                  VALUES (:idLibro, :cantidad, :notas, :fecha)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':idLibro', $idLibro, PDO::PARAM_INT);
        $stmt->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
        $stmt->bindParam(':notas', $notas);
        $stmt->bindParam(':fecha', $fecha);
        return $stmt->execute();
    }

    public function actualizarInventario($id, $idLibro, $cantidad, $notas, $fecha)
    {
        $query = "UPDATE INVENTARIO 
                  SET ID_LIBRO = :idLibro, CANTIDAD_STOCK = :cantidad, NOTAS = :notas, FECHA_ULTIMO_INVENTARIO = :fecha
                  WHERE ID_INVENTARIO = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':idLibro', $idLibro, PDO::PARAM_INT);
        $stmt->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
        $stmt->bindParam(':notas', $notas);
        $stmt->bindParam(':fecha', $fecha);
        return $stmt->execute();
    }

    public function eliminarInventario($id)
    {
        $query = "DELETE FROM INVENTARIO WHERE ID_INVENTARIO = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>
