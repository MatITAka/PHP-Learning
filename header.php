<?php
session_start();

function getActiveClass($currentPage) {
    return basename($_SERVER['PHP_SELF']) == $currentPage ? 'active' : '';
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Mon Site</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>

<div class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item <?= getActiveClass('index.php') ?>">
                <a class="nav-link" href="/">Accueil</a>
            </li>
            <li class="nav-item <?= getActiveClass('about.php') ?>">
                <a class="nav-link" href="../src/about.php">A propos</a>
            </li>
            <li class="nav-item <?= getActiveClass('contact.php') ?>">
                <a class="nav-link" href="../src/contact.php">Inscription</a>
            </li>
            <li class="nav-item <?= getActiveClass('galerie.php') ?>">
                <a class="nav-link" href="../src/galerie.php">Galerie</a>
            </li>

            <li class="nav-item <?= getActiveClass('login.php') ?>">
                <?php if (isset($_SESSION['user'])): ?>
                    <a class="nav-link" href="../src/logout.php">Logout</a>
                <?php else: ?>
                    <a class="nav-link" href="../src/login.php">Login</a>
                <?php endif; ?>
            </li>
        </ul>
    </div>
</div>