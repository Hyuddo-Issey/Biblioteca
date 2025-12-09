<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once '../models/InventarioModel.php';
require_once '../models/LibroModel.php';

class InventarioController {
    private $modelo;
    private $libroModelo;

    public function __construct() {
        $this->modelo = new InventarioModel();
        $this->libroModelo = new LibroModel(); 
    }

    // Listar todo el stock
    public function index() {
        try {
            $inventario = $this->modelo->obtenerInventario();
            require_once '../views/inventario/index.php';
        } catch (Exception $e) {
            $this->setFlashMessage('error', 'Error al cargar el inventario: ' . $e->getMessage());
            require_once '../views/inventario/index.php';
        }
    }
    
    // Crear nuevo registro de stock
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $idLibro = $_POST['idLibro'] ?? '';
            $cantidad = $_POST['cantidad'] ?? '';
            $notas = trim($_POST['notas'] ?? '');
            $fecha = !empty($_POST['fecha']) ? $_POST['fecha'] : null;

            if (empty($idLibro) || $cantidad === '') {
                $this->setFlashMessage('warning', 'Debes seleccionar un libro e indicar la cantidad.');
                $libros = $this->libroModelo->obtenerLibros();
                require_once '../views/inventario/create.php';
                return;
            }

            try {
                $this->modelo->agregarInventario($idLibro, $cantidad, $notas, $fecha);
                $this->setFlashMessage('success', 'Stock agregado correctamente.');
                
                header('Location: index.php?controller=inventario&action=index');
                exit();
            } catch (Exception $e) {
                $this->setFlashMessage('error', 'Error al guardar: ' . $e->getMessage());
                $libros = $this->libroModelo->obtenerLibros();
                require_once '../views/inventario/create.php';
            }

        } else {
            $libros = $this->libroModelo->obtenerLibros();
            require_once '../views/inventario/create.php';
        }
    }

    // Editar registro existente
    public function edit() {
        $id = $_GET['id'] ?? null;

        if ($id === null) {
            $this->setFlashMessage('error', 'ID no especificado.');
            header('Location: index.php?controller=inventario&action=index');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idLibro = $_POST['idLibro'];
            $cantidad = $_POST['cantidad'];
            $notas = trim($_POST['notas']);
            $fecha = !empty($_POST['fecha']) ? $_POST['fecha'] : date('Y-m-d');

            try {
                $this->modelo->actualizarInventario($id, $idLibro, $cantidad, $notas, $fecha);
                $this->setFlashMessage('success', 'Inventario actualizado correctamente.');
                header('Location: index.php?controller=inventario&action=index');
                exit();
            } catch (Exception $e) {
                $this->setFlashMessage('error', 'Error al actualizar: ' . $e->getMessage());
                $item = $this->modelo->obtenerInventarioPorId($id);
                $libros = $this->libroModelo->obtenerLibros();
                require_once '../views/inventario/edit.php';
            }

        } else {
            $item = $this->modelo->obtenerInventarioPorId($id);

            if (!$item) {
                $this->setFlashMessage('error', 'El registro no existe.');
                header('Location: index.php?controller=inventario&action=index');
                exit();
            }

            $libros = $this->libroModelo->obtenerLibros();
            require_once '../views/inventario/edit.php';
        }
    }

    // Eliminar registro
    public function delete() {
        $id = $_GET['id'] ?? null;

        if ($id === null) {
            header('Location: index.php?controller=inventario&action=index');
            exit();
        }

        try {
            $this->modelo->eliminarInventario($id);
            $this->setFlashMessage('success', 'Registro eliminado correctamente.');
        } catch (Exception $e) {
            $this->setFlashMessage('error', 'Error al eliminar: ' . $e->getMessage());
        }

        header('Location: index.php?controller=inventario&action=index');
        exit();
    }

    private function setFlashMessage($tipo, $mensaje) {
        $_SESSION['flash_message'] = [
            'type' => $tipo,
            'text' => $mensaje
        ];
    }
}
?>
