<?php
require_once '../config/database.php';

class BookModel {
    private $db;

    public function __construct() {
        $this->db = conectarDB(); // Llama a la función de conexión a la base de datos
    }

    // Obtener todos los libros con los datos del autor y del género
public function getAllBooks() {
    $query = "SELECT 
                  b.ID_BOOK, 
                  b.TITLE, 
                  b.DESCRIPTION, 
                  b.YEAR_PUBLICATION, 
                  a.FULL_NAME AS AUTHOR_NAME, 
                  g.NAME AS GENRE_NAME 
              FROM book b
              LEFT JOIN author a ON b.ID_AUTHOR = a.ID_AUTHOR
              LEFT JOIN genre g ON b.ID_GENRE = g.ID_GENRE
              ORDER BY b.TITLE ASC"; // Ordena los libros por título

    $stmt = $this->db->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC); // Devuelve todos los libros con autor y género
}


    // Obtener un libro por su ID
    public function getBookById($id) {
        $query = "SELECT * FROM book WHERE ID_BOOK = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT); // Asocia el parámetro id
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); // Devuelve un solo libro
    }

    // Agregar un nuevo libro
    public function addBook($title, $description, $yearPublication, $idAuthor, $idGenre) {
        $query = "INSERT INTO book (TITLE, DESCRIPTION, YEAR_PUBLICATION, ID_AUTHOR, ID_GENRE) 
                  VALUES (:title, :description, :yearPublication, :idAuthor, :idGenre)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':yearPublication', $yearPublication);
        $stmt->bindParam(':idAuthor', $idAuthor, PDO::PARAM_INT);
        $stmt->bindParam(':idGenre', $idGenre, PDO::PARAM_INT);
        return $stmt->execute(); // Ejecuta la inserción
    }

    // Actualizar un libro existente
    public function updateBook($id, $title, $description, $yearPublication, $idAuthor, $idGenre) {
        $query = "UPDATE book 
                  SET TITLE = :title, DESCRIPTION = :description, YEAR_PUBLICATION = :yearPublication, 
                      ID_AUTHOR = :idAuthor, ID_GENRE = :idGenre 
                  WHERE ID_BOOK = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT); // Asocia el parámetro id
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':yearPublication', $yearPublication);
        $stmt->bindParam(':idAuthor', $idAuthor, PDO::PARAM_INT);
        $stmt->bindParam(':idGenre', $idGenre, PDO::PARAM_INT);
        return $stmt->execute(); // Ejecuta la actualización
    }

    public function deleteBook($id) {
        // Verifica si hay registros en stock relacionados con el libro
        $queryCheck = "SELECT COUNT(*) FROM stock WHERE ID_BOOK = :id";
        $stmtCheck = $this->db->prepare($queryCheck);
        $stmtCheck->bindParam(':id', $id, PDO::PARAM_INT);
        $stmtCheck->execute();
        $count = $stmtCheck->fetchColumn();
    
        if ($count > 0) {
            // Retorna un mensaje de error si hay registros relacionados
            throw new Exception("No se puede eliminar el libro porque tiene registros relacionados en stock.");
        }
    
        // Elimina el libro si no hay registros relacionados
        $query = "DELETE FROM book WHERE ID_BOOK = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    
}
?>
