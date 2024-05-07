<?php

session_start();

if (!isset($_SESSION['user'])) {
    header('Location: galerie.php');
    exit;
}

try {
    $dbPath = __DIR__ . '/../data/data2.db';
    $pdo = new PDO('sqlite:' . $dbPath);

    $comment_id = $_POST['comment_id'];


    $query = $pdo->prepare("DELETE FROM comments WHERE id = ?");
    $query->execute([$comment_id]);
} catch (PDOException $e) {
    $_SESSION['error'] = "Error: " . $e->getMessage();
}

header('Location: galerie.php');
exit;

?>