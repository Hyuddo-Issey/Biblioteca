<?php
require_once '../models/AuthorModel.php';

class AuthorController {
    private $model;

    public function __construct() {
        $this->model = new AuthorModel(); // Instancia el modelo de autor
    }

    // Acción para listar todos los autores
    public function index() {
        $authors = $this->model->getAllAuthors(); // Obtener todos los autores
        require_once '../views/authors/index.php'; // Cargar la vista del listado
    }

    // Acción para crear un nuevo autor
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtener datos del formulario
            $fullName = $_POST['fullName'];
            $birthDate = $_POST['birthDate'];
            $deathDate = $_POST['deathDate'] ?? null;

            // Agregar autor en la base de datos
            $this->model->addAuthor($fullName, $birthDate, $deathDate);

            // Redirigir al listado
            header('Location: index.php?controller=author&action=index');
            exit();
        } else {
            // Cargar la vista del formulario de creación
            require_once '../views/authors/create.php';
        }
    }

    // Acción para editar un autor existente
    public function edit() {
        $id = $_GET['id'] ?? null;

        if ($id === null) {
            // Si no hay ID, redirigir al listado
            header('Location: index.php?controller=author&action=index');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtener datos del formulario
            $fullName = $_POST['fullName'];
            $birthDate = $_POST['birthDate'];
            $deathDate = $_POST['deathDate'] ?? null;

            // Actualizar autor en la base de datos
            $this->model->updateAuthor($id, $fullName, $birthDate, $deathDate);

            // Redirigir al listado
            header('Location: index.php?controller=author&action=index');
            exit();
        } else {
            // Obtener los datos del autor para editar
            $author = $this->model->getAuthorById($id);

            // Cargar la vista del formulario de edición
            require_once '../views/authors/edit.php';
        }
    }

    // Acción para eliminar un autor
    public function delete() {
        $id = $_GET['id'] ?? null;

        if ($id === null) {
            // Si no hay ID, redirigir al listado
            header('Location: index.php?controller=author&action=index');
            exit();
        }

        // Eliminar el autor de la base de datos
        $this->model->deleteAuthor($id);

        // Redirigir al listado
        header('Location: index.php?controller=author&action=index');
        exit();
    }
}
?>
