<?php

session_start();

try {
    $dbPath = __DIR__ . '/../data/data2.db';
    $pdo = new PDO('sqlite:' . $dbPath);

    $session_id = session_id();
    $image_id = $_POST['id'];
    $comment = $_POST['comment'];


    $query = $pdo->prepare("INSERT INTO comments (session_id, image_id, comment) VALUES (?, ?, ?)");
    $query->execute([$session_id, $image_id, $comment]);
} catch (PDOException $e) {
    $_SESSION['error'] = "Error: " . $e->getMessage();
}

header('Location: galerie.php');
exit;

?>