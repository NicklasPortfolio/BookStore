<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once("../config/db_config.php");

    $id = $_POST["id"];
    $title = $_POST["Title"];
    $author = $_POST["Author"];
    $genre = $_POST["Genre"];
    $publisher = $_POST["Publisher"];

    $sql = "UPDATE books SET ";
    $placeholders = [];

    if (!empty($title)) {
        $placeholders[] = "Title = :title";
    }

    if (!empty($author)) {
        $placeholders[] = "Author = :author";
    }

    if (!empty($genre)) {
        $placeholders[] = "Genre = :genre";
    }

    if (!empty($publisher)) {
        $placeholders[] = "Publisher = :publisher";
    }

    $sql .= implode(", ", $placeholders) . " WHERE id = :id";

    // Prepare the query
    $stmt = $db_connection->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
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
        header("Location: index.php");
        exit;
    } else {
        echo "Error updating record: " . implode(" - ", $stmt->errorInfo());
    }

    $db_connection = null;
}
?>