<?php
// index.php

// 1. Configuración Inicial
// Es buena práctica definir rutas base si el proyecto crece, pero por ahora usamos relativas.
require_once '../config/database.php';

// 2. Mapeo de Controladores (Routing)
// IMPORTANTE: Aquí actualizamos los nombres para que coincidan con tus archivos en español.
// Clave (URL) => Valor (Nombre de la Clase)
$controladores = [
    'home'       => 'HomeController',
    'autor'      => 'AutorController',
    'genero'     => 'GeneroController',
    'libro'      => 'LibroController',
    'inventario' => 'InventarioController' // Antes era 'stock', ahora apunta al nuevo
];

// 3. Obtener Controlador y Acción desde la URL
// Si no existe $_GET['controller'], usamos 'home'.
$nombreControladorURL = isset($_GET['controller']) ? strtolower($_GET['controller']) : 'home';
$accion = isset($_GET['action']) ? $_GET['action'] : 'index';

// 4. Validación del Controlador
if (array_key_exists($nombreControladorURL, $controladores)) {
    $nombreClase = $controladores[$nombreControladorURL];
} else {
    // Si escriben algo raro en la URL, los mandamos al Home o a una página de error 404
    $nombreClase = 'HomeController';
    $nombreControladorURL = 'home'; 
}

// 5. Carga del Archivo del Controlador
$archivoControlador = "../controllers/{$nombreClase}.php";

if (file_exists($archivoControlador)) {
    require_once $archivoControlador;

    // Instanciar la clase (Ej. new AutorController())
    $controlador = new $nombreClase();

    // 6. Ejecutar la Acción
    if (method_exists($controlador, $accion)) {
        // Buffer de salida: Capturamos el HTML que genera el controlador para inyectarlo en la plantilla
        ob_start();
        $controlador->$accion();
        $contenidoPrincipal = ob_get_clean();
    } else {
        $contenidoPrincipal = "<div class='alert alert-danger'>Error: La acción '{$accion}' no existe en '{$nombreClase}'.</div>";
    }
} else {
    $contenidoPrincipal = "<div class='alert alert-danger'>Error Crítico: No se encuentra el archivo '{$archivoControlador}'.</div>";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Biblioteca</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

    <style>
        /* Estilos personalizados simples */
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa; /* Gris muy suave de fondo */
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Para que el footer se quede abajo */
        }
        .navbar {
            background-color: #ffffff; /* Blanco puro */
            border-bottom: 1px solid #e0e0e0;
        }
        .navbar-brand {
            font-weight: 700;
            color: #0d6efd !important; /* Azul Bootstrap */
        }
        .nav-link.active {
            color: #0d6efd !important;
            font-weight: 500;
            border-bottom: 2px solid #0d6efd;
        }
        .main-container {
            flex: 1; /* Empuja el footer hacia abajo */
            padding-bottom: 2rem;
        }
        .footer {
            background-color: #343a40;
            color: #adb5bd;
            padding: 1.5rem 0;
            margin-top: auto;
        }
        .card {
            border: none;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05); /* Sombra suave */
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="bi bi-book-half me-2"></i>LibreríaDB
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <?php $ctrl = $nombreControladorURL; ?>

                    <li class="nav-item">
                        <a class="nav-link <?= $ctrl == 'home' ? 'active' : '' ?>" href="index.php?controller=home&action=index">
                            <i class="bi bi-house-door"></i> Inicio
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $ctrl == 'autor' ? 'active' : '' ?>" href="index.php?controller=autor&action=index">
                            <i class="bi bi-person-badge"></i> Autores
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $ctrl == 'genero' ? 'active' : '' ?>" href="index.php?controller=genero&action=index">
                            <i class="bi bi-tags"></i> Géneros
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $ctrl == 'libro' ? 'active' : '' ?>" href="index.php?controller=libro&action=index">
                            <i class="bi bi-journal-bookmark"></i> Libros
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $ctrl == 'inventario' ? 'active' : '' ?>" href="index.php?controller=inventario&action=index">
                            <i class="bi bi-boxes"></i> Inventario
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4 main-container">
        <?= $contenidoPrincipal; ?>
    </div>

    <footer class="footer text-center">
        <div class="container">
            <p class="mb-0">© <?= date('Y') ?> Sistema de Gestión de Biblioteca</p>
            <small>Desarrollado con PHP, PDO y MySQL/SQLServer</small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
