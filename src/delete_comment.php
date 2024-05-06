<?php
require_once '../functions.php';
session_start();

if (isset($_POST['comment_id']) && isset($_SESSION['id'])) {
    $session_id = $_SESSION['id'];
    $comment_id = $_POST['comment_id'];
    deleteComment($session_id, $comment_id);
}

header('Location: galerie.php');