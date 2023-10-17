<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once("../config/db_config.php");

    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    $title = filter_input(INPUT_POST, 'Title', FILTER_SANITIZE_STRING);
    $author = filter_input(INPUT_POST, 'Author', FILTER_SANITIZE_STRING);
    $genre = filter_input(INPUT_POST, 'Genre', FILTER_SANITIZE_STRING);
    $publisher = filter_input(INPUT_POST, 'Publisher', FILTER_SANITIZE_STRING);

    $sql = "UPDATE books SET ";
    $placeholders = [];
    $params = [':id' => $id];

    if (!empty($title)) {
        $placeholders[] = "Title = :title";
        $params[':title'] = $title;
    }

    if (!empty($author)) {
        $placeholders[] = "Author = :author";
        $params[':author'] = $author;
    }

    if (!empty($genre)) {
        $placeholders[] = "Genre = :genre";
        $params[':genre'] = $genre;
    }

    if (!empty($publisher)) {
        $placeholders[] = "Publisher = :publisher";
        $params[':publisher'] = $publisher;
    }

    if (empty($placeholders)) {
        echo "No fields to update.";
    } else {
        $sql .= implode(", ", $placeholders) . " WHERE id = :id";

        try {
            $stmt = $db_connection->prepare($sql);

            if ($stmt->execute($params)) {
                header("Location: index.php");
                exit;
            } else {
                echo "Error updating record: " . implode(" - ", $stmt->errorInfo());
            }
        } catch (PDOException $e) {
            echo "Database Error: " . $e->getMessage();
        }
    }

    $db_connection = null;
}
?>