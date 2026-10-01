<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)($_POST['id'] ?? 0);
    $stmt = $conn->prepare("DELETE FROM students WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    header('Location: index.php?msg=deleted');
    exit;
}
header('Location: index.php');
