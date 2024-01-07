<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Oswald:wght@300;400&display=swap');
    </style>
    <link rel="stylesheet" href="/view/style.css">
    <title>Delete Book</title>
</head>
<body>
<h1>Delete Book</h1>
<div class="container-delete">
    <h2>Are you sure?</h2>
    <p><?php echo "\"<strong>" . $booktitle . "\"</strong>" . " will be deleted."; ?></p>
    <form method="post" action="" class="form-delete">
        <input type="hidden" name="form-submitted-delete" value="1">
        <div class="buttons-delete">
        <input type="submit" value="Submit" id="submit-btn">
        <button type="button" class="cancel-btn" onclick="location.href='index.php'">Cancel</button>
        </div>
    </form>
</div>
</body>
</html>