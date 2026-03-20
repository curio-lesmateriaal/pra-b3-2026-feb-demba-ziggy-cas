<!doctype html>
<html lang="nl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Takenlijst</title>
    <?php require_once 'head.php'; ?>
</head>

<body>

    <div class="container">
        <h2>Alle taken</h2>
        
        <div style="text-align: right; margin-bottom: 1.5rem;">
            <a href="create.php" class="btn">✨ Nieuwe taak toevoegen</a>
        </div>
        
        <table>
            <thead>
                <tr>
                    <th>Titel</th>
                    <th>Beschrijving</th>
                    <th>Afdeling</th>
                    <th>Status</th>
                    <th>Deadline</th>
                    <th>Acties</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once 'backend/conn.php';
                
                $sql = "SELECT * FROM taken ORDER BY created_at DESC";
                $result = $conn->query($sql);

                if ($result->rowCount() === 0) {
                    echo "<tr><td colspan='6' style='text-align: center; padding: 2rem;'>
                            <p style='color: #9ca3af; font-size: 1.1rem;'>Geen taken gevonden. <a href='create.php' style='color: #22c55e;'>Maak de eerste aan!</a></p>
                          </td></tr>";
                } else {
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        $statusClass = strtolower(str_replace(' ', '-', $row['status']));
                        echo "<tr>
                            <td><strong><a href='detail.php?id={$row['id']}'>" . htmlspecialchars($row['titel']) . "</a></strong></td>
                            <td>" . htmlspecialchars(substr($row['beschrijving'], 0, 50)) . (strlen($row['beschrijving']) > 50 ? '...' : '') . "</td>
                            <td>" . htmlspecialchars($row['afdeling']) . "</td>
                            <td><span class='status-{$statusClass}'>" . htmlspecialchars($row['status']) . "</span></td>
                            <td>" . htmlspecialchars($row['deadline'] ?? '—') . "</td>
                            <td>
                                <a href='detail.php?id={$row['id']}' style='color: #22c55e; margin-right: 0.5rem;'>👁️ Bekijk</a>
                                <a href='edit.php?id={$row['id']}' style='color: #fbbf24; margin-right: 0.5rem;'>✏️ Bewerk</a>
                                <a href='delete.php?id={$row['id']}' style='color: #ef4444;' onclick='return confirm(\"Zeker weten?\");'>🗑️ Verwijder</a>
                            </td>
                        </tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

</body>

</html>