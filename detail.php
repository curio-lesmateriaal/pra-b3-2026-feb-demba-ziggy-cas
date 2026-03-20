<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Takenlijst - Detail</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/main.css">
</head>

<body>

    <?php
    require_once 'backend/conn.php';
    
    $id = $_GET['id'] ?? null;
    
    if (!$id) {
        echo "<div class='container'>";
        echo "<p>Geen taak geselecteerd.</p>";
        echo "<a href='index.php' class='btn'>Terug naar overzicht</a>";
        echo "</div>";
        exit;
    }
    
    try {
        $sql = "SELECT * FROM taken WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        $task = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$task) {
            echo "<div class='container'>";
            echo "<p>Taak niet gevonden.</p>";
            echo "<a href='index.php' class='btn'>Terug naar overzicht</a>";
            echo "</div>";
            exit;
        }
    } catch (PDOException $e) {
        echo "<div class='container'>";
        echo "<p>Fout: " . htmlspecialchars($e->getMessage()) . "</p>";
        echo "</div>";
        exit;
    }
    ?>

    <div class="container">
        <h2><?php echo htmlspecialchars($task['titel']); ?></h2>
        
        <div class="detail-section">
            <p><strong>Beschrijving:</strong></p>
            <p><?php echo nl2br(htmlspecialchars($task['beschrijving'])); ?></p>
            
            <p><strong>Afdeling:</strong><br>
            <?php echo htmlspecialchars($task['afdeling']); ?></p>
            
            <p><strong>Status:</strong><br>
            <span class='status-<?php echo strtolower(str_replace(' ', '-', $task['status'])); ?>'>
                <?php echo htmlspecialchars($task['status']); ?>
            </span></p>
            
            <p><strong>Deadline:</strong><br>
            <?php echo $task['deadline'] ? '📅 ' . htmlspecialchars($task['deadline']) : '<em>Geen deadline ingesteld</em>'; ?></p>
            
            <p><strong>Aangemaakt op:</strong><br>
            🕐 <?php echo htmlspecialchars($task['created_at']); ?></p>
            
            <div class="actions">
                <a href='edit.php?id=<?php echo $task['id']; ?>'>✏️ Bewerk taak</a>
                <a href='index.php'>👈 Terug naar overzicht</a>
                <a href='delete.php?id=<?php echo $task['id']; ?>' style='background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); color: white;' onclick='return confirm("Zeker weten? Dit kan niet ongedaan gemaakt worden.");'>🗑️ Verwijder</a>
            </div>
        </div>
    </div>

</body>

</html>
