<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/Autoloader.php';
require_once ROOT_PATH . '/model/BooksService.php';

class BooksController
{
    private $booksService = null;

    public function __construct()
    {
        $this->booksService = new BooksService();
    }

    public function redirect($location)
    {
        header('Location: ' . $location);
    }

    public function handleRequest()
    {
        $op = isset($_GET['op']) ? $_GET['op'] : null;

        try {

            if (!$op || $op == 'list') {
                $this->listBooks();
            } elseif ($op == 'new') {
                $this->saveBook();
            } elseif ($op == 'edit') {
                $this->editBook();
            } elseif ($op == 'delete') {
                $this->deleteBook();
            } elseif ($op == 'show') {
                $this->showBooks();
            } else {
                $this->showError("Page not found", "Page for operation " . $op . " was not found!");
            }
        } catch (Exception $e) {
            $this->showError("Application error", $e->getMessage());
        }
    }

    public function listBooks()
    {
        $orderby = isset($_GET['orderby']) ? $_GET['orderby'] : null;
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 10;
        $offset = ($currentPage - 1) * $limit;

        $totalBooks = $this->booksService->getTotalBooksCount();
        $books = $this->booksService->getAllBooks($orderby, $limit, $offset);
        $totalPages = ceil($totalBooks / $limit);

        include ROOT_PATH . '/view/books.php';


    }

    public function saveBook()
    {
        $title = 'Add new book';

        $isbn = '';
        $bookTitle = '';
        $author = '';
        $editorial = '';
        $pages = '';
        $errors = array();

        if (isset($_POST['form-submitted'])) {

            $isbn = isset($_POST['isbn']) ? trim($_POST['isbn']) : null;
            $bookTitle = isset($_POST['bookTitle']) ? trim($_POST['bookTitle']) : null;
            $author = isset($_POST['author']) ? trim($_POST['author']) : null;
            $editorial = isset($_POST['editorial']) ? trim($_POST['editorial']) : null;
            $pages = isset($_POST['pages']) ? trim($_POST['pages']) : null;

            try {
                $this->booksService->createNewBook($isbn, $bookTitle, $author, $editorial, $pages);
                $this->redirect('index.php');
                return;
            } catch (ValidationException $e) {
                $errors = $e->getErrors();
            }
        }
        // include 'view/book-form.php';
        include ROOT_PATH . '/view/book-form.php';
    }

    public function editBook()
    {
        $title = "Edit Book";

        $isbn = '';
        $bookTitle = '';
        $author = '';
        $editorial = '';
        $pages = '';
        $id = $_GET['id'];

        $errors = array();

        $book = $this->booksService->getBook($id);

        if (isset($_POST['form-submitted'])) {

            $isbn = isset($_POST['isbn']) ? trim($_POST['isbn']) : null;
            $bookTitle = isset($_POST['bookTitle']) ? trim($_POST['bookTitle']) : null;
            $author = isset($_POST['author']) ? trim($_POST['author']) : null;
            $editorial = isset($_POST['editorial']) ? trim($_POST['editorial']) : null;
            $pages = isset($_POST['pages']) ? trim($_POST['pages']) : null;

            try {
                $this->booksService->editBook($isbn, $bookTitle, $author, $editorial, $pages, $id);
                $this->redirect('index.php');
                return;
            } catch (ValidationException $e) {
                $errors = $e->getErrors();
            }
        }
        // Include in the view of the edit form
        include ROOT_PATH . 'view/book-form-edit.php';
    }

    public function deleteBook()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        $book = $this->booksService->getBook($id);
        $booktitle=$book->title;
        if (!$id) {
            throw new Exception('Internal error');
        }
        if (isset($_POST['form-submitted-delete'])) {
            $this->booksService->deleteBook($id);
            $this->redirect('index.php');

        }
        include ROOT_PATH . '/view/book-delete.php';
    }

    public function showBooks()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : null;

        $errors = array();

        if (!$id) {
            throw new Exception('Internal error');
        }
        $book = $this->booksService->getBook($id);

        include ROOT_PATH . 'view/book.php';
    }

    public function showError($title, $message)
    {
        include ROOT_PATH . 'view/error.php';
    }
}