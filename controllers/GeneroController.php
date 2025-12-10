<?php
require_once '../models/GeneroModel.php';

class GeneroController {
    private $modelo;

    public function __construct() {
        $this->modelo = new GeneroModel();
    }

    public function index() {
        try {
            $generos = $this->modelo->obtenerGeneros();
            require_once '../views/generos/index.php';
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $nombre = $_POST['nombre'] ?? '';

            $this->modelo->agregarGenero($nombre);

            header('Location: index.php?controller=genero&action=index');
            exit();
        } else {
            require_once '../views/generos/create.php';
        }
    }

    public function edit() {
        $id = $_GET['id'] ?? null;

        if ($id === null) {
            header('Location: index.php?controller=genero&action=index');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];

            $this->modelo->actualizarGenero($id, $nombre);

            header('Location: index.php?controller=genero&action=index');
            exit();
        } else {
            $genero = $this->modelo->obtenerGeneroPorId($id);

            require_once '../views/generos/edit.php';
        }
    }

    // Acción para eliminar un género
    public function delete() {
        $id = $_GET['id'] ?? null;

        if ($id) {
            try {
                $this->modelo->eliminarGenero($id);
            } catch (Exception $e) {
                // Podrías guardar el error en sesión para mostrarlo luego
            }
        }

        header('Location: index.php?controller=genero&action=index');
        exit();
    }
}
?>