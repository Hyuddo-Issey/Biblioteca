<?php

class HomeController {
    public function index() {
        $pdo = conectarDB(); 
        
        $stmtBooks = $pdo->query('SELECT COUNT(*) FROM book');
        $numBooks = $stmtBooks->fetchColumn();
        
        $stmtAuthors = $pdo->query('SELECT COUNT(*) FROM author');
        $numAuthors = $stmtAuthors->fetchColumn();
        
        $stmtGenres = $pdo->query('SELECT COUNT(*) FROM genre');
        $numGenres = $stmtGenres->fetchColumn();
        
        require_once '../views/inicio/index.php';
    }
}

