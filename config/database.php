<?php
function conectarDB() {
    $host = 'localhost';
    $dbname = 'LibreriaDB'; 
    $username = 'root';
    $password = '';

    try {
        $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
        
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        $db = new PDO($dsn, $username, $password, $options);
        return $db;

    } catch (PDOException $e) {
        die("<h1>Error de conexión</h1><p>No se pudo conectar a la base de datos 'LibreriaDB'. Verifica que ya la hayas creado en phpMyAdmin.</p><p>Detalle técnico: " . $e->getMessage() . "</p>");
    }
}
?>
