<?php
require_once 'Database.php';

class BooksGateway extends Database
{

    public function selectAll($order, $limit, $offset)
    {
        if (!isset($order)) {
            $order = 'isbn';
        }
        $pdo = Database::connect();
        $sql = $pdo->prepare("SELECT * FROM books_data ORDER BY $order ASC LIMIT $limit OFFSET $offset");
        $sql->execute();
        // $result = $sql->fetchAll(PDO::FETCH_ASSOC);

        $books = array();
        while ($obj = $sql->fetch(PDO::FETCH_OBJ)) {

            $books[] = $obj;
        }
        return $books;
    }

    public function selectById($id)
    {
        $pdo = Database::connect();
        $sql = $pdo->prepare("SELECT * FROM books_data WHERE id = ?");
        $sql->bindValue(1, $id);
        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_OBJ);

        return $result;
    }

    public function getTotalBooksCount()
    {
        $pdo = Database::connect();
        $sql = $pdo->prepare("SELECT COUNT(*) FROM books_data");
        $sql->execute();
        $count = $sql->fetchColumn();
        return $count;
    }

    public function insert($isbn, $bookTitle, $author, $editorial, $pages)
    {
        $pdo = Database::connect();
        $sql = $pdo->prepare("INSERT INTO books_data (isbn, title, author, editorial, pages) VALUES (?, ?, ?, ?, ?)");
        $result = $sql->execute(array($isbn, $bookTitle, $author, $editorial, $pages));
        return $result;
    }

    public function edit($isbn, $bookTitle, $author, $editorial, $pages, $id)
    {
        $pdo = Database::connect();
        $sql = $pdo->prepare("UPDATE books_data set isbn = ?, title = ?, author = ?, editorial = ?, pages = ? WHERE id = ? LIMIT 1");
        $result = $sql->execute(array($isbn, $bookTitle, $author, $editorial, $pages, $id));
        return $result;
    }

    public function delete($id)
    {
        $pdo = Database::connect();
        $sql = $pdo->prepare("DELETE FROM books_data WHERE id = ?");
        $sql->execute(array($id));
    }
}

?>
