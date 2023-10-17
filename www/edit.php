<?php
require_once("../config/db_config.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    # Förhindra SQL injektion
    $query = "SELECT * FROM books WHERE ID = :id";
    $stmt = $db_connection->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $book = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    echo "There was a problem parsing the id";
}

$db_connection = null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit
        <?= $book['Title'] ?>
    </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container text-center p-5 form-group">
        <form action="../www/update.php" method="post" class="form-control justify-content-center">
            <div class="row">
                <div class="col-lg-4">
                    <label for="title">Title</label>
                    <input class="w-50" type="text" name="Title" placeholder="<?= $book['Title'] ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <label for="author">Author</label>
                    <input class="" type="text" name="Author" placeholder="<?= $book['Author'] ?>">
                </div>
                <div class="col-lg-4">
                    <label for="genre">Genre</label>
                    <input class="" type="text" name="Genre" placeholder="<?= $book['Genre'] ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <label for="publisher">Publisher</label>
                    <input class="" type="text" name="Publisher" placeholder="<?= $book['Publisher'] ?>">
                </div>
            </div>
            <input class="btn btn-primary" type="submit" value="Update">
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>