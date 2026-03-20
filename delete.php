<?php
require_once 'backend/conn.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    header('Location: index.php');
    exit;
}

try {
    $sql = "DELETE FROM taken WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':id' => $id]);
    
    header('Location: index.php?message=Taak verwijderd');
    exit;
} catch (PDOException $e) {
    echo "Fout bij verwijderen: " . htmlspecialchars($e->getMessage());
}
