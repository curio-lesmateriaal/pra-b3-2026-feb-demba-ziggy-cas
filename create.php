<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Takenlijst - Nieuwe taak</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/main.css">
</head>

<body>

    <div class="container">
        <h2>✨ Nieuwe taak toevoegen</h2>
        
        <form method="POST">
            <label for="titel">Titel *</label>
            <input type="text" id="titel" name="titel" placeholder="Geef je taak een naam" required>
            
            <label for="beschrijving">Beschrijving *</label>
            <textarea id="beschrijving" name="beschrijving" placeholder="Beschrijf je taak in detail..." required></textarea>
            
            <label for="afdeling">Afdeling *</label>
            <input type="text" id="afdeling" name="afdeling" placeholder="Bijvoorbeeld: Marketing, IT, HR..." required>
            
            <label for="status">Status *</label>
            <select id="status" name="status" required>
                <option value="todo">📋 Todo</option>
                <option value="in progress">⚙️ In Progress</option>
                <option value="done">✅ Done</option>
            </select>
            
            <label for="deadline">Deadline (optioneel)</label>
            <input type="date" id="deadline" name="deadline">
            
            <div style="margin-top: 2rem;">
                <button type="submit">💾 Taak toevoegen</button>
                <a href="index.php" class="btn btn-secondary">Annuleer</a>
            </div>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once 'backend/conn.php';
            
            $titel = $_POST['titel'] ?? '';
            $beschrijving = $_POST['beschrijving'] ?? '';
            $afdeling = $_POST['afdeling'] ?? '';
            $status = $_POST['status'] ?? 'todo';
            $deadline = $_POST['deadline'] ?? null;
            
            try {
                $sql = "INSERT INTO taken (titel, beschrijving, afdeling, status, deadline, created_at) 
                        VALUES (:titel, :beschrijving, :afdeling, :status, :deadline, NOW())";
                $stmt = $conn->prepare($sql);
                $stmt->execute([
                    ':titel' => $titel,
                    ':beschrijving' => $beschrijving,
                    ':afdeling' => $afdeling,
                    ':status' => $status,
                    ':deadline' => $deadline ?: null
                ]);
                
                echo "<div class='container' style='margin-top: 2rem;'>";
                echo "<p style='color: green;'>✅ Taak succesvol toegevoegd!</p>";
                echo "<a href='index.php' class='btn'>Terug naar overzicht</a>";
                echo "</div>";
                exit;
            } catch (PDOException $e) {
                echo "<div class='container' style='margin-top: 2rem;'>";
                echo "<p style='color: red;'>❌ Fout bij toevoegen: " . htmlspecialchars($e->getMessage()) . "</p>";
                echo "</div>";
            }
        }
        ?>
    </div>

</body>

</html>