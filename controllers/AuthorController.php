<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once '../models/AutorModel.php';

class AutorController {
    private $modelo;

    public function __construct() {
        $this->modelo = new AutorModel();
    }

    // Acción para listar autores
    public function index() {
        try {
            $autores = $this->modelo->obtenerAutores();
            require_once '../views/autores/index.php';
        } catch (Exception $e) {
            $this->setFlashMessage('error', 'Error al cargar autores: ' . $e->getMessage());
            require_once '../views/autores/index.php';
        }
    }

    // Acción para crear
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = trim($_POST['nombre'] ?? '');
            $fechaNacimiento = $_POST['fechaNacimiento'] ?? '';
            $fechaFallecimiento = !empty($_POST['fechaFallecimiento']) ? $_POST['fechaFallecimiento'] : null;

            if (empty($nombre) || empty($fechaNacimiento)) {
                $this->setFlashMessage('warning', 'El nombre y la fecha de nacimiento son obligatorios.');
                require_once '../views/autores/create.php';
                return;
            }

            try {
                $this->modelo->agregarAutor($nombre, $fechaNacimiento, $fechaFallecimiento);
                $this->setFlashMessage('success', 'Autor registrado correctamente.');
                header('Location: index.php?controller=autor&action=index');
                exit();
            } catch (Exception $e) {
                $this->setFlashMessage('error', 'Error al guardar: ' . $e->getMessage());
                require_once '../views/autores/create.php';
            }
        } else {
            require_once '../views/autores/create.php';
        }
    }

    // Acción para editar
    public function edit() {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            $this->setFlashMessage('error', 'ID de autor no especificado.');
            header('Location: index.php?controller=autor&action=index');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = trim($_POST['nombre']);
            $fechaNacimiento = $_POST['fechaNacimiento'];
            $fechaFallecimiento = !empty($_POST['fechaFallecimiento']) ? $_POST['fechaFallecimiento'] : null;

            try {
                $this->modelo->actualizarAutor($id, $nombre, $fechaNacimiento, $fechaFallecimiento);
                $this->setFlashMessage('success', 'Autor actualizado correctamente.');
                header('Location: index.php?controller=autor&action=index');
                exit();
            } catch (Exception $e) {
                $this->setFlashMessage('error', 'No se pudo actualizar: ' . $e->getMessage());
                $autor = $this->modelo->obtenerAutorPorId($id); 
                require_once '../views/autores/edit.php';
            }
        } else {
            $autor = $this->modelo->obtenerAutorPorId($id);
            if (!$autor) {
                $this->setFlashMessage('error', 'El autor no existe.');
                header('Location: index.php?controller=autor&action=index');
                exit();
            }
            require_once '../views/autores/edit.php';
        }
    }

    // Acción para eliminar
    public function delete() {
        $id = $_GET['id'] ?? null;

        if ($id) {
            try {
                $this->modelo->eliminarAutor($id);
                $this->setFlashMessage('success', 'Autor eliminado correctamente.');
            } catch (Exception $e) {
                $this->setFlashMessage('error', 'Error al eliminar: ' . $e->getMessage());
            }
        }

        header('Location: index.php?controller=autor&action=index');
        exit();
    }

    private function setFlashMessage($tipo, $mensaje) {
        $_SESSION['flash_message'] = [
            'type' => $tipo, // 'success', 'error', 'warning'
            'text' => $mensaje
        ];
    }
}
?>
