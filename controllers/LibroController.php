<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once '../models/LibroModel.php';
require_once '../models/AutorModel.php';
require_once '../models/GeneroModel.php';

class LibroController {
    private $modelo;
    private $autorModelo;
    private $generoModelo;

    public function __construct() {
        $this->modelo = new LibroModel();
        $this->autorModelo = new AutorModel();
        $this->generoModelo = new GeneroModel();
    }

    private function cargarDatosAuxiliares() {
        $autores = $this->autorModelo->obtenerAutores();
        $generos = $this->generoModelo->obtenerGeneros();
        return [$autores, $generos];
    }

    public function index() {
        try {
            $libros = $this->modelo->obtenerLibros();
            require_once '../views/libros/index.php';
        } catch (Exception $e) {
            $this->setFlashMessage('error', 'Error al cargar libros: ' . $e->getMessage());
            require_once '../views/libros/index.php';
        }
    }

    // Acción: Crear libro
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titulo = trim($_POST['titulo'] ?? '');
            $descripcion = trim($_POST['descripcion'] ?? '');
            $anioPublicacion = $_POST['anioPublicacion'] ?? '';
            $idAutor = $_POST['idAutor'] ?? '';
            $idGenero = $_POST['idGenero'] ?? '';

            if (empty($titulo) || empty($anioPublicacion) || empty($idAutor) || empty($idGenero)) {
                $this->setFlashMessage('warning', 'Por favor complete todos los campos obligatorios.');
                
                list($autores, $generos) = $this->cargarDatosAuxiliares();
                require_once '../views/libros/create.php';
                return;
            }

            try {
                $this->modelo->agregarLibro($titulo, $descripcion, $anioPublicacion, $idAutor, $idGenero);
                $this->setFlashMessage('success', 'Libro registrado exitosamente.');
                header('Location: index.php?controller=libro&action=index');
                exit();
            } catch (Exception $e) {
                $this->setFlashMessage('error', 'Error al guardar: ' . $e->getMessage());
                list($autores, $generos) = $this->cargarDatosAuxiliares();
                require_once '../views/libros/create.php';
            }

        } else {
            list($autores, $generos) = $this->cargarDatosAuxiliares();
            require_once '../views/libros/create.php';
        }
    }

    // Acción: Editar libro
    public function edit() {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            $this->setFlashMessage('error', 'ID de libro no válido.');
            header('Location: index.php?controller=libro&action=index');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titulo = trim($_POST['titulo']);
            $descripcion = trim($_POST['descripcion']);
            $anioPublicacion = $_POST['anioPublicacion'];
            $idAutor = $_POST['idAutor'];
            $idGenero = $_POST['idGenero'];

            try {
                $this->modelo->actualizarLibro($id, $titulo, $descripcion, $anioPublicacion, $idAutor, $idGenero);
                $this->setFlashMessage('success', 'Libro actualizado correctamente.');
                header('Location: index.php?controller=libro&action=index');
                exit();
            } catch (Exception $e) {
                $this->setFlashMessage('error', 'No se pudo actualizar: ' . $e->getMessage());
                $libro = $this->modelo->obtenerLibroPorId($id);
                list($autores, $generos) = $this->cargarDatosAuxiliares();
                require_once '../views/libros/edit.php';
            }

        } else {
            $libro = $this->modelo->obtenerLibroPorId($id);

            if (!$libro) {
                $this->setFlashMessage('error', 'El libro no existe.');
                header('Location: index.php?controller=libro&action=index');
                exit();
            }

            list($autores, $generos) = $this->cargarDatosAuxiliares();
            require_once '../views/libros/edit.php';
        }
    }

    // Acción: Eliminar libro
    public function delete() {
        $id = $_GET['id'] ?? null;

        if ($id) {
            try {
                $this->modelo->eliminarLibro($id);
                $this->setFlashMessage('success', 'Libro eliminado exitosamente.');
            } catch (Exception $e) {
                $this->setFlashMessage('error', 'Error: ' . $e->getMessage());
            }
        } else {
            $this->setFlashMessage('warning', 'ID no especificado.');
        }

        header('Location: index.php?controller=libro&action=index');
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
