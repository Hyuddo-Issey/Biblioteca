<?php
require_once '../models/GeneroModel.php';

require_once '../models/GeneroModel.php';

class GeneroController {
    private $modelo;

    public function __construct() {
        $this->modelo = new GeneroModel();
    }

    // Acción para listar todos los géneros
    public function index() {
        $genres = $this->model->getAllGenres();
        require_once '../views/genres/index.php';
    }

    // Acción para crear un nuevo género
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $name = $_POST['name'];

            $this->model->addGenre($name);

            header('Location: index.php?controller=genre&action=index');
            exit();
        } else {
            require_once '../views/genres/create.php';
        }
    }

    // Acción para editar un género existente
    public function edit() {
        $id = $_GET['id'] ?? null;

        if ($id === null) {
            header('Location: index.php?controller=genre&action=index');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];

            $this->model->updateGenre($id, $name);

            header('Location: index.php?controller=genre&action=index');
            exit();
        } else {
            $genre = $this->model->getGenreById($id);

            require_once '../views/genres/edit.php';
        }
    }

    // Acción para eliminar un género
    public function delete() {
        $id = $_GET['id'] ?? null;

        if ($id === null) {
            header('Location: index.php?controller=genre&action=index');
            exit();
        }

        $this->model->deleteGenre($id);

        header('Location: index.php?controller=genre&action=index');
        exit();
    }
}
?>
