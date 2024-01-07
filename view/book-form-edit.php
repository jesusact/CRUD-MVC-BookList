<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Oswald:wght@300;400&display=swap');
    </style>
    <link rel="stylesheet" href="/view/style.css">
    <title>
        <?php echo htmlentities($title); ?>
    </title>
</head>
<body>
<h1>Edit Book</h1>
<?php
if ($errors) {
    echo '<ul class="errors">';
    foreach ($errors as $field => $error) {
        echo '<li>' . htmlentities($error) . '</li>';
    }
    echo '</ul>';
}
?>
<div class="container-edit">
    <form method="post" action="" class="form-edit">
        <label for="isbn">ISBN: </label><br>
        <input type="text" name="isbn" value="<?php echo htmlentities($book->isbn); ?>">
        <br>
        <label for="bookTitle">Title: </label><br>
        <input type="text" name="bookTitle" value="<?php echo htmlentities($book->title); ?>">
        <br>
        <label for="author">Author: </label><br>
        <input type="text" name="author" value="<?php echo htmlentities($book->author); ?>">
        <br>
        <label for="editorial">Editorial: </label><br>
        <input type="text" name="editorial" value="<?php echo htmlentities($book->editorial); ?>">
        <br>
        <label for="pages">Num of pages: </label><br>
        <input type="number" name="pages" value="<?php echo htmlentities($book->pages); ?>">
        <br>
        <div class="buttons-edit">
            <input type="hidden" name="form-submitted" value="1">
            <input type="submit" value="Update" id="update-btn">
            <button type="button" class="cancel-btn" onclick="location.href='index.php'">Cancel</button>
        </div>
    </form>
</div>
</body>
</html>