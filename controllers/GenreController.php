<?php
require_once '../models/GenreModel.php';

class GenreController {
    private $model;

    public function __construct() {
        $this->model = new GenreModel(); // Instancia el modelo de géneros
    }

    // Acción para listar todos los géneros
    public function index() {
        $genres = $this->model->getAllGenres(); // Obtener todos los géneros
        require_once '../views/genres/index.php'; // Cargar la vista del listado
    }

    // Acción para crear un nuevo género
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtener datos del formulario
            $name = $_POST['name'];

            // Agregar el género en la base de datos
            $this->model->addGenre($name);

            // Redirigir al listado de géneros
            header('Location: index.php?controller=genre&action=index');
            exit();
        } else {
            // Cargar la vista del formulario de creación
            require_once '../views/genres/create.php';
        }
    }

    // Acción para editar un género existente
    public function edit() {
        $id = $_GET['id'] ?? null;

        if ($id === null) {
            // Si no hay ID, redirigir al listado
            header('Location: index.php?controller=genre&action=index');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtener datos del formulario
            $name = $_POST['name'];

            // Actualizar el género en la base de datos
            $this->model->updateGenre($id, $name);

            // Redirigir al listado de géneros
            header('Location: index.php?controller=genre&action=index');
            exit();
        } else {
            // Obtener los datos del género para editar
            $genre = $this->model->getGenreById($id);

            // Cargar la vista del formulario de edición
            require_once '../views/genres/edit.php';
        }
    }

    // Acción para eliminar un género
    public function delete() {
        $id = $_GET['id'] ?? null;

        if ($id === null) {
            // Si no hay ID, redirigir al listado
            header('Location: index.php?controller=genre&action=index');
            exit();
        }

        // Eliminar el género de la base de datos
        $this->model->deleteGenre($id);

        // Redirigir al listado de géneros
        header('Location: index.php?controller=genre&action=index');
        exit();
    }
}
?>
