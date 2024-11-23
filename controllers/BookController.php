<?php
require_once '../models/BookModel.php';
require_once '../models/AuthorModel.php';
require_once '../models/GenreModel.php';

class BookController {
    private $model;
    private $authorModel;
    private $genreModel;

    public function __construct() {
        $this->model = new BookModel(); // Instancia el modelo de libro
        $this->authorModel = new AuthorModel(); // Instancia el modelo de autor
        $this->genreModel = new GenreModel(); // Instancia el modelo de género
    }

    // Método auxiliar para obtener autores y géneros
    private function getAuthorsAndGenres() {
        $authors = $this->authorModel->getAllAuthors();
        $genres = $this->genreModel->getAllGenres();
        return [$authors, $genres];
    }

    // Acción para listar todos los libros
    public function index() {
        $books = $this->model->getAllBooks(); // Obtener todos los libros
        require_once '../views/books/index.php'; // Cargar la vista del listado de libros
    }

    // Acción para crear un nuevo libro
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtener datos del formulario
            $title = $_POST['title'] ?? '';
            $description = $_POST['description'] ?? '';
            $yearPublication = $_POST['yearPublication'] ?? '';
            $idAuthor = $_POST['idAuthor'] ?? '';
            $idGenre = $_POST['idGenre'] ?? '';

            // Validación simple
            if (empty($title) || empty($yearPublication) || empty($idAuthor) || empty($idGenre)) {
                echo "Por favor complete todos los campos obligatorios.";
                return;
            }

            // Agregar el libro en la base de datos
            $this->model->addBook($title, $description, $yearPublication, $idAuthor, $idGenre);

            // Redirigir al listado de libros
            header('Location: index.php?controller=book&action=index');
            exit();
        } else {
            // Obtener autores y géneros para mostrarlos en el formulario
            list($authors, $genres) = $this->getAuthorsAndGenres();

            // Cargar la vista del formulario de creación
            require_once '../views/books/create.php';
        }
    }

    // Acción para editar un libro existente
    public function edit() {
        $id = $_GET['id'] ?? null;

        if ($id === null) {
            // Si no hay ID, redirigir al listado de libros
            header('Location: index.php?controller=book&action=index');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtener datos del formulario
            $title = $_POST['title'] ?? '';
            $description = $_POST['description'] ?? '';
            $yearPublication = $_POST['yearPublication'] ?? '';
            $idAuthor = $_POST['idAuthor'] ?? '';
            $idGenre = $_POST['idGenre'] ?? '';

            // Validación simple
            if (empty($title) || empty($yearPublication) || empty($idAuthor) || empty($idGenre)) {
                echo "Por favor complete todos los campos obligatorios.";
                return;
            }

            // Actualizar el libro en la base de datos
            $this->model->updateBook($id, $title, $description, $yearPublication, $idAuthor, $idGenre);

            // Redirigir al listado de libros
            header('Location: index.php?controller=book&action=index');
            exit();
        } else {
            // Obtener los datos del libro para editar
            $book = $this->model->getBookById($id);

            // Obtener autores y géneros para mostrarlos en el formulario
            list($authors, $genres) = $this->getAuthorsAndGenres();

            // Cargar la vista del formulario de edición
            require_once '../views/books/edit.php';
        }
    }

    public function delete() {
        try {
            $id = $_GET['id'] ?? null;
            if ($id && $this->model->deleteBook($id)) {
                // Si se elimina correctamente
                header("Location: index.php?controller=book&action=index&status=success&message=" . urlencode("Libro eliminado exitosamente."));
            } else {
                // Si algo falla en la eliminación
                header("Location: index.php?controller=book&action=index&status=error&message=" . urlencode("No se pudo eliminar el libro."));
            }
        } catch (Exception $e) {
            // En caso de error de restricción (como el de clave foránea)
            header("Location: index.php?controller=book&action=index&status=error&message=" . urlencode("Error: " . $e->getMessage()));
        }
    }
}
?>
