<?php
require_once '../config/database.php';

class StockModel
{
    private $db;

    public function __construct()
    {
        $this->db = conectarDB(); // Llama a la función de conexión a la base de datos
    }

    public function getAllStock()
    {
        $query = "
            SELECT 
                s.ID_STOCK, 
                s.ID_BOOK, 
                s.TOTAL_STOCK, 
                s.NOTES, 
                s.LAST_INVENTORY_DATE, 
                b.TITLE AS BOOK_TITLE
            FROM stock s
            LEFT JOIN book b ON s.ID_BOOK = b.ID_BOOK
        ";
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener un registro de stock por su ID
    public function getStockById($id)
    {
        $query = "SELECT * FROM stock WHERE ID_STOCK = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT); // Asocia el parámetro id
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); // Devuelve un solo registro de stock
    }

    // Agregar un nuevo registro de stock
    public function addStock($idBook, $totalStock, $notes, $lastInventoryDate)
    {
        $query = "INSERT INTO stock (ID_BOOK, TOTAL_STOCK, NOTES, LAST_INVENTORY_DATE) 
                  VALUES (:idBook, :totalStock, :notes, :lastInventoryDate)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':idBook', $idBook, PDO::PARAM_INT);
        $stmt->bindParam(':totalStock', $totalStock, PDO::PARAM_INT);
        $stmt->bindParam(':notes', $notes);
        $stmt->bindParam(':lastInventoryDate', $lastInventoryDate);
        return $stmt->execute(); // Ejecuta la inserción
    }

    // Actualizar un registro de stock existente
    public function updateStock($id, $idBook, $totalStock, $notes, $lastInventoryDate)
    {
        $query = "UPDATE stock 
                  SET ID_BOOK = :idBook, TOTAL_STOCK = :totalStock, NOTES = :notes, LAST_INVENTORY_DATE = :lastInventoryDate
                  WHERE ID_STOCK = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT); // Asocia el parámetro id
        $stmt->bindParam(':idBook', $idBook, PDO::PARAM_INT);
        $stmt->bindParam(':totalStock', $totalStock, PDO::PARAM_INT);
        $stmt->bindParam(':notes', $notes);
        $stmt->bindParam(':lastInventoryDate', $lastInventoryDate);
        return $stmt->execute(); // Ejecuta la actualización
    }

    // Eliminar un registro de stock por su ID
    public function deleteStock($id)
    {
        $query = "DELETE FROM stock WHERE ID_STOCK = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT); // Asocia el parámetro id
        return $stmt->execute(); // Ejecuta la eliminación
    }
}
