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
$query = null;
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

<body class="bg-dark">
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <form action="../www/update.php" method="post" class="form-control bg-dark text-white">
            <input type="hidden" name="id" value="<?= $book['id'] ?>">
            <div class="row">
                <div class="col">
                    <label for="title">Title</label>
                    <input class="form-control" type="text" name="Title" placeholder="<?= $book['Title'] ?>"
                        autocomplete="off">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="author">Author</label>
                    <input class="form-control" type="text" name="Author" placeholder="<?= $book['Author'] ?>"
                        autocomplete="off">
                </div>
                <div class="col">
                    <label for="genre">Genre</label>
                    <input class="form-control" type="text" name="Genre" placeholder="<?= $book['Genre'] ?>"
                        autocomplete="off">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="publisher">Publisher</label>
                    <input class="form-control" type="text" name="Publisher" placeholder="<?= $book['Publisher'] ?>"
                        autocomplete="off">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-4 text-center">
                    <input class="btn btn-primary mt-2" type="submit" name="submit_button" value="Update">
                </div>
                <div class="col-4 text-center">
                    <input class="btn btn-danger mt-2" type="submit" name="submit_button" value="Delete">
                </div>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>