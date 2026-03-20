<!DOCTYPE html>
<html>

<head>
    <title>Takenlijst</title>`
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/main.css">
</head>

<body>

    <h2>Nieuwe taak toevoegen</h2>
    <form method="POST">
        Titel: <input type="text" name="titel" required><br>
        Beschrijving: <textarea name="beschrijving"></textarea><br>
        <button type="submit">Toevoegen</button>
    </form>

    <h2>Overzicht taken</h2>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Titel</th>
            <th>Beschrijving</th>
            <th>Status</th>
            <th>Aangemaakt op</th>
        </tr>

        <?php
        $sql = "SELECT * FROM taken ORDER BY aangemaakt_op DESC";
        $result = $conn->query($sql);

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['titel']}</td>
            <td>{$row['beschrijving']}</td>
            <td>{$row['status']}</td>
            <td>{$row['aangemaakt_op']}</td>
          </tr>";
        }
        ?>

    </table>

</body>

</html>