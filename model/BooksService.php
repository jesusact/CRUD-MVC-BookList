<?php

require_once 'BooksGateway.php';
require_once 'ValidationException.php';
require_once 'Database.php';

class BooksService extends BooksGateway
{

    private $booksGateway = null;

    public function __construct()
    {
        $this->booksGateway = new BooksGateway();
    }

    public function getAllBooks($order, $limit, $offset)
    {
        try {
            self::connect();
            $res = $this->booksGateway->selectAll($order, $limit, $offset);
            self::disconnect();
            return $res;
        } catch (Exception $e) {
            self::disconnect();
            throw $e;
        }
    }

    public function getBook($id)
    {
        try {
            self::connect();
            $result = $this->booksGateway->selectById($id);
            self::disconnect();
            return $result;
        } catch (Exception $e) {
            self::disconnect();
            throw $e;
        }
        return $this->booksGateway->selectById($id);
    }

    private function validateBookParams($isbn, $bookTitle, $author, $editorial, $pages)
    {
        $errors = array();
        if (!isset($isbn) || empty($isbn)) {
            $errors[] = 'Isbn field is required';
        }
        if (!isset($bookTitle) || empty($bookTitle)) {
            $errors[] = 'Title field is required';
        }
        if (!isset($author) || empty($author)) {
            $errors[] = 'Author field is required';
        }
        if (!isset($editorial) || empty($editorial)) {
            $errors[] = 'Editorial field is required';
        }
        if (!isset($pages) || empty($pages)) {
            $errors[] = 'Pages field is required';
        }
        if (empty($errors)) {
            return;
        }
        throw new ValidationException($errors);
    }

    public function createNewBook($isbn, $bookTitle, $author, $editorial, $pages)
    {
        try {
            self::connect();
            $this->validateBookParams($isbn, $bookTitle, $author, $editorial, $pages);
            $result = $this->booksGateway->insert($isbn, $bookTitle, $author, $editorial, $pages);
            self::disconnect();
            return $result;
        } catch (Exception $e) {
            self::disconnect();
            throw $e;

        }
    }

    public function editBook($isbn, $bookTitle, $author, $editorial, $pages, $id)
    {
        try {
            self::connect();
            $result = $this->booksGateway->edit($isbn, $bookTitle, $author, $editorial, $pages, $id);
            self::disconnect();
        } catch (Exception $e) {
            self::disconnect();
            throw $e;
        }
    }

    public function deleteBook($id)
    {
        try {
            self::connect();
            $result = $this->booksGateway->delete($id);
            self::disconnect();
        } catch (Exception $e) {
            self::disconnect();
            throw $e;
        }
    }
}

?>
