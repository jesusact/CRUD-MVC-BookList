<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Oswald:wght@300;400&display=swap');
    </style>
    <link rel="stylesheet" href="/view/style.css">
    <title><?php echo $book->bookTitle; ?></title>
</head>
<body>
<h1><?php echo $book->title; ?></h1>
<div class="container-show">
<div>
    <span class="label">ISBN:</span>
    <?php echo $book->isbn; ?>
</div>
<div>
    <span class="label">Title:</span>
    <?php echo $book->title; ?>
</div>
<div>
    <span class="label">Author:</span>
    <?php echo $book->author; ?>
</div>
<div>
    <span class="label">Editorial:</span>
    <?php echo $book->editorial; ?>
</div>
<div>
    <span class="label">Num of pages:</span>
    <?php echo $book->pages; ?>
</div>
    <div id="goback">
<a href="index.php">Go Back</>
    </div>
</div>
</body>
</html>
