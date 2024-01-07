<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Oswald:wght@300;400&display=swap');
    </style>
    <link rel="stylesheet" href="/view/style.css">
    <title>Books</title>
</head>
<body>
<h1>Book List</h1>
<div class="buttons">
    <a href="index.php?op=new" id="add">Add new book</a><br>
    <form action="booksPDF.php" method="get" id="pdfform">
        <label for="numRegistros">Number of books to print:</label>
        <input type="number" id="numRegistros" name="limit" placeholder="0" min="1" max="100">
        <button type="submit">Export as PDF</button>
    </form>
</div>
<br>
<div class="container">
    <table class="books_table">
        <thead>
        <tr>
            <th><a href="?orderby=title">Title</a></th>
            <th><a href="?orderby=isbn">ISBN</a></th>
            <th><a href="?orderby=author">Author</a></th>
            <th><a href="?orderby=editorial">Editorial</a></th>
            <th><a href="?orderby=pages">Number of pages</a></th>
            <th colspan="2">Actions</th>
        </tr>
        </thead>

        <tbody>
        <?php foreach ($books as $book) : ?>
            <tr>
                <td>
                    <strong><?php echo htmlentities($book->title); ?></strong>
                </td>
                <td><?php echo htmlentities($book->isbn); ?></td>
                <td><?php echo htmlentities($book->author); ?></td>
                <td><?php echo htmlentities($book->editorial); ?></td>
                <td><?php echo htmlentities($book->pages); ?></td>

                <td class="actions"><a href="index.php?op=edit&id=<?php echo $book->id; ?>"><img
                                src="/view/img/edit.png"></a>
                    <a href="index.php?op=delete&id=<?php echo $book->id; ?>"><img
                                src="/view/img/delete.png"></a>
                    <a href="index.php?op=show&id=<?php echo $book->id; ?>"><img src="/view/img/show.png" </a></td>

            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php
$prevPage = max(1, $currentPage - 1);
$nextPage = min($totalPages, $currentPage + 1);
?>

<div class="pages">
    <?php if ($currentPage > 1): ?>
        <a href="?page=1">First Page</a>
    <?php endif; ?>

    <?php if ($currentPage > 1): ?>
        <a href="?page=<?php echo $prevPage; ?>">Previous</a>
    <?php endif; ?>

    <span> | Page <?php echo $currentPage; ?> of <?php echo $totalPages; ?> | </span>

    <?php if ($currentPage < $totalPages): ?>
        <a href="?page=<?php echo $nextPage; ?>">Next</i></a>
    <?php endif; ?>

    <?php if ($currentPage < $totalPages): ?>
        <a href="?page=<?php echo $totalPages; ?>">Last page</a>
    <?php endif; ?>
</div>
    <footer>
        Developed by Jesús Aceituno ©
    </footer>
</body>
</html>