<?php
// Asegúrate de que la ruta a database.php sea correcta según tu estructura de carpetas
require_once '../config/database.php';

class HomeController {

    public function index() {
        $cantidadLibros = 0;
        $cantidadAutores = 0;
        $cantidadGeneros = 0;
        $totalInventario = 0;
        $error = null;

        try {
            $pdo = conectarDB(); 
            
            $stmtLibros = $pdo->query('SELECT COUNT(*) FROM LIBRO');
            $cantidadLibros = $stmtLibros->fetchColumn();
            
            $stmtAutores = $pdo->query('SELECT COUNT(*) FROM AUTOR');
            $cantidadAutores = $stmtAutores->fetchColumn();
            
            $stmtGeneros = $pdo->query('SELECT COUNT(*) FROM GENERO');
            $cantidadGeneros = $stmtGeneros->fetchColumn();

            $stmtStock = $pdo->query('SELECT SUM(CANTIDAD_STOCK) FROM INVENTARIO');
            $totalInventario = $stmtStock->fetchColumn();

            if ($totalInventario === false || $totalInventario === null) {
                $totalInventario = 0;
            }

        } catch (Exception $e) {
            $error = "Error de conexión: " . $e->getMessage();
        }

        require_once '../views/inicio/index.php';
    }
}
?>
