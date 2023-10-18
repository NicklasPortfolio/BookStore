<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once("../config/db_config.php");

    $title = filter_input(INPUT_POST, 'Title', FILTER_SANITIZE_STRING);
    $author = filter_input(INPUT_POST, 'Author', FILTER_SANITIZE_STRING);
    $genre = filter_input(INPUT_POST, 'Genre', FILTER_SANITIZE_STRING);
    $publisher = filter_input(INPUT_POST, 'Publisher', FILTER_SANITIZE_STRING);

    $button = $_POST['submit_button'];

    if ($button == 'Create') {
        
        $sql = "INSERT INTO books ";

        $placeholders = [];
        $params = [':id' => "NULL"];

        $placeholders[] = ":id";

        if (!empty($title)) {
            $placeholders[] = ":title";
            $params[':title'] = $title;
        }

        if (!empty($author)) {
            $placeholders[] = ":author";
            $params[':author'] = $author;
        }

        if (!empty($genre)) {
            $placeholders[] = ":genre";
            $params[':genre'] = $genre;
        }

        if (!empty($publisher)) {
            $placeholders[] = ":publisher";
            $params[':publisher'] = $publisher;
        }

        if (empty($placeholders)) {
            echo "No fields to update.";
        } else {
            $sql .= "VALUES (" . implode(", ", $placeholders) . ")";
            echo $sql;

            try {
                $stmt = $db_connection->prepare($sql);

                if ($stmt->execute($params)) {
                    header("Location: index.php");
                    exit;
                } else {
                    echo "Error creating record: " . implode(" - ", $stmt->errorInfo());
                }
            } catch (PDOException $e) {
                echo "Database Error: " . $e->getMessage();
            }
        }
    }

    $sql = null;
    $stmt = null;
    $db_connection = null;
}
