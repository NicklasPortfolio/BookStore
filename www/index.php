<?php
require_once("../config/db_config.php");

$query = "SELECT * FROM books";
$stmt = $db_connection->prepare($query);

if ($stmt->execute()) {
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    echo "Error fetching data: " . implode(" - ", $stmt->errorInfo());
}

$db_connection = null;
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookstore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .custom-btn {
            font-size: 12px;
            padding: 0;
            color: dodgerblue;
        }
    </style>
</head>

<body class="bg-dark">
    <form action="../www/createform.php" method="post">
        <button type="submit" name="create_button" class="btn btn-success m-lg-3">Create New</button>
    </form>
    <section class="container">
        <table class="table table-dark">
            <thead>
                <tr>
                    <th scope="col">TITLE</th>
                    <th scope="col">AUTHOR</th>
                    <th scope="col">GENRE</th>
                    <th scope="col">PUBLISHER</th>
                    <th scope="col">EDIT</th>
                    <i></i>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($results as $result) {
                    echo "<tr>";
                    echo "<th scope='row'>" . $result["Title"] . "</th>";
                    echo "<td>" . $result["Author"] . "</td>";
                    echo "<td>" . $result["Genre"] . "</td>";
                    echo "<td>" . $result["Publisher"] . "</td>";
                    echo "<td><a class='custom-btn' href='updateform.php?id=" . $result['id'] . "'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'><path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/><path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z'/></svg></a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>