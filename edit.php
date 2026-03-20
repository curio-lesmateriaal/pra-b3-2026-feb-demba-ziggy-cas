<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Takenlijst - Bewerk taak</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/main.css">
</head>

<body>

    <div class="container">
        <h2>✏️ Taak bewerken</h2>

        <?php
        require_once 'backend/conn.php';
        
        $id = $_GET['id'] ?? null;
        
        if (!$id) {
            echo "<p>Geen taak geselecteerd.</p>";
            echo "<a href='index.php' class='btn'>Terug naar overzicht</a>";
            exit;
        }
        
        // Fetch task
        try {
            $sql = "SELECT * FROM taken WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            $task = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if (!$task) {
                echo "<p>Taak niet gevonden.</p>";
                echo "<a href='index.php' class='btn'>Terug naar overzicht</a>";
                exit;
            }
        } catch (PDOException $e) {
            echo "<p>Fout: " . htmlspecialchars($e->getMessage()) . "</p>";
            exit;
        }
        
        // Handle update
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titel = $_POST['titel'] ?? '';
            $beschrijving = $_POST['beschrijving'] ?? '';
            $afdeling = $_POST['afdeling'] ?? '';
            $status = $_POST['status'] ?? 'todo';
            $deadline = $_POST['deadline'] ?? null;
            
            try {
                $sql = "UPDATE taken SET titel = :titel, beschrijving = :beschrijving, 
                        afdeling = :afdeling, status = :status, deadline = :deadline 
                        WHERE id = :id";
                $stmt = $conn->prepare($sql);
                $stmt->execute([
                    ':titel' => $titel,
                    ':beschrijving' => $beschrijving,
                    ':afdeling' => $afdeling,
                    ':status' => $status,
                    ':deadline' => $deadline ?: null,
                    ':id' => $id
                ]);
                
                echo "<p style='color: green;'>✅ Taak succesvol bijgewerkt!</p>";
                echo "<a href='detail.php?id=$id' class='btn'>Terug naar detail</a>";
                exit;
            } catch (PDOException $e) {
                echo "<p style='color: red;'>❌ Fout bij bijwerken: " . htmlspecialchars($e->getMessage()) . "</p>";
            }
        }
        ?>

        <form method="POST">
            <label for="titel">Titel *</label>
            <input type="text" id="titel" name="titel" value="<?php echo htmlspecialchars($task['titel']); ?>" required>
            
            <label for="beschrijving">Beschrijving *</label>
            <textarea id="beschrijving" name="beschrijving" required><?php echo htmlspecialchars($task['beschrijving']); ?></textarea>
            
            <label for="afdeling">Afdeling *</label>
            <input type="text" id="afdeling" name="afdeling" value="<?php echo htmlspecialchars($task['afdeling']); ?>" required>
            
            <label for="status">Status *</label>
            <select id="status" name="status" required>
                <option value="todo" <?php echo $task['status'] === 'todo' ? 'selected' : ''; ?>>📋 Todo</option>
                <option value="in progress" <?php echo $task['status'] === 'in progress' ? 'selected' : ''; ?>>⚙️ In Progress</option>
                <option value="done" <?php echo $task['status'] === 'done' ? 'selected' : ''; ?>>✅ Done</option>
            </select>
            
            <label for="deadline">Deadline (optioneel)</label>
            <input type="date" id="deadline" name="deadline" value="<?php echo htmlspecialchars($task['deadline'] ?? ''); ?>">
            
            <div style="margin-top: 2rem;">
                <button type="submit">💾 Wijzigingen opslaan</button>
                <a href="detail.php?id=<?php echo $task['id']; ?>" class="btn btn-secondary">Annuleer</a>
            </div>
        </form>
    </div>

</body>

</html>
