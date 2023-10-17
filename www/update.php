<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once("../config/db_config.php");

    $title = $_POST["Title"];
    $author = $_POST["Author"];
    $genre = $_POST["Genre"];
    $publisher = $_POST["Publisher"];

    $toUpdate = [];

    if (!empty($title)) {
        $toUpdate[] = "Title = '$title'";
    }

    if (!empty($author)) {
        $toUpdate[] = "Author = '$author'";
    }

    if (!empty($genre)) {
        $toUpdate[] = "Genre = '$genre'";
    }

    if (!empty($publisher)) {
        $toUpdate[] = "Publisher = '$publisher'";
    }

    if (!empty($toUpdate)) {
        $sql = "UPDATE books SET " . implode(", ", $toUpdate) . " WHERE ID = :id";

        // Prepare the query
        $stmt = $db_connection->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':id', $book["ID"], PDO::PARAM_INT);
        if (!empty($title)) {
            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        }
        if (!empty($author)) {
            $stmt->bindParam(':author', $author, PDO::PARAM_STR);
        }
        if (!empty($genre)) {
            $stmt->bindParam(':genre', $genre, PDO::PARAM_STR);
        }
        if (!empty($publisher)) {
            $stmt->bindParam(':publisher', $publisher, PDO::PARAM_STR);
        }

        // Execute the query
        if ($stmt->execute()) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $stmt->errorInfo();
        }
    } else {
        echo "No fields to update.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
</head>
<body>
    <?php

    ?>
</body>
</html>