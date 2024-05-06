<?php
require_once '../functions.php';
session_start();

if (isset($_POST['image_id']) && isset($_POST['comment']) && isset($_SESSION['id'])) {
    $session_id = $_SESSION['id'];
    $image_id = $_POST['image_id'];
    $comment = $_POST['comment'];
    addComment($session_id, $image_id, $comment);
}

header('Location: galerie.php');