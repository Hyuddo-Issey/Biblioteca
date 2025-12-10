<?php
require_once '../config/database.php';

$controladores = [
    'home'       => 'HomeController',
    'autor'      => 'AutorController',
    'genero'     => 'GeneroController',
    'libro'      => 'LibroController',
    'inventario' => 'InventarioController'
];

$nombreControladorURL = isset($_GET['controller']) ? strtolower($_GET['controller']) : 'home';
$accion = isset($_GET['action']) ? $_GET['action'] : 'index';

if (array_key_exists($nombreControladorURL, $controladores)) {
    $nombreClase = $controladores[$nombreControladorURL];
} else {
    $nombreClase = 'HomeController';
    $nombreControladorURL = 'home'; 
}

$archivoControlador = "../controllers/{$nombreClase}.php";

if (file_exists($archivoControlador)) {
    require_once $archivoControlador;

    $controlador = new $nombreClase();

    if (method_exists($controlador, $accion)) {
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

    <link rel="stylesheet" href="css/navbar.css">

    <link rel="stylesheet" href="css/estilos.css">
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