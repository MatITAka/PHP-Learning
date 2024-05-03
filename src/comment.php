
<?php
session_start();
require 'data/data2.db';

try {
    // Connect to the SQLite database
    $pdo = new PDO('sqlite:data/data2.db');
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$session_id = session_id(); // Get the session ID
$image_id = $_POST['image_id']; // Get the image ID from the POST data
$comment = $_POST['comment']; // Get the comment from the POST data

// Insert a new comment into the database
$query = $pdo->prepare("INSERT INTO comments (session_id, image_id, comment) VALUES (?, ?, ?)");
$query->execute([$session_id, $image_id, $comment]);

// Return a response
echo "success";

?>