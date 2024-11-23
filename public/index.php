<?php
require_once '../config/database.php';

// Definir los controladores y sus acciones disponibles
$controllers = [
    'author' => 'AuthorController',
    'genre' => 'GenreController',
    'book' => 'BookController',
    'stock' => 'StockController',
    'home' => 'HomeController',  // Agregar controlador 'home'
];

// Obtener el controlador solicitado, por defecto 'author'
$controllerName = $_GET['controller'] ?? 'home'; // Si no se pasa 'controller', usamos 'home' para mostrar la página de inicio
$controllerName = strtolower($controllerName); // Convertir a minúsculas para evitar problemas de mayúsculas

// Verificar si el controlador existe en el arreglo, si no, cargar el controlador por defecto
if (!isset($controllers[$controllerName])) {
    $controllerName = 'author'; // Controlador por defecto
}

// Obtener la acción solicitada, por defecto 'index'
$action = $_GET['action'] ?? 'index'; // Acción por defecto es 'index'

// Definir las acciones válidas para cada controlador
$validActions = [
    'index',
    'create',
    'edit',
    'delete'
];

// Verificar si la acción es válida, si no, redirigir a 'index'
if (!in_array($action, $validActions)) {
    $action = 'index';
}

// Cargar el controlador correspondiente
require_once "../controllers/{$controllers[$controllerName]}.php";

// Instanciar el controlador
$controllerInstance = new $controllers[$controllerName]();

// Validar que el método existe y ejecutarlo
if (method_exists($controllerInstance, $action)) {
    // Capturar el contenido dinámico desde la acción del controlador
    ob_start(); // Iniciar el buffer de salida
    $controllerInstance->$action();
    $content = ob_get_clean(); // Obtener y limpiar el contenido generado
} else {
    $content = "<p>Acción no válida o no implementada.</p>";
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/navbar.css">
</head>

<body>
    <!-- Barra de navegación con Bootstrap -->
    <nav class="navbar navbar-expand-lg navbar-light bg-transparent shadow-sm mb-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Biblioteca</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=home&action=index">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=author&action=index">Autores</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=genre&action=index">Géneros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=book&action=index">Libros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=stock&action=index">Stock</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <!-- Contenido principal -->
    <div class="container mt-5">
        <div class="content">
            <?= $content; ?>
        </div>
    </div>

    <!-- Scripts de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>