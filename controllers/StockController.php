<?php
require_once '../models/StockModel.php';

class StockController {
    private $model;

    public function __construct() {
        $this->model = new StockModel(); 
    }

    public function index() {
        $stock = $this->model->getAllStock(); 
        require_once '../views/stocks/index.php'; 
    }
    
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $idBook = $_POST['idBook'];
            $totalStock = $_POST['totalStock'];
            $notes = $_POST['notes'];
            $lastInventoryDate = $_POST['lastInventoryDate'];

            $this->model->addStock($idBook, $totalStock, $notes, $lastInventoryDate);

            header('Location: index.php?controller=stock&action=index');
            exit();
        } else {

            require_once '../models/BookModel.php';
            $bookModel = new BookModel();
            $books = $bookModel->getAllBooks();

            require_once '../views/stocks/create.php';
        }
    }

    public function edit() {
        $id = $_GET['id'] ?? null;

        if ($id === null) {
            header('Location: index.php?controller=stock&action=index');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idBook = $_POST['idBook'];
            $totalStock = $_POST['totalStock'];
            $notes = $_POST['notes'];
            $lastInventoryDate = $_POST['lastInventoryDate'];

            $this->model->updateStock($id, $idBook, $totalStock, $notes, $lastInventoryDate);

            header('Location: index.php?controller=stock&action=index');
            exit();
        } else {
            $stock = $this->model->getStockById($id);

            require_once '../models/BookModel.php';
            $bookModel = new BookModel();
            $books = $bookModel->getAllBooks();

            require_once '../views/stocks/edit.php';
        }
    }

    public function delete() {
        $id = $_GET['id'] ?? null;

        if ($id === null) {
            header('Location: index.php?controller=stock&action=index');
            exit();
        }

        $this->model->deleteStock($id);

        header('Location: index.php?controller=stock&action=index');
        exit();
    }
}
?>
