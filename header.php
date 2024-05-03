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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
</head>
<body>

<div class="navbar navbar-expand-md navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
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